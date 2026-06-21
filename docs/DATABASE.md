# Database

## Tables

users

roles

properties

units

tenants

leases

invoices

invoice_items

payments

expenses

maintenance_requests

meter_readings

documents

announcements

notifications

audit_logs

---

## Relationships

Property

hasMany Units

---

Unit

belongsTo Property

hasMany Leases

---

Tenant

hasMany Leases

hasMany Payments

---

Lease

belongsTo Tenant

belongsTo Unit

hasMany Invoices

---

Invoice

belongsTo Lease

hasMany Payments

---

Payment

belongsTo Invoice

---

MaintenanceRequest

belongsTo Tenant

belongsTo Unit
