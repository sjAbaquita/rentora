# Architecture

## Backend

Laravel 13

Follow:

* Thin Controllers
* Service Classes
* Form Requests
* Policies
* API Resources
* Enum Classes
* Events and Listeners
* Queue Jobs

Business logic must not live inside controllers.

Controllers should only:

* validate requests
* call services
* return responses

---

## Frontend

Vue 3

Use:

script setup
Composition API
TypeScript everywhere.

Never use:

* Options API
* any type
* jQuery

---

## State Management

Pinia

Stores:

* authStore
* propertyStore
* tenantStore
* invoiceStore

---

## Vite

Use Vite for:

* Hot module reload
* Asset bundling
* TypeScript support

---

## Folder Structure

app/

Domains/

Property/
Tenant/
Lease/
Invoice/
Payment/
Maintenance/
Expense/
Announcement/
Document/

Each domain contains:

Models
Controllers
Requests
Services
Policies
Actions
Enums
Events
Listeners

---

resources/js/

Pages
Components
Layouts
Stores
Composables
Types
Services
Enums
Utils

---

Reusable components are preferred over duplicated code.

All pages should use Inertia.
