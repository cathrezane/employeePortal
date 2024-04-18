@extends('layouts.admin')

@section('content')
@if (session()->has('error'))
<script>
    Swal.fire({
    title: "Error!",
    text: "{{ session()->get('error') }}",
    icon: "error",
    type: "error",
    });
</script>
@endif
@if (session()->has('success'))
<script>
    Swal.fire({
    title: "Success!",
    text: "{{ session()->get('success') }}",
    icon: "success",
    type: "success",
    });
</script>
@endif
@if (session()->has('warning'))
<script>
    Swal.fire({
    title: "Warning!",
    text: "{{ session()->get('warning') }}",
    icon: "warning",
    type: "warning",
    });
</script>
@endif

<div class="container mt-4">
    <label class="text-left" style="font-size: 2rem;">User Management</label>
    <div class="d-flex float-end">
        <form action="{{ route('admin.user-management') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Search Users..." value="{{ request()->query('search') }}">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">More Options</th>
        </tr>
        </thead>
        <tbody>
            {{-- href="/admin/{{ $row->id }}/edit-user" --}}
            @foreach ($users as $user)
            <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $user->name }}</td>
                <td class="align-middle">{{ $user->email }}</td>
                <td class="align-middle">
                    @if ($user->status != 20)
                        <span class="badge rounded-pill bg-success">Enabled</span>
                    @else
                        <span class="badge rounded-pill bg-danger">Disabled</span>
                    @endif
                </td>
                <td class="align-middle">
                    <button class="btn btn-warning py-0 pb-1 me-1"  href="{{ route('users.edit', $user->id) }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}" aria-hidden="true" ><i class="bi bi-pencil-square" title="Edit"></i></a></li>
                    @if ($user->status != 20)
                        <button class="btn btn-outline-danger py-0 pb-1  me-1" href="{{ route('users.disable', $user->id) }}" data-bs-toggle="modal" data-bs-target="#disableModal{{ $user->id }}" aria-hidden="true" title="Disable" style="z-index: 1050;"><i class="bi bi-x-circle py-auto"></i></a></li>
                    @else
                        <button class="btn btn-success text-white py-0 pb-1 me-1" href="{{ route('users.enable', $user->id) }}" data-bs-toggle="modal" data-bs-target="#enableModal{{ $user->id }}" aria-hidden="true" title="enable" style="z-index: 1050;"><i class="bi bi-check2-circle"></i></a></li>
                    @endif
                    <button class="btn btn-danger text-white py-0 pb-1  me-1"  tabindex="-1" href="{{ route('users.destroy', $user->id) }}" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}" aria-hidden="true" title="Delete" style="z-index: 1050;"><i class="bi bi-trash"></i></a></li>
                    <button class="btn btn-primary text-white py-0 pb-1 "  tabindex="-1" href="{{ route('users.reset', $user->id) }}" data-bs-toggle="modal" data-bs-target="#resetModal{{ $user->id }}" aria-hidden="true"  title="Reset Password" style="z-index: 1050;"><i class="bi bi-arrow-counterclockwise"></i></a></li>
                </td>
                
                {{-- <td><a class="btn btn-secondary py-0" href="{{ route('users.disable', $user->id) }}" data-bs-toggle="modal" data-bs-target="#resetModal{{ $user->id }}">Disable</a></td>
                <td><a class="btn btn-success py-0" href="{{ route('users.enable', $user->id) }}" data-bs-toggle="modal" data-bs-target="#resetModal{{ $user->id }}">Enable</a></td>
                <td><a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger py-0" data-bs-toggle="modal" data-bs-target="#resetModal{{ $user->id }}">Delete</a></td>
                <td><a class="btn btn-primary py-0" href="{{ route('users.reset', $user->id) }}" data-bs-toggle="modal" data-bs-target="#resetModal{{ $user->id }}">Reset Password</a></td> --}}
            </tr>
                @include('admin.pages.user-edit', ['userId' => $user->id])
                @include('admin.pages.user-disabled', ['userId' => $user->id])
                @include('admin.pages.user-enable', ['userId' => $user->id])
                @include('admin.pages.user-delete', ['userId' => $user->id])
                @include('admin.pages.reset-password', ['userId' => $user->id])
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn bg-success text-white float-start me-2" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="bi bi-plus-circle fa-1x"></i> Add User</button> &nbsp;
    @if(session()->has('newUser'))
        <button type="button" class="btn bg-primary text-white float-start ms-2" data-bs-toggle="modal" data-bs-target="#newUserModal"><i class="bi bi-info-circle"></i> Show Recent</button>
    @endif
    @if(session()->has('resetPassword'))
        <button type="button" class="btn btn-dark float-start ms-2" data-bs-toggle="modal" data-bs-target="#resetP"><i class="bi bi-info-circle"></i> Show Recent Password</button>
    @endif
    <br>
    <br>
    <hr>
    @if ( $users->hasPages())
    <div class="d-flex justify-content-between mb-0 px-3">
        <p>Showing {{  $users->firstItem() }} - {{  $users->lastItem() }} of {{  $users->total() }}</p>
        <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            {{  $users->links('pagination::bootstrap-4') }}
        </ul>
        </nav>
    </div>
    @endif
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <Label>Name <span><span class="text-danger fs-4">*</span></span></Label>
            <input class="form-control" type="text" name="name" id="name">
            <Label>Email <span><span class="text-danger fs-4">*</span></Label>
            <input class="form-control mb-2" type="email" name="email" id="email">
            <p disabled><i>Password is Auto-Generated</i></p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary float-start" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary float-end">Add User</button>
            </form>
        </div>
      </div>
    </div>
</div>

@php
$newUsera = session('newUser');
@endphp
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">New User Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                <div>
                    <p class="align-middle"><i class="bi bi-exclamation-circle text-danger"></i> Kindly save the information before closing the pop-up.</p>
                </div>
                <div class="d-flex justify-content-between">
                    @if(session()->has('newUser') && session('newUser') !== null)
                    <div class="p-2">
                        <p>Name: <h4> {{ session('newUser')->name }}</h4></p>
                    </div>
                    <div class=" p-2">
                        <p>Email: <h4> {{ session('newUser')->email }}</h4></p>
                    </div>
                    @endif
                </div>
                <div class="p-2">
                    @if (session()->has('generatedPassword'))
                    <p>Generated Password: <h4>{{ session('generatedPassword') }}</h4></p>
                    @endif
                </div>
            </div>
            
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary float-start" data-bs-dismiss="modal">Close</button>
            </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="resetP" tabindex="-1" aria-labelledby="resetPLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Updated User Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                <div>
                    <p class="align-middle"><i class="bi bi-exclamation-circle text-danger"></i> Kindly save the information before closing the pop-up.</p>
                </div>
                <div class="d-flex justify-content-between">
                    @if(session()->has('resetPassword'))
                    <div class="p-2">
                        <p>Name: <h4> {{ session('username') }}</h4></p>
                    </div>
                    <div class=" p-2">
                        <p>Password: <h4> {{ session('resetPassword') }}</h4></p>
                    </div>
                    @endif
                </div>
            </div>
            
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary float-start" data-bs-dismiss="modal">Close</button>
            </form>
        </div>
      </div>
    </div>
</div>




@if(session('newUser'))
    <script>
        $(document).ready(function(){
            $('#newUserModal').modal('show');
        });
    </script>
@endif

@endsection