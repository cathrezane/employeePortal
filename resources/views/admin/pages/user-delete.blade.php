{{-- <div class="modal fade" id="deleteModal{{ $userId }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $userId }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your form for editing user details -->
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Add your form fields here -->
                    <!-- Example: -->
                    <div class="mb-3">
                        <input type="email" class="form-control" id="name" name="status" value="100" style="display: none" required>
                    </div>
                    <br>
                    <p class="card p-2 text-center"><i class="bi bi-exclamation-octagon-fill"></i> Deleting a user is irrevertable.</p>
                    <button type="submit" class="btn btn-primary">Delete User</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="deleteModal{{ $userId }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $userId }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Your form for deleting user -->
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}
                    <!-- Add your form fields here -->
                    <!-- Example: -->

                    <p>Are you sure you want to delete <u>{{ $user->name }}</u>?</p>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="name" name="status" value="100" style="display: none">
                    </div>
                    <p class="card p-2 text-center fs-4"><i class="bi bi-exclamation-octagon-fill fs-1 text-danger"></i> Deleting a user is irreversible.</p>
                    <!-- Button with timer -->
                    <button type="submit" class="btn btn-danger float-end">Delete User</button>
                </form>
            </div>
        </div>
    </div>
</div>
