@extends('layouts.hr-master')

@section('content')
<style>
    .shift-days td {
  white-space: nowrap; /* Prevent wrapping */
  width: 150px; /* Adjust width as needed */
  overflow: hidden; /* Hide overflowing content */
  text-overflow: ellipsis; /* Add ellipsis (...) for overflowing text */
}
</style>

<div class="col-auto float-right ml-auto">
    <a href="{{ route('shiftlist') }}" class="btn add-btn m-r-5">Shifts</a>
    <button type="button" class="btn add-btn m-r-5" data-bs-toggle="modal" data-bs-target="#add-schedule"> Add Shift</button>
<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Shift Name</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col" class="">Days</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($shifts as $index => $row)
            <tr>
                <td class="shift-days">{{ $index + 1 }}</td>
                <td class="shift-days ">{{ $row->name }}</td>
                <td class="shift-days ">{{ \Carbon\Carbon::parse($row->start_time)->format('h:i A') }}</td>
                <td class="shift-days ">{{ \Carbon\Carbon::parse($row->end_time)->format('h:i A') }}</td>
                {{-- Assuming each $days[$index] is an array of names --}}
                <td class="shift-days ">
                    @foreach ($days[$index] as $day)
                        <span class="me-2">{{ $day }}</span>
                    @endforeach
                </td>
                <td><a href="/hr/{{ $row->id }}/edit-shift" class="shift-days btn btn-warning py-0">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>


@if (session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="modal fade" id="add-schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Shift</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('addShift') }}" id="addShiftForm">
                @csrf
            
                <div class="d-flex p-2">
                    <div class="d-block form-group col-md-8">
                        <label for="">Shift Name<span class="text-danger fs-4">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Shift Name"  required>
                        
                        <label for="">Start Time<span class="text-danger fs-4">*</span></label>
                        <input type="time" class="form-control" name="start_time" required>
                        
                        <label for="">End Time<span class="text-danger fs-4">*</span></label>
                        <input type="time" class="form-control" name="end_time" required>
                    </div>
                </div>
                
                <label for="" class="p-1">Choose Workday:</label><br>
                @foreach ($dayNames as $row)
                    <div class="form-check form-check-inline mb-3">
                        <input type="checkbox" class="form-check-input mr-2" name="days[]" id="{{ $row->id }}" value="{{ $row->id }}">
                        <label class="form-check-label" for="{{ $row->id }}">{{ $row->name }}</label>
                    </div>
                @endforeach
                    <br>
                <button type="submit" class="btn btn-primary">Save Schedule</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('addShiftForm').addEventListener('submit', function(event) {
        var checkboxes = document.querySelectorAll('input[name="days[]"]:checked');
        if (checkboxes.length !== 5) {
            event.preventDefault(); // Prevent form submission
            alert('Choose 5 workdays');
        }
    });
</script>
@endsection