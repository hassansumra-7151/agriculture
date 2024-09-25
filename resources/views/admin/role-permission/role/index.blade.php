@extends('admin.layout.master')
@section('content')

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="text-center">
                        <h2>Role Management:</h2>
                    </div>
                    <div class="text-center">
                        <a class="btn" style="float: right; background: #FF6600; color: white" href="{{ route('role.create') }}"> Add Role</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach($roles as $key => $role)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{route('add.permission',$role->id)}}">Add / Update Permission</a>
                            @can('update role')
                            <a class="btn btn-primary" href="{{route('role.edit',$role->id)}}">Edit</a>
                            @endcan
                            @can('delete role')
                            <button class="btn btn-danger role_delete" data-id="{{ $role->id }}">Delete</button>
                            @endcan
                            
                        </td>
                    </tr>
                    @endforeach
                    <!-- Add more rows as needed -->
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
            $(document).on('click', '.role_delete', function(e) {
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
                            url: "{{ route('role.delete',$role->id) }}",
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
