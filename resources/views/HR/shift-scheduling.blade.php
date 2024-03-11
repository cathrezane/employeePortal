@extends('layouts.hr-master')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Daily Shift</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('hr.home') }}">Dashboard</a"></li>
                <li class="breadcrumb-item"><a href="index.html">Employees</a"></li>
                <li class="breadcrumb-item"><a href="{{ route('shiftlist') }}">Shift Scheduling</a"></li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="{{ route('shiftlist') }}" class="btn add-btn m-r-5">Shifts</a>
            <a href="#" class="btn add-btn m-r-5" data-bs-toggle="modal" data-bs-target="add_schedule"> Assign Shifts</a>
        </div>
    </div>

</div>
@endsection