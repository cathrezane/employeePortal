@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <label class="fs-3" for="">Campaigns</label>
            <a href="/admin/campaigns/create" class="btn btn-success align-middle">Add Campaign</a>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Campaigns</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($campaigns as $row)
              <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $row->name }}</td>
                <td class="d-flex align-middle">
                    <a href="/admin/campaigns/{{ $row->id }}/edit" class="btn btn-warning align-middle">Edit</a>
                    <form id="delete-form-{{ $row->id }}" action="{{ route('campaigns.destroy', $row->id) }}" method="POST">
                        @csrf
                        @method('DELETE')  
                        <button type="submit" class="btn btn-danger delete-campaign" data-name="{{ $row->name }}">Delete</button>
                    </form>                         
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-between mb-0 px-3">
            <p>Showing {{ $campaigns->firstItem() }} - {{ $campaigns->lastItem() }} of {{ $campaigns->total() }}</p>
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{ $campaigns->links('pagination::bootstrap-4') }}
            </ul>
            </nav>
        </div>
    </div>
   
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Add event listener to form submission
    document.querySelectorAll('.delete-campaign').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default form submission
            
            const form = document.getElementById('delete-form-' + button.dataset.id);
            const campaignName = button.dataset.name;
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to delete the campaign: " + campaignName + ". You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if confirmed
                }
            });
        });
    });
</script> --}}
@endsection