<div class="modal fade" id="editModal{{ $editAgentSchedID }}" tabindex="-1" aria-labelledby="editModalLabel{{ $editAgentSchedID }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
          <form action="{{ route('hr_schedule.update') }}" method="post">
            @csrf
          <input value="{{ $user->id }}" name="user_id" id="user_id" style="display: none;">
          <span>Current Shift Schedule: {{ $user->schedule->shift->name }}</span><br>
          New Shift Schedule: <select class="form-control-sm col-md-4" name="shift_id" id="shift_id">
            <option selected disabled>Select Shift</option>
              @foreach($shifts as $shift)
                  <option value="{{ $shift->id }}">{{ $shift->name }} ({{\Carbon\Carbon::parse($shift->start_time)->format('h:i A') }} - {{\Carbon\Carbon::parse($shift->end_time)->format('h:i A') }})
              @endforeach
          </select>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>