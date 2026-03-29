# API Deprecation Plan: REST API v2 to v3 (Seller)

## 1. Purpose
Define a controlled deprecation and migration path from legacy seller API v2 to seller API v3.

## 2. Current State
- Legacy API v2 is explicitly marked as old in routes/rest_api/v2/api.php with the header: Old Seller Mobile APP API Routes.
- Current seller API surface is maintained in routes/rest_api/v3/seller.php.

## 3. Scope
In scope:
- Seller mobile app endpoints under /api/v2/seller/* and related legacy workflow paths.
- Migration to /api/v3/seller/* equivalents.

Out of scope:
- Customer-facing v1 APIs.
- Internal admin web routes.

## 4. Migration Strategy
## Phase A: Stabilize and Communicate
- Keep v2 operational but frozen (no new features).
- Add release-note notices for v2 deprecation and v3 adoption.
- Publish endpoint mapping and behavior differences.

## Phase B: Client Migration Window
- Migrate active clients to v3 by module:
  1. Auth and profile
  2. Products
  3. Orders
  4. Shipping and chat
  5. Delivery and POS
- Track migration via client version telemetry and error logs.

## Phase C: Soft Deprecation
- Add deprecation response headers on v2 endpoints.
- Monitor v2 traffic and identify holdout clients.
- Enforce stricter support SLAs for v2 incidents.

## Phase D: Retirement
- Disable v2 write endpoints first, then read endpoints.
- Archive v2 route file and controller set after freeze period.

## 5. Endpoint Mapping (High-Level)
Auth:
- v2: /api/v2/seller/auth/*
- v3: /api/v3/seller/auth/*

Seller profile and account:
- v2: /api/v2/seller/seller-info, /shop-info, /transactions
- v3: /api/v3/seller/seller-info, /shop-info, /transactions

Products:
- v2: /api/v2/seller/products/*
- v3: /api/v3/seller/products/* (expanded set including details, quantity-update, restock endpoints)

Orders:
- v2: /api/v2/seller/orders/*
- v3: /api/v3/seller/orders/* (includes address-update and parity updates)

Shipping:
- v2: /api/v2/seller/shipping/* and /shipping-method/*
- v3: /api/v3/seller/shipping/* and /shipping-method/*

Chat:
- v2: /api/v2/seller/messages/*
- v3: /api/v3/seller/messages/*

POS and Delivery:
- v3 adds stronger seller POS and delivery management surface under /api/v3/seller/pos/* and /delivery-man/*.

## 6. Compatibility Rules
- No breaking changes added to v2.
- Any bugfixes in shared logic should be validated against both versions during migration window.
- New seller features land only on v3.

## 7. Rollout Checklist
- Publish migration notice and deadline.
- Share endpoint mapping with app teams.
- Add automated API smoke tests for v3 critical paths.
- Monitor:
  - v2 request volume
  - v2 error rate
  - v3 adoption rate
- Execute staged retirement after traffic threshold is met.

## 8. Versioned Migration Schedule (App + API)
This schedule gives release-bound checkpoints so engineering, QA, and mobile teams can track a single migration calendar.

| Window | Platform Release | Required Action | Owner | Exit Criteria |
| --- | --- | --- | --- | --- |
| 2026-04-01 to 2026-04-15 | v2026.04-R1 | Publish v2 deprecation notice in release notes and integration docs; freeze v2 feature scope. | Backend + Product | Public notice issued and acknowledged by integration owners. |
| 2026-04-16 to 2026-05-10 | v2026.05-R1 | Migrate active seller app flows to v3 (auth, products, orders, shipping/chat). | Mobile + Backend | At least 70% seller API traffic on v3. |
| 2026-05-11 to 2026-05-31 | v2026.05-R2 | Enable v2 deprecation headers and intensified monitoring; run contract parity checks. | Backend + QA | Zero P1 parity defects and at least 90% seller API traffic on v3. |
| 2026-06-01 to 2026-06-15 | v2026.06-R1 | Soft retirement: disable v2 write endpoints for non-whitelisted clients. | Backend + SRE | No business-critical incident from write-path disablement. |
| 2026-06-16 to 2026-06-30 | v2026.06-R2 | Full retirement: disable remaining v2 reads, archive v2 route/controller surface. | Backend | v2 traffic reduced to approved internal test traffic only (or 0). |

Client communication deadlines:
- 2026-04-05: First external/internal migration bulletin.
- 2026-05-15: Mid-window reminder with holdout client list.
- 2026-06-10: Final cutoff notice before hard retirement.

## 9. v3 Compatibility Checklist
- Auth parity verified: token issue/refresh/logout/login flows validated against v3 seller auth endpoints.
- Seller profile parity verified: seller info, shop info, and transaction reads match expected payload contract.
- Product parity verified: create/update/list/details and quantity/restock endpoints validated in v3.
- Order lifecycle parity verified: list/details/status transition/address update work with current seller mobile app behavior.
- Shipping and chat parity verified: shipping-method and seller message endpoints are stable for production usage.
- POS and delivery modules validated where enabled by business configuration.
- Monitoring hooks active: dashboards/alerts for v2 traffic, v3 errors, and migration adoption.
- Rollback policy documented for each rollout stage.

## 10. Risks and Mitigations
Risk: Mobile clients pinned to v2.
Mitigation: Version gates, in-app upgrade prompts, and communication cadence.

Risk: Behavioral drift between v2 and v3 during migration.
Mitigation: Contract tests for core seller flows (login, product update, order status, payout actions).

## 11. Success Criteria
- 0 critical seller clients remaining on v2 before retirement.
- v3 handles full seller workflow with no parity blockers.
- v2 route set can be retired without production incident.

## 12. Evidence References
- routes/rest_api/v2/api.php
- routes/rest_api/v3/seller.php
