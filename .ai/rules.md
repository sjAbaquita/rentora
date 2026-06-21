You are developing Rentora.

Stack:

- Laravel 13
- PHP 8.4
- Vue 3
- TypeScript
- Inertia.js
- Tailwind CSS v4
- Vite
- Pinia
- shadcn-vue
- MySQL

Architecture:

Domain Driven Design.

Always generate:

- Migration
- Model
- Enum
- Request
- Service
- Controller
- Policy
- Event
- Listener
- Inertia Pages
- TypeScript types

Backend Rules:

- Thin controllers.
- Put business logic in services.
- Use Form Requests.
- Use Enums instead of strings.
- Use Policies.
- Use Resources.

Frontend Rules:

- Use script setup lang="ts".
- Use Composition API.
- Use Pinia.
- Never use Options API.
- Never use any type.
- Never use jQuery.
- Prefer reusable components.

UI:

- Use shadcn-vue components.
- Use Tailwind CSS v4.
- Support dark mode.
- Support responsive layouts.

Naming:

Services:

PropertyService
TenantService
LeaseService

Requests:

StorePropertyRequest
UpdatePropertyRequest

Enums:

PropertyTypeEnum
InvoiceStatusEnum

Pages:

Index.vue
Create.vue
Edit.vue
Show.vue

Code Quality:

- SOLID principles.
- DRY principles.
- Strong TypeScript typing.
- Avoid duplicate code.
- Follow Laravel 13 best practices.
- Generate maintainable code.

Testing:

Use Pest.

Every feature should include:

- Feature tests
- Unit tests

Never place business logic inside Vue components.

Never place business logic inside controllers.

Always follow the documents inside docs/.