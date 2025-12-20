@extends('layouts.back-end.app')

@section('title', translate('manual_catalog_lookup'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h4 class="mb-1 text-capitalize">{{ translate('manual_catalog_lookup') }}</h4>
                <p class="text-muted mb-0">{{ translate('use_this_page_when_the_inline_product_search_is_unavailable') }}</p>
            </div>
            <a href="{{ route('admin.purchase.orders.index') }}" class="btn btn-soft-primary btn-sm">
                <i class="tio-shopping-basket"></i>
                <span class="ps-1">{{ translate('back_to_purchases') }}</span>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="get" class="row g-3 align-items-end">
                    <div class="col-md-5 col-sm-6">
                        <label class="form-label text-capitalize">{{ translate('sku_or_product_code') }}</label>
                        <input type="text" name="sku" value="{{ $filters['sku'] ?? '' }}" class="form-control" placeholder="{{ translate('enter_sku') }}" required>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <label class="form-label text-capitalize">{{ translate('vendor_id_optional') }}</label>
                        <input type="number" name="vendor_id" value="{{ $filters['vendor_id'] ?? '' }}" class="form-control" placeholder="{{ translate('filter_by_vendor') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn--primary">
                            <i class="tio-search"></i>
                            <span class="ps-1">{{ translate('lookup') }}</span>
                        </button>
                    </div>
                </form>

                @if($searched && $results->isEmpty())
                    <div class="alert alert-warning mt-4 mb-0">
                        {{ translate('no_products_found_for_the_given_filters') }}
                    </div>
                @elseif($results->isNotEmpty())
                    <div class="table-responsive mt-4">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ translate('id') }}</th>
                                <th>{{ translate('sku') }}</th>
                                <th>{{ translate('name') }}</th>
                                <th>{{ translate('uom') }}</th>
                                <th class="text-end">{{ translate('purchase_price') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $product)
                                <tr>
                                    <td>{{ $product['id'] }}</td>
                                    <td>{{ $product['sku'] ?? translate('n_a') }}</td>
                                    <td>{{ $product['name'] ?? $product['text'] }}</td>
                                    <td>{{ $product['unit'] ?? translate('n_a') }}</td>
                                    <td class="text-end">{{ number_format((float) ($product['purchase_price'] ?? 0), 2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="text-muted small mb-0">{{ translate('copy_the_details_above_into_your_line_item_fields') }}</p>
                @else
                    <div class="alert alert-info mt-4 mb-0">
                        {{ translate('submit_a_sku_to_display_matching_products') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
