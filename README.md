Project Overview
Users
1. Landlord / Property Owner

Manages properties, tenants, payments, contracts, and reports.

2. Tenant

Can log in and:

View rental details
Pay rent
Download receipts
Submit maintenance requests
Receive announcements
3. Staff / Property Manager (optional)

Assists the owner in managing tenants and payments.

Property Types
Apartment

Payment is room-based.

Example:

Sunrise Apartment
├── Room 101
├── Room 102
├── Room 103

Each room has:

Monthly rent
Occupancy status
Tenant assignment
Utility charges
Building

Payment may be by:

Entire building
Floor
Unit

Example:

Commercial Building
├── Unit A
├── Unit B
├── Unit C
House

Single tenant.

Boarding House / Dormitory

Similar to apartment but with beds or spaces.

Core Modules
1. Authentication
Owner
Login
Register
Forgot password
Two-factor authentication
Tenant Portal
Login
Change password
Update profile
Staff Roles
Admin
Property Manager
Accountant

Use:

Laravel Breeze + Inertia + Vue + TypeScript
2. Property Management

Properties contain:

Property
- name
- type
- address
- description
- images
- status

Property types:

Apartment
Building
House
Boarding House

Features:

Add/Edit/Delete property
Gallery
Map location
Occupancy percentage
3. Units / Rooms

Every property can contain units.

Unit
- property_id
- unit_number
- floor
- size
- monthly_rent
- deposit
- status

Status:

Available
Occupied
Reserved
Under Maintenance
4. Tenant Management
Tenant
- first_name
- last_name
- email
- phone
- emergency_contact
- profile_photo

Features:

Upload ID
Occupancy history
Multiple tenants per unit
Family members
5. Lease Agreements
Lease
- tenant_id
- unit_id
- start_date
- end_date
- monthly_rent
- security_deposit

Features:

Renew lease
Terminate lease
Upload signed contract
Lease history
6. Billing Module

Generate:

Monthly Rent

Automatically.

Additional charges:

Water
Electricity
Internet
Parking
HOA dues
Penalties

Invoice:

Invoice
- due date
- amount
- status

Statuses:

Pending
Paid
Overdue
Partial
7. Online Payment Module

Tenant can pay through:

GCash
Maya
Bank Transfer
Stripe
PayPal

Payment statuses:

Pending
Paid
Failed

Features:

Upload proof of payment
Automatic receipt generation
Payment history
8. Utility Meter Reading

Per unit:

Electric Meter
Water Meter

Monthly:

Previous reading
Current reading
Consumption
Amount

Automatically added to bills.

9. Maintenance Requests

Tenant can submit:

Plumbing
Electrical
Cleaning
Other concerns

Priority:

Low
Medium
High

Status:

Open
In Progress
Completed

Can upload photos.

10. Notifications

Email notifications:

Upcoming rent
Overdue rent
Payment received
Lease expiration

In-app notifications:

Announcements
Maintenance updates
11. Announcement Board

Owner posts:

Water interruptions
Holidays
Building rules
Maintenance schedules

Visible to tenants.

12. Dashboard
Landlord Dashboard

Cards:

Total properties
Occupied units
Vacant units
Monthly income
Overdue payments

Charts:

Revenue
Occupancy rate
Collection history
Tenant Dashboard

Shows:

Current unit
Monthly rent
Due date
Outstanding balance
Recent payments
13. Reports

Generate:

Income Reports

Daily

Monthly

Yearly

Occupancy Reports

Vacancy rate

Collection Reports

Paid vs overdue

Export:

Excel
PDF
CSV
14. Receipt Generation

Automatic PDF receipt.

Contains:

Invoice number
Tenant
Unit
Payment method
Date paid
15. Expense Tracking

Track:

Repairs
Utilities
Taxes
Maintenance costs

Profit dashboard:

Income - Expenses = Net Profit
16. Move-In / Move-Out

Track:

Deposit
Inspection checklist
Damages
Refund amount
17. Visitor Logs (optional)

Useful for apartments.

Track:

Visitor name
Unit visited
Date/time
18. Document Management

Store:

Lease agreements
IDs
Receipts
Permits
19. Audit Logs

Track who changed:

Payments
Tenants
Rent amounts
20. Multi-Property Support

One landlord can manage:

Property A
Property B
Property C

Each property has its own:

Rooms
Tenants
Income
Advanced Features
QR Code Payment

Tenant scans QR code and uploads receipt.

SMS Notifications

Via:

Twilio
Semaphore
Vonage
E-Signature

For lease agreements.

Calendar

View:

Due dates
Expiring contracts
Maintenance schedules
AI Assistant

Can answer:

"Who has overdue rent?"

"Show income for May."

Reservation Module

Potential tenants can reserve units online.

Vacancy Listing Website

Public-facing site:

example.com

Shows:

Available units
Photos
Pricing
Contact form
Suggested Database Structure
users
roles

properties
property_types

units

tenants

leases

invoices
invoice_items

payments

meter_readings

maintenance_requests

announcements

expenses

documents

notifications

audit_logs
Recommended Development Roadmap
Phase 1 (MVP)

✔ Authentication

✔ Properties

✔ Units/Rooms

✔ Tenant Management

✔ Lease Agreements

✔ Billing

✔ Payment Recording

✔ Tenant Portal

✔ Dashboard

Phase 2

✔ Utility Meter Reading

✔ Maintenance Requests

✔ Notifications

✔ PDF Receipts

✔ Reports

✔ Expense Tracking

Phase 3

✔ Online Payments (GCash, Maya, Stripe)

✔ Public Vacancy Website

✔ Reservation System

✔ Calendar

✔ E-signature

Phase 4

✔ Multi-tenant SaaS

Allow multiple landlords to subscribe.

Plans:

Free
Basic
Premium

Each landlord gets:

Organization
    ├── Properties
    ├── Units
    ├── Tenants
    ├── Staff