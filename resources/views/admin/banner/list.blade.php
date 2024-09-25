@extends('admin.layout.master')
@section('content')

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Banner</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr No</th>
                                        <th scope="col">Banner Title</th>
                                        <th scope="col">visibility Status</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach ($banners as $index => $banner)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $banner->title}}</td>
                                        <td>
                                            @if($banner->status == 1)
                                                <span class="badge badge-primary label-mini">Active</span>
                                            @else
                                                <span class="badge badge-danger label-mini">Inactive</span>
                                            @endif
                                        </td>



                                        <td><img src="{{ asset('banners/'. $banner->image) }}" width="100" height="100"></td>
                                        <td>
                                            <a href="{{ route('banner.edit',$banner->id)}}" class="btn btn-success">
                                                <i class="fas fa-edit"></i> 
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{$banner->id}}" class="btn btn-danger banner_delete">
                                                <i class="fas fa-trash-alt"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table End -->


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
            "positionClass": "toast-top-right",
            "closeButton": true,
            "progressBar": true,
        };

        // Get CSRF token from meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Handle delete button click
        $(document).on('click', '.banner_delete', function(e) {
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
                        url: "/banner/delete/" + id,  // Dynamic URL based on banner ID
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
