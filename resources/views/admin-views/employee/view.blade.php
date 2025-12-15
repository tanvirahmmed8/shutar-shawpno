@extends('layouts.back-end.app')

@section('title', translate('employee_details'))

@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize d-flex align-items-center gap-2">
                    <img src="{{dynamicAsset(path: 'public/assets/back-end/img/employee.png')}}" width="20" alt="">
                    {{translate('employee_details')}}
                </h2>
                <p class="text-muted mb-0">{{translate('review_profile_contact_information_and_module_access')}}</p>
            </div>
            <span class="badge badge-soft-dark radius-50 fz-12">{{'#'.translate('EMP').' '.$employee['id']}}</span>
        </div>
        <div class="card report-card">
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-lg-7 col-xl-8">
                        <div class="d-flex align-items-center flex-wrap gap-4">
                            <img width="220" class="rounded"
                                 src="{{getStorageImages(path: $employee->image_full_url,type:'backend-profile')}}" alt="{{translate('image_Description')}}">
                            <div>
                                <h4 class="mb-1 text-capitalize">{{$employee->name}}</h4>
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="badge badge-soft-primary text-capitalize">{{isset($employee->role) ? $employee->role->name : translate('role_not_found')}}</span>
                                    <span class="status-pill {{ $employee->status ? 'status-pill--success':'status-pill--danger' }}">
                                        {{ $employee->status ? translate('active') : translate('inactive') }}
                                    </span>
                                </div>
                                <ul class="d-flex flex-column gap-3 px-0 mb-0 list-unstyled">
                                    <li class="d-flex gap-2 align-items-center">
                                        <i class="tio-call"></i>
                                        <a href="tel:{{$employee->phone}}" class="text-dark">{{$employee->phone}}</a>
                                    </li>
                                    <li class="d-flex gap-2 align-items-center">
                                        <i class="tio-email"></i>
                                        <a href="mailto:{{$employee->email}}" class="text-dark">{{$employee->email}}</a>
                                    </li>
                                    @if (!empty($employee->identify_type))
                                        <li class="d-flex gap-2 align-items-center">
                                            <i class="tio-credit-card"></i>
                                            <span class="text-dark text-uppercase">
                                                {{$employee->identify_type.' '.'-'.' '.($employee?->identify_number ?? translate('identify_number_not_found'))}}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="border rounded p-3 h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="tio-calendar-month"></i>
                                <span class="text-dark">{{translate('join').' '.':'.' '.date('d/m/Y',strtotime($employee->created_at))}}</span>
                            </div>
                            <div class="d-flex justify-content-between gap-3 mb-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="tio-account-square-outlined"></i>
                                    <h6 class="text-dark mb-0 text-capitalize">{{translate('access_available')}}</h6>
                                </div>
                                <a href="{{route('admin.employee.update',[$employee['id']])}}" class="text-primary" data-toggle="tooltip" data-placement="top" title="{{translate('you_can_create_or_edit_role_form_employee_role_setup')}}">
                                    <i class="tio-edit"></i>
                                </a>
                            </div>
                            @if (isset($employee->role))
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach (json_decode($employee->role->module_access) as $key=>$value)
                                        <span class="badge badge-soft-dark text-capitalize">{{str_replace('_' ,' ',$value)}}</span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">{{translate('role_not_found')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <a href="{{route('admin.employee.update',[$employee['id']])}}" class="btn btn--primary px-5">
                                <i class="tio-edit"></i>
                                {{translate('edit')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
