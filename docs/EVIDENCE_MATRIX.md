# Evidence Matrix (Feature Claims to Code)

## 1. Purpose
Map major product and operational claims to concrete source evidence for QA, engineering review, and audit traceability.

## 2. Matrix
| Claim | Primary Evidence | Secondary Evidence | Verification Method | Status |
| --- | --- | --- | --- | --- |
| Catalog and merchandising domain exists | app/Models/Product.php | routes/admin/routes.php | Browse product CRUD/controller routes and model relations | Verified |
| Cart and checkout workflow exists | app/Services/CartService.php | routes/web/routes.php | Execute add-to-cart and checkout route flow in test/stage | Verified |
| Order lifecycle and status tracking exists | app/Models/Order.php | app/Models/OrderStatusHistory.php | Confirm status write/read in order processing flow | Verified |
| Lot-wise inventory reservation/release is implemented | app/Services/Inventory/LotInventoryService.php | app/Utils/order-manager.php | Unit/feature tests for reserve and release paths | Verified |
| Lot allocations are linked to order details | app/Models/OrderDetail.php | app/Models/Inventory/InventoryLotAllocation.php | Inspect relation loading and persisted allocation rows | Verified |
| Product and GRN lot visibility exists in UI | resources/views/admin-views/product/view.blade.php | resources/views/admin-views/purchase/grns/show.blade.php | Render page with lot-backed data and verify fields | Verified |
| Sales order detail lot visibility exists (admin/vendor) | resources/views/admin-views/order/order-details.blade.php | resources/views/vendor-views/order/order-details.blade.php | Open order with split allocations and verify view output | Verified |
| Single-vendor and multi-vendor operation is supported | app/Http/Controllers/Admin/Settings/VendorSettingsController.php | app/Http/Controllers/RestAPI/v1/ConfigController.php | Toggle seller_registration/business mode and verify behavior | Verified |
| Purchase module is feature-flag driven | config/purchase.php | routes/admin/routes.php | Enable/disable flag and validate route/module behavior | Verified |
| Finance features are feature-flag driven | config/finance_features.php | app/Models/Finance/FinanceJournal.php | Validate feature toggles against finance menu/routes | Verified |
| Payment integration surface includes multiple gateways | app/Http/Controllers/Payment_Methods/ | routes/web/routes.php | Verify payment route groups and callback endpoints | Verified |
| API v2 is legacy and v3 is active seller surface | routes/rest_api/v2/api.php | routes/rest_api/v3/seller.php | Confirm v2 legacy marker and v3 route breadth | Verified |
| ProductStock is legacy placeholder, not stock authority | app/Models/ProductStock.php | docs/ADR_PRODUCTSTOCK_STATUS.md | Confirm model minimality and ADR decision | Verified |
| Operational runbook exists for queue/payment/order incidents | docs/OPERATIONS_RUNBOOK.md | config/queue.php | Review runbook against command and code references; execute schedule/list and queue failed checks | Verified |
| API deprecation migration schedule is documented | docs/API_DEPRECATION_PLAN.md | routes/rest_api/v3/seller.php | Review versioned schedule and compatibility checklist | Verified |

## 3. Usage Notes
- Update this matrix when adding or removing major features, modules, or route surfaces.
- Prefer exact file-level evidence tied to current runtime behavior.
- Keep status aligned with automated tests and QA verification results.
