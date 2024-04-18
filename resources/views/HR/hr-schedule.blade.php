@extends('layouts.hr-master')

@section('content')
{{-- <h1>HR Schedule Management</h1> --}}

{{-- <form action="{{ route('hr_schedule.assign') }}" method="post">
    @csrf

    <label for="user_id">Select User:</label>
    <select name="user_id" id="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <label for="shift_id">Select Shift:</label>
    <select name="shift_id" id="shift_id">
        @foreach($shifts as $shift)
            <option value="{{ $shift->id }}">{{ $shift->name }} ({{ $shift->start_time }} - {{ $shift->end_time }})</option>
        @endforeach
    </select>

    <button type="submit">Assign Schedule</button>
</form> --}}

<script>
  @if (session()->has('error'))
      Swal.fire({
      title: "Error!",
      text: "{{ session()->get('error') }}",
      icon: "error",
      type: "error",
      });
  @endif
  @if (session()->has('success'))
      Swal.fire({
      title: "Success!",
      text: "{{ session()->get('success') }}",
      icon: "success",
      type: "success",
      });
  @endif
  @if (session()->has('warning'))
      Swal.fire({
      title: "Warning!",
      text: "{{ session()->get('warning') }}",
      icon: "warning",
      type: "warning",
      });
  @endif
  @if (session()->has('info'))
      Swal.fire({
      title: "Information!",
      text: "{{ session()->get('info') }}",
      icon: "info",
      type: "info",
      });
  @endif
</script>

<h4 class="mt-3">Agents</h4>
<table class="table">
    <thead>
      <tr>
        <th class="text-center" scope="col">No.</th>
        <th class="text-center" scope="col">Name</th>
        {{-- <th class="text-center" scope="col">Campaign</th> --}}
        {{-- <th class="text-center" scope="col">Operations Manager</th> --}}
        <th class="text-center">Schedule</th>
        <th class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      {{-- {{ dd($users) }} --}}
    @foreach($users as $user) 
      <tr>
            <td class="align-middle text-center">{{ $loop->iteration }}</td>
            <td class="align-middle text-center">{{ $user->name }}</td>
            <td class="align-middle ">
              @if(isset($user->schedule->shift->name))
              <div class="align-middle justify-between d-flex">
                <div class="col-md-6 text-end mr-3">
                  {{ $user->schedule->shift->name }} | 
                </div>
                <div class="col-md-6 text-start">
                   &nbsp;  
                    <a type="button" class="btn btn-warning py-0" href="{{ route('edit-sched', $user->id) }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">Edit</a>
                    @include('HR.hr-modals.edit-schedule-modal', ['editAgentSchedID' => $user->id])
                </div>
              </div>
              @else
              <form action="{{ route('hr_schedule.assign') }}" method="post">
                @csrf
                <input value="{{ $row->id }}" name="user_id" id="user_id" style="display: none;">
            
                <label for="shift_id">Select Shift:</label>
                <select class=" form-control-sm" name="shift_id" id="shift_id">
                  <option selected disabled>Select Shift</option>
                    @foreach($shifts as $shift)
                        <option value="{{ $shift->id }}">{{ $shift->name }} ({{\Carbon\Carbon::parse($shift->start_time)->format('h:i A') }} - {{\Carbon\Carbon::parse($shift->end_time)->format('h:i A') }})
                    @endforeach
                </select>
            
                <button class="btn btn-success p-1 py-0" type="submit">Save</button>
            </form>
              @endif
            </td>
            {{-- <td class="align-middle text-center">Sample Sample</td> --}}
            <td class="align-middle text-center">
                <span class="btn btn-danger py-0" data-bs-toggle="modal" data-bs-target="#disable-sched">More Details</span>
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