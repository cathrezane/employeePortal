@extends('layouts.hr-master')

@section('content')
<div class="container mt-5">
  <label class="text-left" style="font-size: 2rem;">Agents Attendance Log</label>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">Latest Clock-in</th>
            <th scope="col">Latest Clock-out</th>
            {{-- <th scope="col">Status On-time/Late/Absent</th> --}}
            <th>More Details</th>
          </tr>
        </thead>
        <tbody>
          {{-- {{ dd($latestAttendancesAndOut) }} --}}
        @foreach ($latestAttendancesAndOut as $row)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $row->name }}</td>
            <td>{{ \Carbon\Carbon::parse($row->latest_in)->format('D, M d, Y')}} - {{ \Carbon\Carbon::parse($row->latestIn)->format('h:i A') }}
              @if($row->attendance_status == 1)
              <span class="badge bg-success">On-Time</span>
              @elseif($row->attendance_status == 2)
              <span class="badge bg-danger">Late</span>
              @endif
            <td>{{ \Carbon\Carbon::parse($row->latest_out)->format('D, M d, Y')}} - {{ \Carbon\Carbon::parse($row->latestOut)->format('h:i A') }}</td>
            {{-- <td>{{ $row->attendanceStatus ?? 'Null'}}</td> --}}
            <td><a href="/hr/{{ $row->id}}/attendance-log" class="btn btn-light btn-outline-dark py-0" style="font-weight:100;">View Logs</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection