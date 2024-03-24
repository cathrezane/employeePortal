
@extends('layouts.hr-master')

@section('content')
<style>
    .pagination > li > a {
      padding: 5px 10px;
      border: 1px solid #ddd;
    }
  
    .pagination > .active > a,
    .pagination > .active > a:hover,
    .pagination > .active > a:focus {
      background-color: #ddd;
    }
  </style>
<div class="container">
    <div class="float-start">
        <a href="{{ route('hr_employee_attendance_log',[$id]) }}" style="text-decoration: none; color: black;" ><span type="button" class="pb-2 mb-0 align-middle"><i class="bi bi-arrow-left-square fa-2x m-0"></i> Go Back</span></a>
    </div>
</div>  
<div class="container mt-3">
    <div class="col-md-3 float-end">
        <form action="{{ route('hr_employee_attendance_log.viewLog', [$id]) }}?searchDate={{ request()->query('searchDate') }}" method="GET">
        <div class="input-group mb-3">
                <input class="form-control" type="date" name="searchDate" value="{{ request()->query('searchDate') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
              </form>
        </div>
    </div>
</div>
<div class="container p-4 mt-2">
    <label class="text-left" style="font-size: 2rem;">Attendance Log</label>
    <div class="card text-center">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Attendance Status</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
                {{-- {{ dd($results) }} --}}
                @foreach($results as $result)
                <tr>
                    <td>{{ $result->user->name; }}</td>
                    <td>
                    @if ($result->status == 1)
                        <span class="badge rounded-pill text-bg-primary">Clocked-in</span>
                    @elseif ($result->status == 2)
                        <span class="badge rounded-pill text-bg-warning">On-Break</span>
                    @elseif ($result->status == 3)
                        <span class="badge rounded-pill text-bg-info">Break-In</span>
                    @elseif ($result->status == 4)
                        <span class="badge rounded-pill text-bg-dark">Clocked-out</span>
                    @endif</td>
                        
                    <td>
                        @if ($result->attendanceStatus == null)
                            <span class="badge rounded-pill bg-white text-dark">Empty</span>
                        @elseif ($result->attendanceStatus == 1)
                            <span class="badge rounded-pill text-bg-success">Ontime</span>
                        @elseif ($result->attendanceStatus == 2)
                            <span class="badge rounded-pill text-bg-danger">Late</span>
                        @elseif ($result->attendanceStatus == 3)
                            <span class="badge rounded-pill text-bg-danger">Absent<ion-icon name="alert-circle-outline"></ion-icon></span>
                        @elseif ($result->attendanceStatus == 4)
                            <span class="badge rounded-pill text-bg-warning">Break</span>
                        @elseif ($result->attendanceStatus == 5)
                            <span class="badge rounded-pill bg-white text-dark">Over-Break<ion-icon name="warning-outline"></ion-icon></span>
                        @elseif ($result->attendanceStatus == 6)
                            <span class="badge rounded-pill bg-white text-dark">Not Over Break</span>
                        @elseif ($result->attendanceStatus == 7)
                            <span class="badge rounded-pill text-bg-primary">Clocked-out</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($result->time_logged)->format('h:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($result->time_logged)->format('D, M d, Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($results->hasPages())
    <div class="d-flex justify-content-between mb-0 px-3">
        <p>Showing {{ $results->firstItem() }} - {{ $results->lastItem() }} of {{ $results->total() }}</p>
        <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            {{ $results->links('pagination::bootstrap-4') }}
        </ul>
        </nav>
    </div>
    @endif
        @if (isset($message))
        <div class="m-1">
            {{ $message }}
        </div>
        @endif
    </div>
</div>
@endsection
