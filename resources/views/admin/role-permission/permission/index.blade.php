@extends('admin.layout.master')
@section('content')

            <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="text-center">
                    <h2>Permission Management</h2>
                </div>
                <div class="text-center">
                    <a class="btn" style="float: right; background:  #FF6600;color: white" href="{{ route('permission.create') }}"> Add permission</a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach($permissions as $key => $permission)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$permission->name}}</td>
                        <td>
                            @can('update permission')
                                <a class="btn btn-primary" href="{{route('edit.permission',$permission->id)}}">Edit</a>
                                @endcan
                                @can('delete permission')
                                <a class="btn btn-danger permission_delete" data-id="{{ $permission->id }}" href="javascript:void(0)">Delete</a>
                                @endcan
                        </td>
                    </tr>
                @endforeach
                <!-- Add more rows as needed -->
                
            </table>
        </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">
                            fruit.com</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>


@push('footer-script')
<script>
    $(document).ready(function() {
        toastr.options = {
            "positionClass": "toast-top-right", // Change this to "toast-top-left", "toast-bottom-right", "toast-bottom-left" as needed
            "closeButton": true,
            "progressBar": true,
        };

        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('category.store') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    $('#categoryForm')[0].reset();
                },
                error: function(response) {
                    if(response.responseJSON.errors) {
                        $.each(response.responseJSON.errors, function(key, value) {
                            toastr.error(value);
                        });
                    } else {
                        toastr.error('An error occurred. Please try again.');
                    }
                }
            });
        });
    });
</script>
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
        $(document).on('click', '.permission_delete', function(e) {
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
                        url: "{{ url('permissions') }}/" + id,
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
