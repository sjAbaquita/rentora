/**
 * Organization Service
 * Handles mutations (create, update, delete) for organization management
 * Uses auto-generated routes from Wayfinder for type-safe URL generation
 * Data fetching is now handled by Inertia props from the controller
 */

import type { FormDataConvertible } from '@inertiajs/core';
import { router } from '@inertiajs/vue3';
import { store, update, destroy } from '@/routes/organization';
import type { OrganizationFormData } from '@/types/domains';

class OrganizationService {
    async create(formData: OrganizationFormData): Promise<void> {
        await router.post(store.url(), formData as Record<string, FormDataConvertible>);
    }

    async update(id: number, formData: OrganizationFormData): Promise<void> {
        await router.put(update.url(id), formData as Record<string, FormDataConvertible>);
    }

    async delete(id: number): Promise<void> {
        await router.delete(destroy.url(id));
    }
}

export const organizationService = new OrganizationService();
