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

<div class="col-auto float-right ml-auto mt-5">
<div class="container">
    <label class="text-left" style="font-size: 2rem;">Shift List</label><br> 
    <button type="button" class="btn add-btn bg-success text-white m-r-5 float-end" data-bs-toggle="modal" data-bs-target="#add-schedule"><i class="bi bi-plus-circle fa-1x"></i> Add Shift</button>
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
        <div class="modal-body mt-0">
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
                
                <label for="" class="p-1">Choose Workday: Select '(5)'<span class="text-danger fs-4">*</span></label><br>
                @foreach ($dayNames as $row)
                    <div class="form-check form-check-inline mb-3">
                        <input type="checkbox" class="form-check-input mr-2" name="days[]" id="{{ $row->id }}" value="{{ $row->id }}">
                        <label class="form-check-label" for="{{ $row->id }}">{{ $row->name }}</label>
                    </div>
                @endforeach
                    <br>
                    <hr>
                <button type="submit" class="btn btn-primary">Save Schedule</button>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
  // Get elements
  const checkboxes = document.querySelectorAll('.form-check-input');
  const submitButton = document.querySelector('.btn-primary');
  const selectLabel = document.querySelector('label[for=""]'); // Assuming the label is for the first checkbox

  // Initial count and disabled state
  let checkedCount = 0;
  submitButton.disabled = true;
  selectLabel.textContent = 'Choose Workday: Select ' + (5 - checkedCount);

  // Event listener for checkboxes
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', (event) => {
      checkedCount = document.querySelectorAll('.form-check-input:checked').length;

      // Update label
      selectLabel.textContent = 'Choose Workday: Select ' + (5 - checkedCount);

      // Enable/disable button
      submitButton.disabled = checkedCount !== 5;
    });
  });
});
</script>
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