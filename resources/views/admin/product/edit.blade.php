@extends('admin.layout.master')
@section('content')


<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="bg-secondary rounded p-4" style="width: 100%;">
                    <h6 class="mb-8 text-center">Update Product</h6>
                    <form method="POST" id="productForm" action="{{ route('product.update',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="parentCategory" class="form-label">Parent Category</label>
                            <select class="form-select" name="category_id" id="parentCategory">
                                @foreach($categories as $category)
                                      <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                                  @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="productName" value="{{$product->product_name}}">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" id="price" value="{{$product->price}}">
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" name="image" class="form-control" id="productImage" value="{{$product->image}}">
                             <input type="hidden" name="oldimg" class="form-control col-md-7 col-xs-12" value="{{$product->image}}">
                          <img id="imagePreview" src="{{ asset('product/images/'.$product->image) }}" style="max-width: 200px; height: 200px; border-radius: 50%;">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
@push('footer-script')
<script>
        $(document).ready(function() {
            $('#productForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('product.update',$product->id) }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success(response.message);
                        $('#productForm')[0].reset();
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value);
                        });
                    }
                });
            });
        });
</script>
@endpush
@endsection
