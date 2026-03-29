# Shutar Shawpno Product Specification

## 1. Document Metadata
- Product: Shutar Shawpno
- Type: Single-vendor and multi-vendor e-commerce and operations platform
- Codebase: Laravel monolith with web, admin, vendor, and REST API surfaces
- Specification date: 2026-03-29

## 2. Product Vision
Shutar Shawpno is a commerce platform that combines customer storefront experience, vendor marketplace operations, administrative governance, procurement/purchase flows, finance posting, and delivery operations in one system.

The platform already supports both direct in-house selling and third-party sellers, with integrated order lifecycle tracking and lot-wise inventory control. The application includes both single-vendor (in-house only) and multi-vendor (in-house + third-party sellers) operating modes.

## 3. Stakeholders and User Roles
- Customer: Browses catalog, places orders, tracks delivery, manages wallet/loyalty, creates refund/support requests.
- Seller/Vendor (when enabled): Manages shop and products, fulfills orders, tracks payouts and reports.
- Admin: Operates marketplace configuration, catalog governance, finance, promotions, and operations.
- Deliveryman: Executes deliveries and cash collection workflows.
- Procurement/Back-office: Manages requisitions, purchase orders, invoices, GRN, and returns.

## 4. Product Scope
### In Scope
- B2C storefront and checkout.
- Built-in single-seller (in-house) and multi-seller marketplace operations.
- Order, payment, and fulfillment workflows.
- Lot-wise inventory tracking and stock reservation.
- Procurement lifecycle (requisition -> purchase order -> invoice -> GRN -> return).
- Finance and ledger-adjacent posting features.
- Delivery and wallet workflows.
- Versioned mobile/API endpoints.

### Out of Scope
- Native mobile app source code (API support exists in this repository).
- Microservice decomposition (current architecture is monolithic Laravel).

## 5. Functional Features List

### 5.1 Catalog and Merchandising
- Category, subcategory, brand, attribute, and color driven catalog.
- Product types include physical and digital variants.
- Product SEO metadata and product comparison.
- Promotions: flash deal, featured deal, deal of the day, stock clearance, coupons.
- Review and review reply flows.

Evidence
- app/Models/Product.php
- app/Models/Category.php
- app/Models/Brand.php
- app/Models/FlashDeal.php
- app/Models/StockClearanceProduct.php
- routes/admin/routes.php

### 5.2 Cart and Checkout
- Cart management with quantity updates and selected-cart operations.
- Checkout stages for details, shipping, payment, and completion.
- Shipping method selection per seller/order context.
- Coupon/offline payment support.

Evidence
- app/Models/Cart.php
- app/Services/CartService.php
- routes/web/routes.php
- routes/rest_api/v1/api.php

### 5.3 Order Management
- Order placement and order detail lifecycle.
- Order status histories and transaction records.
- Offline payment order handling.
- Order status updates trigger inventory and wallet side effects.

Evidence
- app/Models/Order.php
- app/Models/OrderDetail.php
- app/Models/OrderStatusHistory.php
- app/Models/OrderTransaction.php
- app/Utils/order-manager.php

### 5.4 Lot-Wise Inventory (Core)
- Inventory lots are created from accepted GRN items.
- FIFO-like reservation from available lots for each order detail.
- Allocation persistence per order detail with unit purchase/sale profit metadata.
- Release process restores quantity and marks allocations released.
- Product current stock is refreshed from lot availability sums.

Evidence
- app/Models/Inventory/InventoryLot.php
- app/Models/Inventory/InventoryLotAllocation.php
- app/Services/Inventory/LotInventoryService.php
- app/Utils/order-manager.php

### 5.5 Purchase and GRN Operations
- Purchase module is feature-flagged.
- Workflows include vendor, requisition, purchase order, invoice, GRN, and returns.
- Approval route and approval step models support gated workflows.

Evidence
- config/purchase.php
- app/Models/Purchase/PurchaseRequisition.php
- app/Models/Purchase/PurchaseOrder.php
- app/Models/Purchase/PurchaseInvoice.php
- app/Models/Purchase/PurchaseGrn.php
- routes/admin/routes.php

### 5.6 Finance Features
- Finance features toggled by environment-driven flags.
- Payment account mapping and aliasing for GL-like account destinations.
- Finance entities include account, journal, journal rows, transfer, expense, reconciliation.

Evidence
- config/finance_features.php
- config/payment_accounts.php
- app/Models/Finance/FinanceAccount.php
- app/Models/Finance/FinanceJournal.php
- app/Models/Finance/FinanceTransfer.php
- routes/admin/routes.php

### 5.7 Payments and Gateway Integrations
- Multiple gateway controllers are present for global/regional payment methods.
- Includes Stripe, PayPal, SSLCommerz, RazorPay, Paytm, Bkash, Paystack, Flutterwave, LiqPay, Mercado Pago, Paymob, Paytabs, and SenangPay.

Evidence
- app/Http/Controllers/Payment_Methods/
- routes/web/routes.php
- composer.json

### 5.8 Customer Account and Support
- Customer account profile/address/order views.
- Wallet and loyalty flows.
- Ticketing and customer-vendor chat features.
- Restock requests supported in API and web flows.

Evidence
- routes/web/routes.php
- routes/rest_api/v1/api.php
- app/Models/CustomerWallet.php
- app/Models/SupportTicket.php
- app/Models/Chatting.php

### 5.9 Vendor and Admin Operations
- Vendor-facing product/order/report management (active in multi-vendor mode).
- Admin dashboard includes catalog, promotions, order operations, delivery, settings, finance, and purchase modules.

Evidence
- routes/vendor/routes.php
- routes/admin/routes.php
- resources/views/vendor-views/
- resources/views/admin-views/

### 5.10 Delivery and Logistics
- Deliveryman entities and related wallet/transaction models.
- Delivery country/zip restrictions and shipping method controls.
- Deliveryman cash collect and withdraw flows in admin routes.

Evidence
- app/Models/DeliveryMan.php
- app/Models/DeliveryManTransaction.php
- app/Models/DeliverymanWallet.php
- app/Models/DeliveryCountryCode.php
- app/Models/DeliveryZipCode.php
- routes/admin/routes.php

## 6. API and Route Surface

### Web
- Customer storefront, product details, search, checkout, track order, wishlist, profile, refunds, support.
- Route source: routes/web/routes.php

### Admin
- Feature-rich operational area under admin middleware including POS, purchase, finance, promotions, delivery, reports.
- Route source: routes/admin/routes.php

### Vendor
- Seller dashboard and operations under vendor route group when vendor mode is enabled.
- Route source: routes/vendor/routes.php

### REST API
- Versioned API under /api/v1, /api/v2, /api/v3 with auth, catalog, cart, order, shipping, customer, and notifications.
- API v2 is marked as legacy ("Old Seller Mobile APP API Routes") and retained for backward compatibility.
- Route sources: routes/rest_api/v1/api.php, routes/rest_api/v2/api.php, routes/rest_api/v3/seller.php

## 7. Non-Functional Requirements
- Availability: support business-critical order and payment operations with robust queue/worker uptime.
- Data integrity: preserve transactional consistency for order placement and inventory reservation.
- Security: role-based access, token-based auth for API, secure payment callback handling.
- Performance: optimize heavy listing routes (products/orders/reports) with pagination and query tuning.
- Auditability: maintain order/transaction/history tables for operational traceability.
- Maintainability: service/repository split and modular route files should remain the primary extension points.

## 8. Configuration and Feature Flags
- Purchase module toggle: FEATURE_PURCHASE_MODULE (config/purchase.php).
- Finance defaults and feature toggles: FINANCE_FEATURE_* (config/finance_features.php).
- Finance payment account mapping and aliases: config/payment_accounts.php.
- Vendor onboarding control: seller_registration business setting controls seller onboarding/registration flow while the application supports both single-vendor and multi-vendor operations.
- Vendor mode evidence: app/Http/Controllers/Admin/Settings/VendorSettingsController.php, app/Http/Controllers/RestAPI/v1/ConfigController.php, app/Http/Controllers/Vendor/Auth/RegisterController.php.
- Core runtime and DB settings: .env, config/app.php, config/database.php.

## 9. Architecture Diagram (Mermaid)

```mermaid
flowchart TB
    U[Customer Web] --> WEB[Web Routes and Controllers]
    V[Vendor Panel (Optional)] --> VENDOR[Vendor Routes and Controllers]
    A[Admin Panel] --> ADMIN[Admin Routes and Controllers]
    M[Mobile or External Client] --> API[REST API v1/v2/v3]

    WEB --> APP[Application Layer\nServices + Utils + Repositories]
    VENDOR --> APP
    ADMIN --> APP
    API --> APP

    APP --> ORDER[Order Domain\nOrder, OrderDetail, OrderTransaction]
    APP --> CATALOG[Catalog Domain\nProduct, Category, Brand, Promotions]
    APP --> PURCHASE[Purchase Domain\nRequisition, PO, Invoice, GRN, Returns]
    APP --> INVENTORY[Inventory Domain\nInventoryLot, InventoryLotAllocation]
    APP --> FINANCE[Finance Domain\nAccounts, Journals, Transfers, Reconciliation]
    APP --> DELIVERY[Delivery Domain\nDeliveryMan, Shipping, Restrictions]
    APP --> CRM[Support and Engagement\nChat, Ticket, Notification, Loyalty, Wallet]

    PURCHASE --> INVENTORY
    ORDER --> INVENTORY
    ORDER --> FINANCE
    DELIVERY --> FINANCE
    CRM --> ORDER

    INVENTORY --> DB[(MySQL Database)]
    ORDER --> DB
    CATALOG --> DB
    PURCHASE --> DB
    FINANCE --> DB
    DELIVERY --> DB
    CRM --> DB

    APP --> QUEUE[Queue Jobs\nEmail and background tasks]
    APP --> EVT[Events and Listeners]

    APP --> PAY[Payment Gateway Controllers]
    PAY --> EXT_PAY[External Payment Providers]

    APP --> PUSH[Push and OTP Services]
    PUSH --> EXT_PUSH[Firebase or SMS providers]

    APP --> FILES[File and Media Storage]
    FILES --> EXT_S3[AWS S3 or local storage]
```

## 10. Data Model Highlights
- Product stock is maintained through Product.current_stock and lot aggregation; ProductStock model exists but is minimal/legacy.
- InventoryLot <-> InventoryLotAllocation <-> OrderDetail.
- PurchaseGrn and PurchaseGrnItem can generate inventory lots.
- Order and OrderDetail flows update stock via lot reservation/release logic.
- Finance entities are separate under app/Models/Finance with dedicated controllers/services.

## 11. Risks and Design Considerations
- Monolith complexity: high coupling risk across order, inventory, and finance side effects.
- Callback reliability: payment gateway callback variance requires strict validation and idempotency checks.
- Queue dependency: delayed workers can affect notifications and async jobs.
- Lot consistency: cancellation/return paths must always release allocations and sync product stock.
- Test isolation: test DB driver differences can break flows that assume tables present.

## 12. Acceptance Criteria for This Specification
- Includes end-to-end feature inventory from customer, vendor, admin, purchase, inventory, and finance domains.
- Includes architecture diagram covering route entry points, app layer, domains, data store, and external integrations.
- Lists concrete evidence files so engineering and product teams can trace each feature area.
