<script setup lang="ts" generic="T extends { id: number; label: string }">
import { computed, ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { ChevronsUpDown, Check } from '@lucide/vue';

interface Props {
    label?: string;
    placeholder?: string;
    items: T[];
    modelValue: number | null;
    searchPlaceholder?: string;
    error?: string;
    disabled?: boolean;
    required?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    label: '',
    placeholder: 'Select an option...',
    searchPlaceholder: 'Search...',
    error: '',
    disabled: false,
    required: false,
});

const emit = defineEmits<{
    'update:modelValue': [value: number | null];
}>();

const searchQuery = ref('');
const open = ref(false);

const filteredItems = computed(() => {
    if (!searchQuery.value) return props.items;
    
    const query = searchQuery.value.toLowerCase();
    return props.items.filter(item =>
        item.label.toLowerCase().includes(query)
    );
});

const selectedItem = computed(() => {
    return props.items.find(item => item.id === props.modelValue);
});

const handleSelect = (value: number) => {
    emit('update:modelValue', value);
    searchQuery.value = '';
    open.value = false;
};

const handleOpenChange = (newOpen: boolean) => {
    open.value = newOpen;
    if (!newOpen) {
        searchQuery.value = '';
    }
};
</script>

<template>
    <div class="w-full space-y-2">
        <div v-if="label || required" class="flex items-center gap-1">
            <Label v-if="label" :for="`combobox-${label}`">
                {{ label }}
            </Label>
            <span v-if="required" class="text-red-500">*</span>
        </div>

        <div class="space-y-2">
            <!-- Search Input -->
            <Input
                v-if="open"
                v-model="searchQuery"
                type="text"
                :placeholder="searchPlaceholder"
                class="mb-2"
                :disabled="disabled"
                autofocus
            />

            <!-- Select Trigger -->
            <Select
                :open="open"
                :disabled="disabled"
                @update:open="handleOpenChange"
            >
                <SelectTrigger
                    :class="{ 'border-red-500': error }"
                    class="w-full"
                >
                    <SelectValue :placeholder="placeholder">
                        <div class="flex items-center justify-between w-full">
                            <span>{{ selectedItem?.label || placeholder }}</span>
                            <ChevronsUpDown class="h-4 w-4 opacity-50 ml-2" />
                        </div>
                    </SelectValue>
                </SelectTrigger>

                <SelectContent>
                    <div v-if="filteredItems.length === 0" class="px-2 py-1.5 text-sm text-muted-foreground text-center">
                        No results found
                    </div>

                    <SelectItem
                        v-for="item in filteredItems"
                        :key="item.id"
                        :value="item.id"
                        @click="handleSelect(item.id)"
                    >
                        <div class="flex items-center gap-2">
                            <Check v-if="selectedItem?.id === item.id" class="h-4 w-4" />
                            <span v-else class="h-4 w-4" />
                            {{ item.label }}
                        </div>
                    </SelectItem>
                </SelectContent>
            </Select>
        </div>

        <!-- Error Message -->
        <p v-if="error" class="text-sm text-red-500">{{ error }}</p>
    </div>
</template>
