<div class="modal fade" id="disableModal{{ $userId }}" tabindex="-1" aria-labelledby="disableModalLabel{{ $userId }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disableModalLabel">Confirm Disable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your form for editing user details -->
                <form action="{{ route('users.disable', $user->id) }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}
                    <!-- Add your form fields here -->
                    <!-- Example: -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Are you sure you want to disable this user?</label>
                        <h5>{{ $user->name }}</h5>
                    </div>
                    <p class="text-muted text-sm"><i class="bi bi-exclamation-diamond-fill text-warning"></i><i> Disabling this user will prevent them from logging in.</i></p>
                    <button id="timerButton" class="btn btn-primary float-end">Disable User</button>
                    {{-- <button id="timerButton" class="btn btn-primary float-end" disabled>Disable User (10s)</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
