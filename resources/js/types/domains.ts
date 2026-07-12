/**
 * Domain-Driven Development Types
 * Comprehensive type definitions for all operational modules
 * Following strict TypeScript and domain semantics
 */

// ============================================================================
// BASE TYPES
// ============================================================================

export enum PropertyStatus {
    ACTIVE = 'active',
    INACTIVE = 'inactive',
    MAINTENANCE = 'maintenance',
}

export enum PropertyType {
	APARTMENT = 'apartment',
    BUILDING = 'building',
    HOUSE = 'house',
    BOARDING_HOUSE = 'boarding_house',
}

export enum UnitType {
    STUDIO = 'studio',
    ONE_BED = '1bed',
    TWO_BED = '2bed',
    THREE_BED = '3bed',
    FOUR_BED = '4bed',
    PENTHOUSE = 'penthouse',
}

export enum UnitStatus {
    AVAILABLE = 'available',
    OCCUPIED = 'occupied',
    RESERVED = 'reserved',
    MAINTENANCE = 'maintenance',
}

export enum LeaseStatus {
    ACTIVE = 'active',
    ENDED = 'ended',
    TERMINATED = 'terminated',
}

export enum InvoiceStatus {
    DRAFT = 'draft',
    SENT = 'sent',
    PAID = 'paid',
    OVERDUE = 'overdue',
    CANCELLED = 'cancelled',
}

export enum PaymentMethod {
    BANK_TRANSFER = 'bank_transfer',
    CREDIT_CARD = 'credit_card',
    CASH = 'cash',
    CHECK = 'check',
}

export enum PaymentStatus {
    PENDING = 'pending',
    COMPLETED = 'completed',
    FAILED = 'failed',
    REFUNDED = 'refunded',
}

export enum MaintenancePriority {
    LOW = 'low',
    MEDIUM = 'medium',
    HIGH = 'high',
    EMERGENCY = 'emergency',
}

export enum MaintenanceStatus {
    OPEN = 'open',
    IN_PROGRESS = 'in_progress',
    ON_HOLD = 'on_hold',
    COMPLETED = 'completed',
    CANCELLED = 'cancelled',
}

export enum ExpenseCategory {
    UTILITIES = 'utilities',
    REPAIRS = 'repairs',
    MAINTENANCE = 'maintenance',
    INSURANCE = 'insurance',
    TAXES = 'taxes',
    ADMINISTRATIVE = 'administrative',
    OTHER = 'other',
}

export enum AnnouncementPriority {
    LOW = 'low',
    MEDIUM = 'medium',
    HIGH = 'high',
}

export enum AnnouncementStatus {
    DRAFT = 'draft',
    PUBLISHED = 'published',
    ARCHIVED = 'archived',
}

export enum DocumentType {
    LEASE = 'lease',
    CONTRACT = 'contract',
    INVOICE = 'invoice',
    RECEIPT = 'receipt',
    MAINTENANCE = 'maintenance',
    OTHER = 'other',
}

export enum MeterReadingType {
    WATER = 'water',
    ELECTRICITY = 'electricity',
    GAS = 'gas',
}

export enum NotificationChannel {
    EMAIL = 'email',
    SMS = 'sms',
    IN_APP = 'in_app',
    PUSH = 'push',
}

export enum NotificationStatus {
    PENDING = 'pending',
    SENT = 'sent',
    FAILED = 'failed',
    READ = 'read',
}

// ============================================================================
// ENTITY TYPES
// ============================================================================

/**
 * Property Entity - Core property management
 */
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

/**
 * Tenant Entity - Resident information
 */
export interface Tenant {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    date_of_birth: string | null;
    nationality: string;
    created_at: string;
    updated_at: string;
}

/**
 * Unit Entity - Property unit/apartment
 */
export interface Unit {
    id: number;
    property_id: number;
    unit_number: string;
    unit_type: UnitType;
    floor_number: number;
    area_sqm: number;
    bedrooms: number;
    bathrooms: number;
    status: UnitStatus;
    created_at: string;
    updated_at: string;
}

/**
 * Lease Entity - Rental agreement between tenant and unit
 */
export interface Lease {
    id: number;
    unit_id: number;
    tenant_id: number;
    lease_start: string;
    lease_end: string;
    monthly_rent: number;
    deposit: number;
    status: LeaseStatus;
    created_at: string;
    updated_at: string;
}

/**
 * Invoice Entity - Billing document
 */
export interface Invoice {
    id: number;
    lease_id: number;
    invoice_number: string;
    billing_period: string | null;
    amount_due: number;
    amount_paid: number;
    late_fee: number;
    due_date: string;
    status: InvoiceStatus;
    description: string;
    created_at: string;
    updated_at: string;
}

/**
 * Payment Entity - Payment transaction
 */
export interface Payment {
    id: number;
    invoice_id: number;
    tenant_id: number | null;
    amount: number;
    method: PaymentMethod;
    paid_at: string;
    reference_number: string;
    status: PaymentStatus;
    created_at: string;
    updated_at: string;
}

/**
 * Maintenance Entity - Maintenance request/task
 */
export interface Maintenance {
    id: number;
    tenant_id: number | null;
    unit_id: number;
    title: string;
    description: string;
    priority: MaintenancePriority;
    status: MaintenanceStatus;
    assigned_to: string | null;
    created_at: string;
    updated_at: string;
}

/**
 * Expense Entity - Property expense tracking
 */
export interface Expense {
    id: number;
    property_id: number;
    category: ExpenseCategory;
    amount: number;
    expense_date: string;
    description: string;
    reference_number: string | null;
    created_at: string;
    updated_at: string;
}

/**
 * Announcement Entity - Property/tenant announcements
 */
export interface Announcement {
    id: number;
    property_id: number;
    title: string;
    content: string;
    priority: AnnouncementPriority;
    status: AnnouncementStatus;
    publish_at: string | null;
    published_at: string | null;
    audience: string | null;
    created_at: string;
    updated_at: string;
}

/**
 * Document Entity - File/document management
 */
export interface Document {
    id: number;
    property_id: number;
    tenant_id: number | null;
    title: string;
    document_type: DocumentType;
    file_path: string;
    description: string | null;
    uploaded_at: string;
    created_at: string;
    updated_at: string;
}

/**
 * MeterReading Entity - Utility meter readings
 */
export interface MeterReading {
    id: number;
    property_id: number;
    unit_id: number | null;
    reading_type: MeterReadingType;
    previous_reading: number;
    current_reading: number;
    recorded_at: string;
    created_at: string;
    updated_at: string;
}

/**
 * Notification Entity - System notifications
 */
export interface Notification {
    id: number;
    title: string;
    content: string;
    channel: NotificationChannel;
    recipient: string;
    status: NotificationStatus;
    sent_at: string | null;
    read_at: string | null;
    created_at: string;
    updated_at: string;
}

/**
 * Organization Entity - Multi-tenant organization
 */
export interface Organization {
    id: number;
    name: string;
    slug: string;
    billing_email: string;
    country: string;
    timezone: string;
    created_at: string;
    updated_at: string;
}

// ============================================================================
// DTO/REQUEST TYPES
// ============================================================================

/**
 * Create/Update DTO for Property
 */
export interface PropertyFormData {
    [key: string]: unknown;
    name: string;
    address: string;
    city: string;
    postal_code: string;
    property_type: PropertyType;
    total_units: number;
    year_built: number;
    status?: PropertyStatus;
}

/**
 * Create/Update DTO for Tenant
 */
export interface TenantFormData {
    [key: string]: unknown;
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    date_of_birth: string | undefined;
    nationality: string;
}

/**
 * Create/Update DTO for Unit
 */
export interface UnitFormData {
    [key: string]: unknown;
    property_id: number;
    unit_number: string;
    unit_type: UnitType;
    floor_number: number;
    area_sqm: number;
    bedrooms: number;
    bathrooms: number;
    status?: UnitStatus;
}

/**
 * Create/Update DTO for Lease
 */
export interface LeaseFormData {
    [key: string]: unknown;
    unit_id: number;
    tenant_id: number;
    lease_start: string;
    lease_end: string;
    monthly_rent: number;
    deposit: number;
    status: LeaseStatus;
}

/**
 * Create/Update DTO for Invoice
 */
export interface InvoiceFormData {
    [key: string]: unknown;
    lease_id: number;
    invoice_number: string;
    billing_period?: string | null | undefined;
    amount_due: number;
    late_fee?: number | null | undefined;
    due_date: string;
    status: InvoiceStatus;
    description: string;
}

/**
 * Create/Update DTO for Payment
 */
export interface PaymentFormData {
    [key: string]: unknown;
    invoice_id: number;
    tenant_id?: number | null;
    amount: number;
    method: PaymentMethod;
    paid_at: string;
    reference_number: string;
    proof_status?: string;
}

/**
 * Create/Update DTO for Maintenance
 */
export interface MaintenanceFormData {
    [key: string]: unknown;
    tenant_id?: number | null;
    unit_id: number;
    title: string;
    description: string;
    priority: MaintenancePriority;
    status: MaintenanceStatus;
    assigned_to: string | null | undefined;
}

/**
 * Create/Update DTO for Expense
 */
export interface ExpenseFormData {
    [key: string]: unknown;
    property_id: number;
    category: ExpenseCategory;
    amount: number;
    expense_date: string;
    description: string;
    reference_number: string | null | undefined;
}

/**
 * Create/Update DTO for Announcement
 */
export interface AnnouncementFormData {
    [key: string]: unknown;
    property_id: number;
    title: string;
    content: string;
    priority: AnnouncementPriority;
    status: AnnouncementStatus;
    publish_at: string | null | undefined;
    audience?: string;
}

/**
 * Create/Update DTO for Document
 */
export interface DocumentFormData {
    [key: string]: unknown;
    property_id: number;
    tenant_id?: number | null;
    title: string;
    document_type: DocumentType;
    file_path: string;
    description: string | null | undefined;
    uploaded_at?: string | null | undefined;
}

/**
 * Create/Update DTO for MeterReading
 */
export interface MeterReadingFormData {
    [key: string]: unknown;
    property_id: number;
    unit_id?: number | null | undefined;
    reading_type: MeterReadingType;
    previous_reading: number;
    current_reading: number;
    recorded_at: string;
}

/**
 * Create/Update DTO for Notification
 */
export interface NotificationFormData {
    [key: string]: unknown;
    title: string;
    channel: NotificationChannel;
    recipient: string;
    status: NotificationStatus;
    sent_at: string | null | undefined;
}

/**
 * Create/Update DTO for Organization
 */
export interface OrganizationFormData {
    [key: string]: unknown;
    name: string;
    slug: string;
    billing_email: string;
    country: string;
    timezone: string;
}

// ============================================================================
// API RESPONSE TYPES
// ============================================================================

export interface PaginatedResponse<T> {
    data: T[];
    meta: {
        current_page: number;
        from: number;
        to: number;
        total: number;
        per_page: number;
        last_page: number;
    };
}

export interface EntityResponse<T> {
    data: T;
}

export interface MessageResponse {
    message: string;
}

// ============================================================================
// VALIDATION ERROR TYPES
// ============================================================================

export interface ValidationError {
    [key: string]: string[];
}

export interface ApiError {
    message: string;
    errors?: ValidationError;
    code?: string;
}

export function isApiError(error: unknown): error is ApiError {
    return (
        typeof error === 'object' &&
        error !== null &&
        'message' in error &&
        typeof (error as ApiError).message === 'string'
    );
}

export function getValidationErrors(error: unknown): Record<string, string> {
    if (!isApiError(error) || !error.errors) {
        return {};
    }

    return Object.entries(error.errors).reduce<Record<string, string>>(
        (acc, [key, messages]) => {
            acc[key] = messages[0] ?? '';

            return acc;
        },
        {},
    );
}

// ============================================================================
// SUMMARY STATISTICS
// ============================================================================

export interface PropertySummary {
    total_properties: number;
    total_units: number;
    occupied_units: number;
    occupancy_rate: number;
}

export interface TenantSummary {
    total_tenants: number;
    active_leases: number;
    inactive_leases: number;
}

export interface InvoiceSummary {
    total_invoices: number;
    paid: number;
    pending: number;
    overdue: number;
    total_amount: number;
}

export interface MaintenanceSummary {
    total_requests: number;
    open: number;
    in_progress: number;
    completed: number;
}
