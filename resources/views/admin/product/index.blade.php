@extends('admin.layout.master')
@section('content')

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">product</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr No</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach ($products as $index => $product)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>
                                        @if($product->category_id)
                                        {{$product->category->category_name}}
                                        @endif
                                      </td>
                                        <td>{{ $product->product_name}}</td>
                                        <td>{{ $product->price }}</td>
                                        <td><img src="{{ asset('product/images/'. $product->image) }}" width="100" height="100"></td>
                                        <td>
                                            <a href="{{ route('product.invoice', $product->id) }}" class="btn btn-warning" target="_blank">Invoice</a>
                                            <a href="{{route('product.edit',$product->id)}}" class="btn btn-success">
                                                <i class="fas fa-edit"></i> 
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{$product->id}}" class="btn btn-danger product_delete">
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
        $(document).on('click', '.product_delete', function(e) {
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
                        url: "/product/delete/" + id,  // Dynamic URL based on product ID
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
