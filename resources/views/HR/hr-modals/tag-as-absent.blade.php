<div class="modal fade" id="tagAbsentModal{{ $tagAgentSchedID }}" tabindex="-1" aria-labelledby="editModalLabel{{ $tagAgentSchedID }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        {{-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tag {{ $user->name }} as Absent</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> --}}
        <div class="modal-body text-start align-middle">
            <form action="{{ route('hr_schedule.tag-absent', $user->id) }}" method="post">
                @csrf
                <p class="align-middle pb-0 text-center fs-3">Are you sure you want to tag <u>{{ $user->name }}</u> as absent?</p>
                <input value="{{ $user->id ?? null }}" name="user_id" id="user_id" style="display: none;">
                <input type="text" name="status" value="3" style="display: none">
        </div>
        <div class="modal-footer justify-content-between mt-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger">Yes</button>
        </div>
      </form>
      </div>
    </div>
  </div>