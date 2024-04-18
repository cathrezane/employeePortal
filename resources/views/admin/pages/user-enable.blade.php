<div class="modal fade" id="enableModal{{ $userId }}" tabindex="-1" aria-labelledby="enableModalLabel{{ $userId }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disableModalLabel">Confirm Enalbe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your form for editing user details -->
                <form action="{{ route('users.enable', $user->id) }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}
                    <!-- Add your form fields here -->
                    <!-- Example: -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Are you sure you want to enable this user?</label>
                        <h5>{{ $user->name }}</h5>
                    </div>
                    <p class="text-muted text-sm"><i class="bi bi-exclamation-diamond-fill text-warning"></i> Enabling this user will allow them to log in.</p>
                    <button id="timerButton" class="btn btn-primary float-end">Enable User</button>
                </form>
            </div>
        </div>
    </div>
</div>
