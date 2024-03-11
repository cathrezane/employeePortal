@extends('layouts.hr-master')

@section('content')
<div class="container mt-3">
  <button class="btn btn-white">
    <label for="user_id">Agent Scheduling</label>
  </button>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">Shift</th>
            <th scope="col">Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($employees as $row)
            <tr>
                <td class="align-middle shift-days">{{ $loop->iteration }}</td>
                <td class="align-middle shift-days"> {{ ucfirst($row->name) }}</td>
                <td class="align-middle shift-days"> 
                  @if ($row->schedules->isNotEmpty() && $row->schedules->first()->shift)
                      {{ $row->schedules->pluck('shift.name')->first() }}:
                      <span class="text-white btn btn-dark p-1 py-0">{{ \Carbon\Carbon::parse($row->schedules->pluck('shift.start_time')->first())->format('h:i A') }}</span> - 
                      <span class="text-dark btn btn-white p-1 py-0">{{ \Carbon\Carbon::parse($row->schedules->pluck('shift.end_time')->first())->format('h:i A') }}</span>
                      <br>Workdays:
                        <span>
                          @php
                            $words = $row->workday_names ? explode(' ', $row->workday_names) : [];
                          @endphp
                          @if (empty($words))
                            <div class="d-inline text-white btn-danger p-1 py-0 rounded">
                              <span class="m-1">No shift assigned</span>
                            </div>
                          @else
                            <div class="d-inline text-white btn-success p-1 py-0 rounded">
                              @foreach($words as $word)
                                <span class="m-1">{{ strtoupper(substr($word, 0, 1)) }}</span>
                                  @endforeach
                            </div>
                          @endif
                      <span>
                  @else
                      <button class="text-white btn btn-warning p-1 py-0" style="text-transform: none;">No Schedule</button>
                  @endif
                </td>
                <td class="align-middle shift-days ">{{ ucfirst(implode(', ', $row->roles->pluck('name')->toArray())) }} 
                </td>
                <td class="align-middle shift-days "><button class="btn btn-success py-0" data-bs-toggle="modal" data-bs-target="#add-sched{{ $row->id }}" title="Add Schedule"><ion-icon class="align-middle text-white" name="add-outline"size="medium"></ion-icon></button></td>
            </tr>
            <div class="modal fade" id="add-sched{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('add-sched') }}" method="post">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ $row->id }}">
                        Name: {{ ucfirst($row->name) }}
                      <select class="form-control mt-1" id="assignedOffice" name="shift_id" required>
                        <option class="p-1 m-1" value="" selected disabled>Select Shift
                            @foreach ($shifts as $row)
                                <option style="margin: 3px;" value="{{ $row->id }}" {{ old('shift_id', session('shift') ) == $row->id ? 'selected' : '' }}>{{ $row->name }} - {{\Carbon\Carbon::parse($row->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($row->end_time)->format('h:i A') }}</option>
                                </option>
                            @endforeach
                      </select>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Schedule</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </tbody>
      </table>
</div>
@endsection