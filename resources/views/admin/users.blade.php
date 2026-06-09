@include('layouts.app')


@section('content')
    <table id="usersTable" class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge badge-primary">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td>Action</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            lengthChange: true,
            responsive: true
        });

        // SweetAlert delete handler
        $('#usersTable').on('click', '.delete-btn', function() {
            let url = $(this).data('url');

            Swal.fire({
                title: "Are you sure?",
                text: "This user will be deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef4444",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Yes, delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Deleting...',
                                allowOutsideClick: false,
                                didOpen: () => Swal.showLoading()
                            });
                        },
                        success: function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'User deleted!',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            $('#usersTable').DataTable().row($(this).parents('tr'))
                                .remove().draw();
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong!',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        });
    });
</script>
