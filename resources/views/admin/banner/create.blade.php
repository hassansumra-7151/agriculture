@extends('admin.layout.master')

@section('content')
<section id="main-content" class="bg-dark text-light">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="card bg-dark text-light">
                    <div class="card-header bg-dark text-light">
                        <a href="#" class="btn btn-primary float-right">Back</a>
                    </div>
                    <div class="card-body bg-secondary text-light">
					    <form class="needs-validation" action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="bannerForm">
					        @csrf
					        <div class="form-row">
					            <div class="col-md-6 mb-3">
					                <label for="validationCustom01">Banner Title:</label>
					                <input type="text" class="form-control bg-dark text-light @error('title') is-invalid @enderror" id="validationCustom01" placeholder="Enter Banner Title" name="title" value="{{ old('title') }}">
					                @error('title')
					                    <div class="invalid-feedback">{{ $message }}</div>
					                @enderror
					            </div>
					            <div class="col-md-6 mb-3">
					                <label for="validationCustom02">Status</label>
					                <select class="form-control bg-dark text-light @error('status') is-invalid @enderror" name="status">
					                    <option value="">Please Select Status</option>
					                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
					                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
					                </select>
					                @error('status')
					                    <div class="invalid-feedback">{{ $message }}</div>
					                @enderror
					            </div>
					        </div>
					        <div class="row">
					            <div class="col-md-6 mb-3">
					                <label for="product_images">Image:</label>
					                <input type="file" class="form-control bg-dark text-light @error('image') is-invalid @enderror" id="image" name="image">
					                @error('image')
					                    <div class="invalid-feedback">{{ $message }}</div>
					                @enderror
					            </div>
					            <div class="col-md-6 mb-3">
					                <label for="product_images">Second Image:</label>
					                <input type="file" class="form-control bg-dark text-light @error('second_image') is-invalid @enderror" id="second_image" name="second_image">
					                @error('second_image')
					                    <div class="invalid-feedback">{{ $message }}</div>
					                @enderror
					            </div>
					        </div>
					        <div class="row">
					            <div class="col-md-12 mb-3">
					                <label for="validationCustom01">Short Description:</label>
					                <textarea class="form-control bg-dark text-light @error('short_desc') is-invalid @enderror" id="short_desc" placeholder="Enter Short Description" name="short_desc" rows="6">{{ old('short_desc') }}</textarea>
					                @error('short_desc')
					                    <div class="invalid-feedback">{{ $message }}</div>
					                @enderror
					            </div>
					        </div>
					        <button class="btn btn-primary" type="submit">Submit</button>
					    </form>
					</div>

                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
@push('footer-script')
    <script>
            $(document).ready(function() {
                $('#bannerForm').on('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    $.ajax({
                        url: "{{ route('banner.store') }}",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            toastr.success(response.message);
                            $('#bannerForm')[0].reset();
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
