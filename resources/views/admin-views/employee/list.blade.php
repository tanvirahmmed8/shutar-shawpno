@extends('layouts.back-end.app')

@section('title', translate('employee_list'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize d-flex align-items-center gap-2">
                    <img src="{{dynamicAsset(path: 'public/site-assets/back-end/img/employee.png')}}" width="20" alt="">
                    {{translate('employee_list')}}
                </h2>
                <p class="text-muted mb-0">{{translate('track_admin_users_roles_and_access_from_one_place')}}</p>
            </div>
        </div>

        <div class="card report-card">
            <div class="card-header border-0 pb-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h5 class="mb-1 text-capitalize">{{translate('employee_table')}}</h5>
                        <p class="text-muted mb-0">{{translate('quickly_filter_search_or_export_employee_records')}}</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge badge-soft-dark radius-50 fz-12">{{$employees->total()}} {{translate('items')}}</span>
                        <a href="{{route('admin.employee.add-new')}}" class="btn btn--primary text-nowrap d-flex align-items-center gap-2">
                            <i class="tio-add"></i>
                            <span>{{translate('add_new')}}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-end mb-4">
                    <div class="col-xl-5 col-lg-6">
                        <form action="{{ url()->current() }}" method="GET">
                            <input type="hidden" name="admin_role_id" value="{{ request('admin_role_id', 'all') }}">
                            <div class="input-group input-group-merge input-group-custom">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input type="search" name="searchValue" class="form-control"
                                       placeholder="{{translate('search_by_name_or_email_or_phone')}}"
                                       value="{{ request('searchValue') }}">
                                <button type="submit" class="btn btn--primary">{{translate('search')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <form action="{{ url()->current() }}" method="GET">
                            <input type="hidden" name="searchValue" value="{{ request('searchValue') }}">
                            <div class="d-flex gap-2 align-items-center">
                                <select class="form-control text-ellipsis" name="admin_role_id">
                                    <option value="all" {{ request('admin_role_id', 'all') == 'all' ? 'selected' : '' }}>{{translate('all')}}</option>
                                    @foreach($employee_roles as $employee_role)
                                        <option value="{{ $employee_role['id'] }}" {{ request('admin_role_id') == $employee_role['id'] ? 'selected' : '' }}>
                                            {{ ucfirst($employee_role['name']) }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn--primary px-4 text-nowrap">{{ translate('filter')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-3 col-lg-12 d-flex justify-content-xl-end gap-2">
                        <a type="button" class="btn btn-outline--primary w-100 text-nowrap"
                           href="{{route('admin.employee.export',['role'=>request('admin_role_id'),'searchValue'=>request('searchValue')])}}">
                            <img width="14" src="{{dynamicAsset(path: 'public/site-assets/back-end/img/excel.png')}}" class="excel" alt="">
                            <span class="ps-2">{{ translate('export') }}</span>
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-borderless table-thead-bordered table-align-middle card-table w-100">
                        <thead class="thead-light thead-50 text-capitalize table-nowrap">
                        <tr>
                            <th>{{translate('SL')}}</th>
                            <th>{{translate('name')}}</th>
                            <th>{{translate('email')}}</th>
                            <th>{{translate('phone')}}</th>
                            <th>{{translate('role')}}</th>
                            <th>{{translate('status')}}</th>
                            <th class="text-center">{{translate('action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $key => $employee)
                            <tr>
                                <td>{{ $employees->firstItem() + $key }}</td>
                                <td class="text-capitalize">
                                    <div class="d-flex align-items-center gap-3">
                                        <img class="rounded-circle avatar avatar-lg" alt="{{ $employee['name'] }}"
                                             src="{{getStorageImages(path: $employee->image_full_url,type:'backend-profile')}}">
                                        <div>
                                            <h6 class="mb-0">{{$employee['name']}}</h6>
                                            <small class="text-muted">{{ $employee['email'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$employee['email']}}</td>
                                <td>{{$employee['phone']}}</td>
                                <td>
                                    <span class="badge badge-soft-dark text-capitalize">{{$employee?->role['name'] ?? translate('role_not_found')}}</span>
                                </td>
                                <td>
                                    @if($employee['id'] == 1)
                                        <span class="status-pill status-pill--success">{{ translate('admin') }}</span>
                                    @else
                                        <form action="{{route('admin.employee.status')}}" method="post" id="employee-id-{{$employee['id']}}-form" class="employee_id_form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$employee['id']}}">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="status-pill {{ $employee->status ? 'status-pill--success' : 'status-pill--danger' }}">
                                                    {{ $employee->status ? translate('active') : translate('inactive') }}
                                                </span>
                                                <label class="switcher mb-0">
                                                    <input type="checkbox" class="switcher_input toggle-switch-message" value="1" id="employee-id-{{$employee['id']}}" name="status"
                                                           {{$employee->status?'checked':''}}
                                                           data-modal-id = "toggle-status-modal"
                                                           data-toggle-id = "employee-id-{{$employee['id']}}"
                                                           data-on-image = "employee-on.png"
                                                           data-off-image = "employee-off.png"
                                                           data-on-title = "{{translate('want_to_Turn_ON_Employee_Status').'?'}}"
                                                           data-off-title = "{{translate('want_to_Turn_OFF_Employee_Status').'?'}}"
                                                           data-on-message = "<p>{{translate('if_enabled_this_employee_can_log_in_to_the_system_and_perform_his_role')}}</p>"
                                                           data-off-message = "<p>{{translate('if_disabled_this_employee_can_not_log_in_to_the_system_and_perform_his_role')}}</p>">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($employee['id'] == 1)
                                        <span class="badge badge-primary-light">{{ translate('default') }}</span>
                                    @else
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{route('admin.employee.update',[$employee['id']])}}"
                                               class="btn btn-outline--primary btn-sm square-btn"
                                               title="{{translate('edit')}}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-outline-info btn-sm square-btn" title="{{translate('view')}}" href="{{route('admin.employee.view',['id'=>$employee['id']])}}">
                                                <i class="tio-invisible"></i>
                                            </a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-lg-end mt-4">
                    {{$employees->links()}}
                </div>

                @if(count($employees)==0)
                    <div class="pt-4">
                        @include('layouts.back-end._empty-state',['text'=>'no_employee_found'],['image'=>'default'])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
