@extends('layouts.hr-master')

@section('content')

<div class="container mt-5">
<label class="text-left" style="font-size: 2rem;">Agents</label><br> 
<table class="table mt-3">
    <thead>
      <tr>
        <th class="text-center" scope="col">No.</th>
        <th class="text-center" scope="col">Name</th>
        <th class="text-center" scope="col">Status</th>
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
            <td class="align-middle text-center">
                @if ($user->status == null)
                    <span class="badge rounded-pill bg-white text-dark">Empty</span>
                @elseif ($user->status == 1)
                    <span class="badge rounded-pill text-bg-success">Ontime</span>
                @elseif ($user->status == 2)
                    <span class="badge rounded-pill text-bg-danger">Late</span>
                @elseif ($user->status == 3)
                    <span class="badge rounded-pill text-bg-danger align-middle">Absent</span>
                @elseif ($user->status == 4)
                    <span class="badge rounded-pill text-bg-warning">Break</span>
                @elseif ($user->status == 5)
                    <span class="badge rounded-pill bg-white text-dark">Over-Break<ion-icon name="warning-outline"></ion-icon></span>
                @elseif ($user->status == 6)
                    <span class="badge rounded-pill bg-white text-dark">Not Over Break</span>
                @elseif ($user->status == 7)
                    <span class="badge rounded-pill text-bg-primary">Clocked-out</span>
                @endif
            </td>
            <td class="align-middle ">
              @if(isset($user->schedule->shift->name))
              <div class="align-middle justify-between d-flex">
                <div class="col-md-6 text-end mr-3">
                  {{ $user->schedule->shift->name }}
                </div>
                <div class="col-md-6 text-start">
                   &nbsp;  
                    <a type="button" class="btn btn-warning py-0" href="{{ route('edit-sched', $user->id) }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">Edit</a>
                    @include('HR.hr-modals.edit-schedule-modal', ['editAgentSchedID' => $user->id])
                </div>
              </div>
              @else
              <div class="col-md-8 text-center">
                <a type="button" class="btn btn-success py-0" href="{{ route('edit-sched', $user->id) }}" data-bs-toggle="modal" data-bs-target="#add-schedModal{{ $user->id }}">Add Schedule</a>
                @include('HR.hr-modals.add-schedModal', ['editAgentSchedID' => $user->id])
              </div>
              @endif
            </td>
            {{-- <td class="align-middle text-center">Sample Sample</td> --}}
            <td class="align-middle text-center">
                <span class="btn btn-danger py-0" data-bs-toggle="modal" data-bs-target="#tagAbsentModal{{ $user->id }}">Tag Agent as Absent</span>
                {{-- Absent 3 --}}
                @include('HR.hr-modals.tag-as-absent', ['tagAgentSchedID' => $user->id])
            </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
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