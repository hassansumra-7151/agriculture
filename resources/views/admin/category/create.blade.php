@extends('admin.layout.master')
@section('content')

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="bg-secondary rounded p-4" style="width: 100%;">
                    <h6 class="mb-8 text-center">Category</h6>
                    <form method="POST" id="categoryForm" action="{{ route('category.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" id="categoryName">
                        </div>
                        <div class="mb-3">
                            <label for="parentCategory" class="form-label">Parent Category</label>
                            <select class="form-select" name="category_id" id="parentCategory">
                                <option selected disabled>Select Parent Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                &copy; <a href="#">Your Site Name</a>, All Right Reserved.
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
@endpush
@endsection
