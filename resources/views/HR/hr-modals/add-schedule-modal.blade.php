{{-- <div class="modal fade" id="add-sched{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    @if($userSchedules ->isEmpty())
                    <p>No details found for this user.</p>
                    @else
                        <ul>
                            @foreach($userSchedules  as $detail)
                                <li>{{ $detail->shift_id }}: </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}