@extends('layouts.back-end.app')
@section('title', translate('purchase_vendors'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ translate('purchase_vendors') }}</h2>
                <p class="text-muted mb-0">{{ translate('configure_suppliers_and_track_contract_details') }}</p>
            </div>
            <a href="{{ route('admin.purchase.vendors.create') }}" class="btn btn--primary">
                <i class="tio-add"></i>
                <span class="ps-1">{{ translate('add_vendor') }}</span>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="get" class="row g-3 align-items-end mb-4">
                    <div class="col-md-4">
                        <label class="form-label text-capitalize">{{ translate('search') }}</label>
                        <input type="search" name="search" class="form-control" value="{{ $search }}" placeholder="{{ translate('search_by_code_name_email') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-capitalize">{{ translate('status') }}</label>
                        <select name="status" class="form-control select2">
                            <option value="">{{ translate('all_statuses') }}</option>
                            @foreach($statusOptions as $option)
                                <option value="{{ $option }}" {{ $status === $option ? 'selected' : '' }}>{{ translate($option) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn--primary w-100">{{ translate('filter') }}</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead class="thead-light">
                        <tr>
                            <th>{{ translate('code') }}</th>
                            <th>{{ translate('vendor') }}</th>
                            <th>{{ translate('contact') }}</th>
                            <th>{{ translate('status') }}</th>
                            <th>{{ translate('rating') }}</th>
                            <th class="text-end">{{ translate('actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->code }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">{{ $vendor->display_name }}</span>
                                        <small class="text-muted">{{ $vendor->category ?? translate('unclassified') }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if($vendor->primaryContact)
                                        <div class="d-flex flex-column">
                                            <span>{{ $vendor->primaryContact->name }}</span>
                                            <small class="text-muted">{{ $vendor->primaryContact->email ?? $vendor->primaryContact->phone }}</small>
                                        </div>
                                    @else
                                        <span class="text-muted">{{ translate('not_set') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-soft-{{ $vendor->status === 'active' ? 'success' : ($vendor->status === 'draft' ? 'secondary' : 'dark') }} text-capitalize">
                                        {{ translate($vendor->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-soft-primary">{{ number_format($vendor->rating ?? 0, 1) }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.purchase.vendors.edit', $vendor->id) }}" class="btn btn-outline--primary btn-sm" title="{{ translate('edit') }}">
                                            <i class="tio-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.purchase.vendors.destroy', $vendor->id) }}" method="post" onsubmit="return confirm('{{ translate('want_to_delete_this_vendor') }}');">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="{{ translate('delete') }}">
                                                <i class="tio-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">{{ translate('no_vendor_found') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $vendors->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
