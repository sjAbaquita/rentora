import type { PropertyStatus } from '@/modules/properties/enums/property-status';
import type { PropertyType } from '@/modules/properties/enums/property-types';

export interface Property {
	id: number;
	name: string;
	address: string;
	city: string;
	postal_code: string;
	property_type: PropertyType;
	total_units: number;
	year_built: number;
	status: PropertyStatus;
	created_at: string;
	updated_at: string;
}