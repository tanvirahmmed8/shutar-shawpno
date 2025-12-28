@extends('layouts.back-end.app')
@section('title', translate('create_Role'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize d-flex align-items-center gap-2">
                    <img src="{{dynamicAsset(path: 'public/site-assets/back-end/img/add-new-seller.png')}}" alt="">
                    {{translate('employee_role_setup')}}
                </h2>
                <p class="text-muted mb-0">{{translate('assign_the_right_modules_and_keep_admin_access_secure')}}</p>
            </div>
            <span class="badge badge-soft-dark radius-50 fz-12 text-capitalize">{{translate('total_roles')}}: {{ count($roles) }}</span>
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
        @php($moduleLabelMap = array_column($modulePermissions, 'label', 'key'))
        @foreach($purchasePermissions as $permission)
            @php($moduleLabelMap[$permission['key']] = translate($permission['label']))
        @endforeach
        @foreach($financePermissions as $permission)
            @php($moduleLabelMap[$permission['key']] = translate($permission['label']))
        @endforeach

        <div class="card report-card mb-4">
            <div class="card-header border-0 pb-0">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                    <div>
                        <h5 class="mb-1 text-capitalize">{{translate('create_new_role')}}</h5>
                        <p class="text-muted mb-0">{{translate('build_role_profiles_that_match_your_team_structure')}}</p>
                    </div>
                    <span class="badge badge-soft-primary radius-50 fz-12 text-capitalize">{{translate('role_creation')}}</span>
                </div>
            </div>
            <div class="card-body">
                <form id="submit-create-role" method="post" action="{{route('admin.custom-role.store')}}" class="text-start">
                    @csrf
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label for="name" class="title-color">{{translate('role_name')}}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       placeholder="{{translate('ex').':'.translate('store')}}" required>
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
                                        <input type="checkbox" name="modules[]" value="{{ $module['key'] }}" class="switcher_input module-permission" id="module-{{ $module['key'] }}">
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
                                                       id="module-{{ str_replace(['.', '_'], '-', $permission['key']) }}">
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
                                                       id="module-{{ str_replace(['.', '_'], '-', $permission['key']) }}">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn--primary px-5">{{translate('submit')}}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card report-card">
            <div class="card-header border-0 pb-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h5 class="mb-1 text-capitalize">{{translate('employee_Roles')}}</h5>
                        <p class="text-muted mb-0">{{translate('manage_status_and_permissions_from_a_single_table')}}</p>
                    </div>
                    <span class="badge badge-soft-dark radius-50 fz-12">{{ count($roles) }} {{translate('items')}}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <form action="{{url()->current()}}" method="GET" class="flex-grow-1">
                        <div class="input-group input-group-merge input-group-custom">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input type="search" name="searchValue" class="form-control"
                                   placeholder="{{translate('search_role')}}"
                                   value="{{ request('searchValue') }}">
                            <button type="submit" class="btn btn--primary">{{translate('search')}}</button>
                        </div>
                    </form>
                    <a type="button" class="btn btn-outline--primary text-nowrap"
                       href="{{route('admin.custom-role.export',['searchValue'=>request('searchValue')])}}">
                        <img width="14" src="{{dynamicAsset(path: 'public/site-assets/back-end/img/excel.png')}}" class="excel" alt="">
                        <span class="ps-2">{{ translate('export') }}</span>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-borderless table-thead-bordered table-align-middle card-table text-start">
                        <thead class="thead-light thead-50 text-capitalize table-nowrap">
                        <tr>
                            <th>{{translate('SL')}}</th>
                            <th>{{translate('role_name')}}</th>
                            <th>{{translate('modules')}}</th>
                            <th>{{translate('created_at')}}</th>
                            <th>{{translate('status')}}</th>
                            <th class="text-center">{{translate('action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $role)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td class="text-capitalize">{{$role['name']}}</td>
                                <td>
                                    @if($role['module_access'])
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach((array)json_decode($role['module_access']) as $module)
                                                <span class="badge badge-soft-primary text-capitalize">{{ $moduleLabelMap[$module] ?? translate(str_replace('_',' ', $module)) }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted">{{translate('not_assigned')}}</span>
                                    @endif
                                </td>
                                <td>{{date('d-M-y',strtotime($role['created_at']))}}</td>
                                <td>
                                    <form action="{{route('admin.custom-role.employee-role-status')}}" method="post" id="employee-role-status{{$role['id']}}-form">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$role['id']}}">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="status-pill {{ $role['status'] == 1 ? 'status-pill--success' : 'status-pill--danger' }}">
                                                {{ $role['status'] == 1 ? translate('active') : translate('inactive') }}
                                            </span>
                                            <label class="switcher" for="employee-role-status{{$role['id']}}">
                                                <input type="checkbox" class="switcher_input toggle-switch-message" id="employee-role-status{{$role['id']}}" name="status" value="1" {{$role['status'] == 1?'checked':''}}
                                                       data-modal-id = "toggle-status-modal"
                                                       data-toggle-id = "employee-role-status{{$role['id']}}"
                                                       data-on-image = "employee-on.png"
                                                       data-off-image = "employee-off.png"
                                                       data-on-title = "{{translate('want_to_Turn_ON_Employee_Status').'?'}}"
                                                       data-off-title = "{{translate('want_to_Turn_OFF_Employee_Status').'?'}}"
                                                       data-on-message = "<p>{{translate('when_the_status_is_enabled_employees_can_access_the_system_to_perform_their_responsibilities')}}</p>"
                                                       data-off-message = "<p>{{translate('when_the_status_is_disabled_employees_cannot_access_the_system_to_perform_their_responsibilities')}}</p>">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{route('admin.custom-role.update',[$role['id']])}}"
                                           class="btn btn-outline--primary btn-sm square-btn"
                                           title="{{translate('edit') }}">
                                            <i class="tio-edit"></i>
                                        </a>
                                        <a href="javascript:"
                                           class="btn btn-outline-danger btn-sm delete-data-without-form"
                                           data-action="{{route('admin.custom-role.delete')}}"
                                           title="{{translate('delete') }}" data-id="{{$role['id']}}">
                                            <i class="tio-delete"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if(count($roles)==0)
                    <div class="pt-4">
                        @include('layouts.back-end._empty-state',['text'=>'no_data_found'],['image'=>'default'])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{dynamicAsset(path: 'public/site-assets/back-end/js/admin/custom-role.js')}}"></script>
@endpush
