# Operations Runbook (Queue, Scheduler, Payments, Order Incidents)

## 1. Purpose
Provide a practical incident-response playbook for queue health, scheduler readiness, payment callback failures, and order status anomalies.

## 2. Scope
In scope:
- Queue worker health and failed job handling.
- Scheduler process validation.
- Payment callback troubleshooting and recovery steps.
- Order status/inventory side-effect anomaly handling.

Out of scope:
- Infrastructure-level host/network outage runbooks.
- Database restore/disaster-recovery procedures.

## 3. Roles and Ownership
- Incident Commander (IC): Coordinates timeline and communication.
- Backend On-call: Executes application diagnostics/remediation.
- QA Support: Verifies customer-impacting flow recovery.
- Product/Support: Stakeholder and customer communication.

## 4. Severity and Response Targets
- Sev-1: Checkout/payment cannot complete for active users. Target acknowledgment <= 10 minutes.
- Sev-2: Partial degradation (single gateway, delayed queue jobs). Target acknowledgment <= 30 minutes.
- Sev-3: Low-impact anomaly with workaround. Target acknowledgment <= 4 hours.

## 5. Queue Health Checklist
Evidence references:
- config/queue.php
- app/Console/Kernel.php
- app/Jobs/

### 5.1 Immediate Checks
1. Confirm queue connection mode from environment and config.
2. Check worker process availability and restart if required.
3. Inspect failed jobs table volume and recency.

### 5.2 Commands
Use these from project root:

```bash
php artisan queue:work --tries=3 --timeout=90
php artisan queue:failed
php artisan queue:retry all
php artisan queue:flush
```

Operational notes:
- Only run `queue:flush` with IC approval because it removes failed job history.
- Prefer targeted retries before retrying all jobs.

### 5.3 Recovery Pattern
1. Pause noisy upstream traffic if available (for repeated poison messages).
2. Retry a small failed-job sample and verify business effect.
3. Resume worker pool and monitor new failures for 15-30 minutes.

## 6. Scheduler Readiness Checklist
Evidence reference:
- app/Console/Kernel.php

Current codebase note:
- `schedule()` currently has no active scheduled commands.

Actions:
1. Validate host-level cron/scheduler invocation exists where deployment expects scheduling.
2. Keep this checklist active for future scheduled commands to prevent silent drift.

Command:

```bash
php artisan schedule:list
php artisan schedule:run
```

## 7. Payment Callback Failure Runbook
Evidence references:
- routes/web/routes.php
- app/Http/Controllers/Payment_Methods/
- app/Models/Order.php
- app/Models/OrderTransaction.php

### 7.1 Affected Callback Surface (Examples)
- /payment/sslcommerz/success|failed|canceled
- /payment/paytm/response
- /payment/flutterwave-v3/callback
- /payment/paystack/callback
- /payment/bkash/callback
- /payment/liqpay/callback
- /payment/paymob/callback
- /payment/paytabs/callback|response

### 7.2 Triage Steps
1. Identify failing gateway and timeframe.
2. Correlate callback logs with order IDs and transaction IDs.
3. Verify if order payment state diverged from provider state.
4. Confirm callback endpoint availability and signature verification behavior.

### 7.3 Remediation Steps
1. Reconcile affected orders against gateway dashboard/export.
2. Correct order transaction status and order payment status through controlled admin process.
3. Re-run any dependent side effects (notifications/fulfillment trigger) only once.
4. Monitor same gateway callbacks for 30-60 minutes after mitigation.

## 8. Order Status Anomaly Runbook
Evidence references:
- app/Utils/order-manager.php
- app/Services/Inventory/LotInventoryService.php
- app/Models/OrderStatusHistory.php
- app/Models/Inventory/InventoryLotAllocation.php

Typical symptoms:
- Order marked canceled/returned but lot quantities not restored.
- Order marked processing/delivered but allocations missing.

Triage:
1. Review order status history timeline.
2. Compare order detail quantities vs lot allocation rows.
3. Verify `is_stock_decreased` and delivery status per order detail.

Remediation:
1. Apply one controlled status transition to re-trigger stock synchronization path.
2. Validate lot allocation release/reserve effects for each order detail.
3. Confirm product current stock is synchronized after fix.

## 9. Baseline Monitoring Checklist
- Queue:
  - Failed jobs count (rate and backlog).
  - Oldest queued job age.
  - Worker restarts/crashes.
- Payments:
  - Callback success/failure rate per gateway.
  - Callback latency and timeout trend.
  - Order-payment mismatch count.
- Orders/Inventory:
  - Order status transition failure count.
  - Canceled/returned orders lacking released allocations.
  - Negative or inconsistent stock anomalies.

Recommended alert priorities:
- High: payment callback failure spikes and order-payment mismatches.
- Medium: queue backlog growth and repeated job failures.
- Medium: lot release/reserve mismatches.

## 10. Incident Communication Template
- Incident ID:
- Severity:
- Start time:
- Impact summary:
- Affected modules:
- Current mitigation:
- Next update ETA:
- Owner:

## 11. Post-Incident Review (PIR)
Required fields:
- Root cause category (code/config/external provider/operations).
- Triggering change or event.
- Detection source and detection lag.
- Corrective action implemented.
- Preventive action with owner and due date.

## 12. Operational Verification Log
- Verification date: 2026-03-29
- Environment: local workspace readiness check
- Command: `php artisan schedule:list`
  - Result: `INFO  No scheduled tasks have been defined.`
- Command: `php artisan queue:failed`
  - Result: `INFO  No failed jobs found.`

Interpretation:
- Scheduler baseline check is healthy for current codebase state (no active scheduled tasks configured).
- Queue failure backlog is clear at verification time.
