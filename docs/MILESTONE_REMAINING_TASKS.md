# Shutar Shawpno Milestone Plan (Remaining Work)

## 1. Purpose
This milestone plan is derived from a codebase review against docs/PRODUCT_SPECIFICATION.md. It captures what is already implemented and what remains to reach production-grade completeness.

## 2. Current Status Snapshot

### Completed (Implemented in Code)
- Core commerce domains are present: catalog, cart, checkout, order, vendor/admin operations, purchase, finance, delivery, support.
- Lot-wise inventory engine is implemented with reserve/release flow and allocation records.
- Single-vendor and multi-vendor operation is supported with seller onboarding controls.
- Purchase and finance feature flags are implemented in configuration.
- Payment integration surface includes 13 gateway controllers.
- API versions v1/v2/v3 exist, with v2 clearly marked legacy.

### Partially Completed (Functional but Not Fully Closed)
- Lot-level data is now visible on product, GRN, and admin/vendor sales order detail pages; translation key verification and scenario validation are still pending.
- Automated tests exist but are very limited relative to module breadth (finance-only depth, minimal feature coverage).
- ProductStock model exists but appears legacy/minimal while stock is driven by Product.current_stock + lot aggregation.

## 3. Evidence Basis (Code References)
- Lot reserve/release flow: app/Services/Inventory/LotInventoryService.php
- Lot hooks during order lifecycle: app/Utils/order-manager.php
- Order detail relation to allocations: app/Models/OrderDetail.php
- Product lot view (admin/vendor): resources/views/admin-views/product/view.blade.php, resources/views/vendor-views/product/view.blade.php
- GRN lot fields and views: resources/views/admin-views/purchase/grns/show.blade.php
- Sales order detail pages (missing lot visibility): resources/views/admin-views/order/order-details.blade.php, resources/views/vendor-views/order/order-details.blade.php
- Vendor mode setting exposure: app/Http/Controllers/Admin/Settings/VendorSettingsController.php, app/Http/Controllers/RestAPI/v1/ConfigController.php
- Feature flags: config/purchase.php, config/finance_features.php
- Payment controllers: app/Http/Controllers/Payment_Methods/
- Legacy API v2 marker: routes/rest_api/v2/api.php
- Legacy ProductStock model: app/Models/ProductStock.php
- Existing tests: tests/Feature/, tests/Unit/

## 4. Remaining Work by Phase

### Phase 1 Progress Update (2026-03-29)
- Completed: Added lot allocation rendering in admin sales order detail view.
- Completed: Added lot allocation rendering in vendor sales order detail view.
- Completed: Added eager-loading for lot allocation relations in admin/vendor order detail controllers.
- Completed: Added/verified English language keys for lot allocation labels (lot_allocations, batch_number, released).
- Completed: Functional readiness verification executed for split-lot and released-allocation scenarios (code paths/UI conditions validated).
- Note: Current database snapshot has no allocation rows yet (active/released/split-lot = 0), so scenario confirmation now depends on real transactional data generation.

## Phase 1: Inventory Traceability Completion (High Priority)
Objective: Close the lot-wise visibility gap in sales operations.

Tasks
- [x] Add lot allocation display per order line in admin sales order details.
- [x] Add lot allocation display per order line in vendor sales order details.
- [x] Ensure order detail controllers eager-load lot allocations and lot references (lot number, batch number, quantity allocated, released status).
- [x] Add translation keys and UI formatting for lot-related labels.

Deliverables
- Updated admin and vendor order detail blades with lot breakdown tables/chips.
- Controller/query updates to avoid N+1 loading.

Acceptance Criteria
- For an order with split allocations across multiple lots, both admin and vendor order detail pages show all allocations correctly.
- Released allocations are visibly distinguishable from active allocations.
- No regression in order detail page performance under standard pagination/load.

## Phase 2: Reliability and Automated Test Coverage (High Priority)
Objective: Protect critical workflows with automated validation.

### Phase 2 Progress Update (2026-03-29)
- Completed: Added unit test suite for LotInventoryService covering createLotFromGrnItem, assertSufficientStock, reserveForOrderDetail, and releaseForOrderDetail.
- Completed: Executed targeted test run for LotInventoryService (4 tests passed).
- Completed: Added feature test for order placement/cancel allocation behavior.
- Completed: Added feature tests for single-vendor vs multi-vendor behavior using seller_registration setting.
- Completed: Added guest checkout regression test validating guest_users creation and session persistence.
- Completed: Executed consolidated Phase 2 test batch (8 tests, 42 assertions, all passed).
- Status: Phase 2 completed.

Tasks
- [x] Add unit tests for LotInventoryService methods:
  - createLotFromGrnItem
  - assertSufficientStock
  - reserveForOrderDetail
  - releaseForOrderDetail
- [x] Add feature tests for order placement/cancel flows ensuring lot allocation and release are correct.
- [x] Add feature tests for single-vendor vs multi-vendor behavior using seller_registration setting.
- [x] Add regression test for guest checkout flow requiring guest_users table.

Deliverables
- New test classes under tests/Unit/Inventory and tests/Feature/Order.
- Updated factories/seeders for inventory lot and order detail test setup.

Acceptance Criteria
- CI/local test run includes inventory and mode tests with deterministic pass.
- Critical order+inventory paths have automated coverage for success and failure cases.

## Phase 3: Platform Hygiene and Legacy Surface Management (Medium Priority)
Objective: Reduce ambiguity and technical debt.

### Phase 3 Progress Update (2026-03-29)
- Completed: ProductStock strategy decision documented (Option A: legacy placeholder, lot-based stock remains source of truth).
- Completed: API deprecation and migration plan drafted for v2 -> v3 seller APIs.
- Completed: Added versioned v2 -> v3 migration schedule with owner/exit criteria and client communication deadlines.
- Completed: Added v3 compatibility checklist tied to migration rollout gates.
- Completed: Added explicit legacy/deprecation code comment on Product::stocks() relation to remove stock model ambiguity.
- Status: Phase 3 completed.

Tasks
- [x] Decide ProductStock strategy:
  - Option A: deprecate/remove references and document as legacy.
  - Option B: implement proper fields/relations and align with current stock model.
- [x] Add explicit API deprecation notice for v2 in technical docs and integration notes.
- [x] Add compatibility/migration guidance to v3 seller APIs.

Deliverables
- ADR/doc note for ProductStock status. Done: docs/ADR_PRODUCTSTOCK_STATUS.md
- API deprecation document section and migration checklist. Done: docs/API_DEPRECATION_PLAN.md

Acceptance Criteria
- No ambiguous stock model messaging in docs/code comments.
- External/internal teams have clear v2->v3 migration guidance.

## Phase 4: Operational Readiness (Medium Priority)
Objective: Improve maintainability and production confidence.

### Phase 4 Progress Update (2026-03-29)
- Completed: Created operational runbook covering queue health, scheduler checks, payment callback incident response, and order-status anomaly handling.
- Completed: Added baseline monitoring checklist inside the operations runbook.
- Completed: Created evidence matrix mapping major product claims to source files.
- Completed: Executed operational readiness verification (`php artisan schedule:list`, `php artisan queue:failed`) and recorded evidence.
- Status: Phase 4 completed.

Tasks
- [x] Add queue/scheduler health checklist and runbook for notification/order side-effects.
- [x] Add baseline monitoring checklist for payment callback failures and order status anomalies.
- [x] Add a verified evidence matrix in product docs mapping each major feature claim to source files.

Deliverables
- docs/OPERATIONS_RUNBOOK.md (completed)
- docs/API_DEPRECATION_PLAN.md (completed in Phase 3)
- docs/EVIDENCE_MATRIX.md (completed)

Acceptance Criteria
- On-call/runbook includes actionable steps for queue, scheduler, and payment incident handling.
- Product documentation is traceable and auditable by engineering and QA.

## 5. Suggested Execution Order
1. Phase 1
2. Phase 2
3. Phase 3
4. Phase 4

Rationale
- Phase 1 closes business-visible gaps in lot traceability.
- Phase 2 prevents regressions in order/inventory behavior.
- Phases 3-4 improve long-term maintainability and operational maturity.

## 6. Definition of Done (Overall)
- Sales and inventory traceability is visible end-to-end in UI and data.
- Core inventory and order workflows are test-covered.
- Legacy/compatibility surfaces are clearly documented and controlled.
- Documentation aligns with actual runtime behavior and configuration-driven modes.
