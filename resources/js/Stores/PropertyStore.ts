import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import { propertyService } from '@/modules/properties/services/PropertyService';
import type { Property, PropertyFormData } from '@/types/domains';

export const usePropertyStore = defineStore('property', () => {
    const properties = ref<Property[]>([]);
    const loading = ref(false);
    const error = ref<string | null>(null);

    const count = computed(() => properties.value.length);
    const isEmpty = computed(() => properties.value.length === 0);

    // async function fetchAll(): Promise<void> {
    //     loading.value = true;
    //     error.value = null;

    //     try {
    //         const { data, error: serviceError } = await propertyService.getAll();

    //         if (serviceError) {
    //             error.value = serviceError;

    //             return;
    //         }

    //         properties.value = data.data;
    //     } catch (err) {
    //         error.value = 'Failed to load properties.';
    //         console.error(err);
    //     } finally {
    //         loading.value = false;
    //     }
    // }

	const setProperties = (data: Property[]) => {
		properties.value = [...data];
	}

    async function create(formData: PropertyFormData): Promise<void> {
        loading.value = true;
        error.value = null;

        try {
            await propertyService.create(formData);
        } catch (err) {
            error.value = 'Failed to create property.';

            throw err;
        } finally {
            loading.value = false;
        }
    }

    async function update(id: number, formData: PropertyFormData): Promise<void> {
        loading.value = true;
        error.value = null;

        try {
            await propertyService.update(id, formData);
        } catch (err) {
            error.value = 'Failed to update property.';

            throw err;
        } finally {
            loading.value = false;
        }
    }

    async function remove(id: number): Promise<void> {
        loading.value = true;
        error.value = null;

        try {
            await propertyService.delete(id);
            properties.value = properties.value.filter((p) => p.id !== id);
        } catch (err) {
            error.value = 'Failed to delete property.';

            throw err;
        } finally {
            loading.value = false;
        }
    }

    function reset(): void {
        properties.value = [];
        loading.value = false;
        error.value = null;
    }

    return {
        properties,
        loading,
        error,
        count,
        isEmpty,
        setProperties,
        create,
        update,
        remove,
        reset,
    };
});
