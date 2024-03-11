@extends('layouts.hr-master')

@section('content')
{{-- <h1>HR Schedule Management</h1> --}}

<form action="{{ route('hr_schedule.assign') }}" method="post">
    @csrf

    {{-- <label for="user_id">Select User:</label>
    <select name="user_id" id="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select> --}}

    {{-- <label for="shift_id">Select Shift:</label>
    <select name="shift_id" id="shift_id">
        @foreach($shifts as $shift)
            <option value="{{ $shift->id }}">{{ $shift->name }} ({{ $shift->start_time }} - {{ $shift->end_time }})</option>
        @endforeach
    </select>

    <label for="date">Select Date:</label>
    <input type="date" name="date" id="date" required>

    <button type="submit">Assign Schedule</button> --}}
</form>

<h4 class="mt-3">Agents</h4>
<table class="table">
    <thead>
      <tr>
        <th class="text-center" scope="col">No.</th>
        <th class="text-center" scope="col">Name</th>
        <th class="text-center" scope="col">Campaign</th>
        <th class="text-center" scope="col">Operations Manager</th>
        <th class="text-center">Schedule</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user) 
      <tr>
            <td class="align-middle text-center">{{ $loop->iteration }}</td>
            <td class="align-middle text-center">{{ $user->name }}</td>
            <td class="align-middle text-center">Sample Sample</td>
            <td class="align-middle text-center">Sample Sample</td>
            <td class="align-middle text-center">
                <span class="btn btn-primary py-0" data-bs-toggle="modal" data-bs-target="#add-sched">Add</span>
                <span class="btn btn-warning py-0"><a href="/hr/{{ $user->id }}/edit-schedule" class="text-decoration-none text-dark">Edit</a></span>
                <span class="btn btn-danger py-0" data-bs-toggle="modal" data-bs-target="#disable-sched">Disable</span>
            </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  <div class="modal fade" id="edit-sched" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="disable-sched" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Disable Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection