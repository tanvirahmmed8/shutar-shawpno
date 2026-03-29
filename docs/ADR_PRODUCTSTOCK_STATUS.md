# ADR: ProductStock Status and Direction

## ADR Metadata
- ADR ID: ADR-2026-03-29-ProductStock
- Status: Accepted
- Date: 2026-03-29
- Scope: Inventory domain model consistency

## Context
The current stock system is lot-driven:
- Inventory lots are managed by app/Services/Inventory/LotInventoryService.php
- Product current stock is refreshed from lot availability sums
- Order status transitions reserve/release lots through app/Utils/order-manager.php

At the same time, ProductStock exists as a model class but has no behavior:
- app/Models/ProductStock.php contains an empty class
- Product::stocks() relation still points to ProductStock (app/Models/Product.php)

Observed direct usages of ProductStock are minimal and indirect:
- app/Models/Product.php relation definition only
- Stock reporting controllers export product stock summaries, but the source of truth in current flow is Product.current_stock + inventory lots

## Decision
Choose Option A from Phase 3 plan: keep ProductStock as a legacy placeholder and deprecate it as an operational stock source.

Decision details:
- Inventory source of truth is InventoryLot + InventoryLotAllocation.
- Product.current_stock remains the denormalized read field synchronized by LotInventoryService.
- ProductStock is not used for reservation/release logic and is treated as legacy.

## Rationale
- Matches actual runtime behavior and avoids dual stock authorities.
- Reduces ambiguity for future development and testing.
- Enables incremental cleanup with low risk.

## Consequences
Positive:
- Clear single source of truth for stock.
- Lower regression risk from conflicting writes.

Tradeoffs:
- Existing Product::stocks() relation remains for backward compatibility and may confuse contributors if undocumented.

## Implementation Guidance
Phase 3 implementation steps:
1. Add deprecation note in Product model docblock/comments for stocks() relation.
2. Avoid introducing new write paths to ProductStock.
3. Update internal docs/spec to state ProductStock is legacy.
4. In Phase 4/cleanup window, evaluate safe removal of Product::stocks() relation if no consumer remains.

## Verification Evidence
- app/Models/ProductStock.php
- app/Models/Product.php
- app/Services/Inventory/LotInventoryService.php
- app/Utils/order-manager.php
