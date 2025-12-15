<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ translate('purchase_order') }} {{ $order->code }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; color: #1f2d3d; }
        .header { display: flex; justify-content: space-between; margin-bottom: 24px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #dce1e6; padding: 8px; text-align: left; }
        .table th { background: #f5f7fb; }
        .totals { margin-top: 16px; width: 40%; float: right; }
        .totals td { padding: 4px 8px; }
    </style>
</head>
<body>
<div class="header">
    <div>
        <h2>{{ translate('purchase_order') }} {{ $order->code }}</h2>
        <p>{{ translate('created_at') }}: {{ $order->created_at?->format('M d, Y') }}</p>
        <p>{{ translate('expected_delivery') }}: {{ optional($order->expected_delivery)->format('M d, Y') ?? '—' }}</p>
    </div>
    <div>
        <strong>{{ translate('vendor') }}</strong>
        <p>{{ optional($order->vendor)->display_name ?? translate('not_set') }}</p>
        @if(optional($order->vendor)->primary_email)
            <p>{{ optional($order->vendor)->primary_email }}</p>
        @endif
    </div>
</div>

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ translate('description') }}</th>
        <th>{{ translate('uom') }}</th>
        <th>{{ translate('quantity') }}</th>
        <th>{{ translate('unit_price') }}</th>
        <th>{{ translate('tax_percent') }}</th>
        <th>{{ translate('discount_percent') }}</th>
        <th>{{ translate('line_total') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->items as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->uom }}</td>
            <td>{{ number_format($item->quantity, 2) }}</td>
            <td>{{ number_format($item->unit_price, 2) }}</td>
            <td>{{ number_format($item->tax_percent, 2) }}%</td>
            <td>{{ number_format($item->discount_percent, 2) }}%</td>
            <td>{{ number_format($item->line_total, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="totals">
    <tr>
        <td>{{ translate('subtotal') }}</td>
        <td>{{ number_format($order->subtotal, 2) }}</td>
    </tr>
    <tr>
        <td>{{ translate('freight_cost') }}</td>
        <td>{{ number_format($order->freight_cost, 2) }}</td>
    </tr>
    <tr>
        <td>{{ translate('tax_total') }}</td>
        <td>{{ number_format($order->tax_total, 2) }}</td>
    </tr>
    <tr>
        <td>{{ translate('discount_total') }}</td>
        <td>-{{ number_format($order->discount_total, 2) }}</td>
    </tr>
    <tr>
        <td><strong>{{ translate('grand_total') }}</strong></td>
        <td><strong>{{ $order->currency }} {{ number_format($order->grand_total, 2) }}</strong></td>
    </tr>
</table>
</body>
</html>
