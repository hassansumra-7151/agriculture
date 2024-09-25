@extends('admin.layout.master')
@section('content')
 <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>User Management</h2>
            </div>
            <div class="text-center">
                <a class="btn" style="float: right; background:  #FF6600;color: white" href="{{ route('user.create') }}"> Add User</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
            @foreach($users as $key => $user)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $roleName)
                                <label class="badge bg-secondary mx-1">{{ $roleName }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                    	@can('update user')
                            <a class="btn btn-primary" href="{{ route('user.edit',$user->id)}}">Edit</a>
                            @endcan
                            <a class="btn btn-danger user_delete" data-id="{{ $user->id }}" href="javascript:void(0)">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@push('footer-script')
   <script>
    $(document).ready(function() {
        toastr.options = {
            "positionClass": "toast-top-right",
            "closeButton": true,
            "progressBar": true,
        };

        // Get CSRF token from meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Handle delete button click
        $(document).on('click', '.user_delete', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var _this = $(this);

            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/user/delete/' + id, // Dynamically set the user ID in the URL
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                            _this.closest('tr').remove();
                        },
                        error: function(response) {
                            Swal.fire(
                                'Error!',
                                'An error occurred. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>


@endpush
@endsection