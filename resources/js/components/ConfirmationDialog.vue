<script setup lang="ts">
import { Loader2 } from '@lucide/vue'

import { Button } from '@/components/ui/button'
import type { ButtonVariants } from '@/components/ui/button'

import {
    AlertDialog,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/components/ui/alert-dialog'


// type ConfirmVariant =
//     | 'default'
//     | 'destructive'
//     | 'secondary'
//     | 'outline'
//     | 'ghost'

interface Props {
    open: boolean
    title: string
    description?: string
    itemName?: string | null
    confirmText?: string
    cancelText?: string
    confirmVariant?: ButtonVariants['variant']
    loading?: boolean
    closeOnConfirm?: boolean
}

withDefaults(
    defineProps<Props>(),
    {
        description: '',
        itemName: null,
        confirmText: 'Confirm',
        cancelText: 'Cancel',
        confirmVariant: 'destructive',
        loading: false,
        closeOnConfirm: false,
    },
)

const emit = defineEmits<{
    'update:open': [boolean]
    confirm: []
    cancel: []
}>()

function updateOpen(open: boolean) {
    emit('update:open', open)

    if (!open) {
        emit('cancel')
    }
}

function confirm() {
    emit('confirm')
}
</script>

<template>
    <AlertDialog
        :open="open"
        @update:open="updateOpen"
    >
        <AlertDialogContent class="sm:max-w-md">

            <AlertDialogHeader>

                <div class="mb-3 flex justify-center">
                    <slot name="icon" />
                </div>

                <AlertDialogTitle>
                    {{ title }}
                </AlertDialogTitle>

                <AlertDialogDescription
                    class="space-y-3"
                >
                    <p v-if="description">
                        {{ description }}
                    </p>

                    <p
                        v-if="itemName"
                        class="rounded-md border bg-muted p-3 font-medium text-foreground"
                    >
                        {{ itemName }}
                    </p>

                    <slot />

                </AlertDialogDescription>

            </AlertDialogHeader>

            <AlertDialogFooter>

                <AlertDialogCancel
                    :disabled="loading"
                >
                    {{ cancelText }}
                </AlertDialogCancel>

                <Button
                    :variant="confirmVariant"
                    :disabled="loading"
                    @click="confirm"
                >
                    <Loader2
                        v-if="loading"
                        class="mr-2 h-4 w-4 animate-spin"
                    />

                    {{ loading ? 'Please wait...' : confirmText }}
                </Button>

            </AlertDialogFooter>

        </AlertDialogContent>
    </AlertDialog>
</template>