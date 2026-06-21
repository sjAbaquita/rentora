# Rentora

Rentora is a Property Management System built for landlords, lessors, and tenants.

## Technology Stack

Backend:

* Laravel 13
* PHP 8.4

Frontend:

* Vue 3
* TypeScript
* Inertia.js
* Tailwind CSS v4
* Vite

State Management:

* Pinia

UI Components:

* shadcn-vue

Database:

* MySQL

Testing:

* Pest
* Laravel Dusk

File Storage:

* Laravel Storage

Authentication:

* Laravel Breeze with Inertia

Notifications:

* Email
* Database notifications

PDF Generation:

* Laravel DomPDF

Charts:

* ApexCharts

Future Integrations:

* GCash
* Maya
* Stripe
* PayPal

---

## User Roles

### Owner

Can manage:

* Properties
* Units
* Tenants
* Leases
* Invoices
* Payments
* Expenses
* Maintenance requests
* Reports

### Tenant

Can:

* Login
* View active lease
* View invoices
* Pay rent
* Upload proof of payment
* Download receipts
* Submit maintenance requests
* Receive announcements

### Staff

Can:

* Manage tenants
* Record payments
* Handle maintenance requests

---

## Property Types

* Apartment
* Building
* House
* Boarding House

---

## Modules

* Authentication
* Dashboard
* Property
* Unit
* Tenant
* Lease
* Invoice
* Payment
* Expense
* Maintenance
* Meter Reading
* Announcement
* Document
* Notification
* Reports

---

## Design Goals

The application must:

* Be modular.
* Be maintainable.
* Follow Domain Driven Design.
* Support SaaS conversion in the future.
* Use strong TypeScript typing.
* Use reusable components.
* Avoid duplicated business logic.
* Be mobile responsive.
* Be suitable for desktop and tablet use.
