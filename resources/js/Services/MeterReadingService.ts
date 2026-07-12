/**
 * Meter Reading Service
 * Handles mutations (create, update, delete) for meter reading management
 * Uses auto-generated routes from Wayfinder for type-safe URL generation
 * Data fetching is now handled by Inertia props from the controller
 */

import type { FormDataConvertible } from '@inertiajs/core';
import { router } from '@inertiajs/vue3';
import { store, update, destroy } from '@/routes/meter-readings';
import type { MeterReadingFormData } from '@/types/domains';

class MeterReadingService {
    async create(formData: MeterReadingFormData): Promise<void> {
        await router.post(store.url(), formData as Record<string, FormDataConvertible>);
    }

    async update(id: number, formData: MeterReadingFormData): Promise<void> {
        await router.put(update.url(id), formData as Record<string, FormDataConvertible>);
    }

    async delete(id: number): Promise<void> {
        await router.delete(destroy.url(id));
    }
}

export const meterReadingService = new MeterReadingService();
