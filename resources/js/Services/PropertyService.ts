/**
 * Property Service
 * Handles property management operations with type-safe route helpers
 */

import type { FormDataConvertible } from '@inertiajs/core';
import { router } from '@inertiajs/vue3';
import { index, store, update, destroy } from '@/routes/properties';
import type { Property, PropertyFormData } from '@/types/domains';
import type { Paginated } from '@/types/pagination';

class PropertyService {
    async getAll(page: number = 1): Promise<{ data: Paginated<Property>; error: string | null }> {
        try {
            const response = await router.get(index.url({ query: { page } }), {}, { preserveState: true });

            return { data: response as unknown as Paginated<Property>, error: null };
        } catch {
            return { data: {} as Paginated<Property>, error: 'Failed to fetch properties.' };
        }
    }

    async create(formData: PropertyFormData): Promise<void> {
        await router.post(store.url(), formData as Record<string, FormDataConvertible>);
    }

    async update(id: number, formData: PropertyFormData): Promise<void> {
        await router.put(update.url(id), formData as Record<string, FormDataConvertible>);
    }

    async delete(id: number): Promise<void> {
        await router.delete(destroy.url(id));
    }
}

export const propertyService = new PropertyService();

