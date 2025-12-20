Purchase Linking with Product Milestone

Phase 1 · Week 1-2 · Catalog-Aware Line Items
- Replace the free-text product_id inputs in requisition, PO, and GRN forms with a Select2 dropdown that searches /admin/product/search (or a new dedicated endpoint returning id, SKU, name, UOM, price).
- Persist selected product metadata (SKU, default UOM, last purchase price) into hidden fields so the line renders even if JS fails.
- Backend validation: update controllers to require items.*.product_id and ensure it exists in products.

Phase 2 · Week 3 · Auto-Fill & Sync Logic
- On selection, auto-fill description, UOM, and unit price with the product defaults while allowing manual overrides.
- Store these defaults on the PO line (metadata column already exists) for audit purposes.
- Ensure GRN line initialization pulls the linked product automatically; disallow GRN line items without product_id.

Phase 3 · Week 4 · Inventory & Cost Updates
- After GRN approval, update the product’s purchase_price using a chosen costing rule (latest cost or weighted average).
- Extend InventorySyncService to record both quantity and the cost used so valuation snapshots align with finance.

Phase 4 · Week 5 · API & UX Enhancements
- Create a reusable product-lookup endpoint (pagination, search by SKU/name, optional vendor filter).
- Build a small Vue/Alpine component (or vanilla JS) wrapping Select2 initialization, caching results, and handling edge cases (product deleted, network errors).
- Add server-side fallbacks (e.g., if Select2 fails, users can paste a SKU and hit a “lookup” button).

Phase 5 · Week 6 · Testing & Rollout
- Feature tests covering form validation (missing/invalid product IDs) and GRN approval stock increments.
- Manual QA checklist: create PO → GRN → confirm products.current_stock and purchase_price both change.
- Migration/seed script to backfill existing PO/GRN lines with correct product_id where matchable.
