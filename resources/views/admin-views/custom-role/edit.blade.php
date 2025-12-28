@extends('layouts.back-end.app')

@section('title', translate('edit_Role'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize d-flex align-items-center gap-2">
                    <img src="{{dynamicAsset(path: 'public/site-assets/back-end/img/add-new-seller.png')}}" alt="">
                    {{translate('role_update')}}
                </h2>
                <p class="text-muted mb-0">{{translate('adjust_permissions_without_interrupting_your_team')}}</p>
            </div>
            <span class="badge badge-soft-dark radius-50 fz-12 text-capitalize">{{translate('role_id')}} #{{$role['id']}}</span>
        </div>

        @php($modulePermissions = [
            ['key' => 'dashboard', 'label' => translate('dashboard')],
            ['key' => 'pos_management', 'label' => translate('pos_management')],
            ['key' => 'order_management', 'label' => translate('order_management')],
            ['key' => 'product_management', 'label' => translate('product_management')],
            ['key' => 'promotion_management', 'label' => translate('promotion_management')],
            ['key' => 'support_section', 'label' => translate('help_&_support_section')],
            ['key' => 'report', 'label' => translate('reports_&_analytics')],
            ['key' => 'user_section', 'label' => translate('user_management')],
            ['key' => 'system_settings', 'label' => translate('system_settings')],
        ])
        @php($purchaseModuleKey = config('purchase.module_key', 'purchase_management'))
        @if(config('purchase.enabled'))
            @php($modulePermissions[] = ['key' => $purchaseModuleKey, 'label' => translate('purchase_management')])
        @endif
        @php($financeModuleKey = config('accounts_finance.module_key', 'accounts_finance'))
        @if(config('accounts_finance.enabled'))
            @php($modulePermissions[] = ['key' => $financeModuleKey, 'label' => translate('accounts_finance_module')])
        @endif
        @php($purchasePermissions = config('purchase.permissions', []))
        @php($financePermissions = config('accounts_finance.permissions', []))
        @php($moduleAccess = (array)json_decode($role['module_access'], true))

        <div class="card report-card">
            <div class="card-header border-0 pb-0">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                    <div>
                        <h5 class="mb-1 text-capitalize">{{translate('edit_role_information')}}</h5>
                        <p class="text-muted mb-0">{{translate('toggle_modules_on_or_off_and_keep_access_in_sync')}}</p>
                    </div>
                    <span class="badge badge-soft-primary radius-50 fz-12 text-capitalize">{{translate('editing')}}</span>
                </div>
            </div>
            <div class="card-body">
                <form id="submit-create-role" action="{{route('admin.custom-role.update',[$role['id']])}}" method="post" class="text-start">
                    @csrf
                    <input type="hidden" name="id" value="{{$role['id']}}">

                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label for="name" class="title-color">{{translate('role_name')}}</label>
                                <input type="text" name="name" value="{{$role['name']}}" class="form-control" id="name"
                                       placeholder="{{translate('ex').':'.translate('store')}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-wrap justify-content-between align-items-center border rounded px-3 py-2 h-100">
                                <div>
                                    <p class="text-muted mb-1">{{translate('module_permission')}}</p>
                                    <h6 class="mb-0 text-capitalize">{{translate('select_modules')}}</h6>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <label class="title-color mb-0 text-capitalize" for="select-all">{{translate('select_all')}}</label>
                                    <input type="checkbox" id="select-all" class="cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        @foreach($modulePermissions as $module)
                            <div class="col-sm-6 col-xl-4">
                                <div class="border rounded px-3 py-3 h-100 d-flex align-items-center justify-content-between gap-3">
                                    <span class="text-capitalize font-weight-medium">{{ $module['label'] }}</span>
                                    <label class="switcher mb-0">
                                        <input type="checkbox" name="modules[]" value="{{ $module['key'] }}" class="switcher_input module-permission" id="module-{{ $module['key'] }}" {{ in_array($module['key'], $moduleAccess) ? 'checked' : '' }}>
                                        <span class="switcher_control"></span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if(config('purchase.enabled') && count($purchasePermissions))
                        <div class="border rounded px-3 py-3 mt-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                                <div>
                                    <p class="text-muted mb-1">{{ translate('purchase_permissions') }}</p>
                                    <h6 class="mb-0 text-capitalize">{{ translate('purchase_permission_hint') }}</h6>
                                </div>
                            </div>
                            <div class="row g-3 mt-1">
                                @foreach($purchasePermissions as $permission)
                                    <div class="col-sm-6 col-xl-3">
                                        <div class="border rounded px-3 py-3 h-100 d-flex align-items-center justify-content-between gap-3">
                                            <span class="text-capitalize font-weight-medium">{{ translate($permission['label']) }}</span>
                                            <label class="switcher mb-0">
                                                <input type="checkbox"
                                                       name="modules[]"
                                                       value="{{ $permission['key'] }}"
                                                       class="switcher_input module-permission"
                                                       id="module-{{ str_replace(['.', '_'], '-', $permission['key']) }}"
                                                       {{ in_array($permission['key'], $moduleAccess) ? 'checked' : '' }}>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(config('accounts_finance.enabled') && count($financePermissions))
                        <div class="border rounded px-3 py-3 mt-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                                <div>
                                    <p class="text-muted mb-1">{{ translate('accounts_finance_permissions') }}</p>
                                    <h6 class="mb-0 text-capitalize">{{ translate('accounts_finance_permission_hint') }}</h6>
                                </div>
                            </div>
                            <div class="row g-3 mt-1">
                                @foreach($financePermissions as $permission)
                                    <div class="col-sm-6 col-xl-3">
                                        <div class="border rounded px-3 py-3 h-100 d-flex align-items-center justify-content-between gap-3">
                                            <span class="text-capitalize font-weight-medium">{{ translate($permission['label']) }}</span>
                                            <label class="switcher mb-0">
                                                <input type="checkbox"
                                                       name="modules[]"
                                                       value="{{ $permission['key'] }}"
                                                       class="switcher_input module-permission"
                                                       id="module-{{ str_replace(['.', '_'], '-', $permission['key']) }}"
                                                       {{ in_array($permission['key'], $moduleAccess) ? 'checked' : '' }}>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <button type="reset" class="btn btn-secondary px-4">{{translate('reset')}}</button>
                        <button type="submit" class="btn btn--primary px-4">{{translate('update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ dynamicAsset(path: 'public/site-assets/back-end/js/admin/custom-role.js') }}"></script>
@endpush
