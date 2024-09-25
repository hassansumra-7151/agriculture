@extends('admin.layout.master')
@section('content')


<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="bg-secondary rounded p-4" style="width: 100%;">
                    <h6 class="mb-8 text-center">Agriculture</h6>
                    <form method="POST" id="AgricultureForm" action="{{ route('agriculture.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="agriculture_name" class="form-label">Crop Name:(فصل کا نام)</label>
                                <input type="text" name="agriculture_name" class="form-control" id="agriculture_name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="total_area" class="form-label">Total Area:(کل رقبہ)</label>
                                <input type="text" name="total_area" class="form-control" id="total_area" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="plowSelect" class="form-label">Select Plow Type:(ٹریکٹر کا ہل)</label>
                                <select name="plow_name" class="form-control" id="plowSelect">
                                    <option value="">Select one</option>
                                    @foreach($plows as $plow)
                                        <option value="{{ $plow->plow_name }}">{{ $plow->plow_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="typeSelect" class="form-label">See(ہل کا چکر)</label>
                                <select name="see" class="form-control" id="typeSelect">
                                    <option value="">Select one</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="plow_price" class="form-label">Price:(ہل کی قیمت)</label>
                                <input type="number" name="plow_price" class="form-control" id="plow_price">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fertilizerSelect" class="form-label">Select Fertilizer Type:(کھاد کا نام)</label>
                                <select name="fertilizer_name" class="form-control" id="fertilizerSelect">
                                    <option value="">Select one</option>
                                    @foreach($fertilizers as $fertilizer)
                                        <option value="{{ $fertilizer->fertilizer_name }}">{{ $fertilizer->fertilizer_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fertilizer_qty" class="form-label">Fertilizer Quantity:کھاد کی مقدار</label>
                                <input type="number" name="fertilizer_qty" class="form-control" id="fertilizer_qty">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fertilizer_price" class="form-label">Price:(کھاد کی قیمت)</label>
                                <input type="number" name="fertilizer_price" class="form-control" id="fertilizer_price">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sprayName" class="form-label">Spray Name:(اسپرے کا نام)</label>
                                <input type="text" name="sapray_name" class="form-control" id="sprayName">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sapray_price" class="form-label">Price:(سپرے کی قیمت)</label>
                                <input type="number" name="sapray_price" class="form-control" id="sapray_price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="labour_work" class="form-label">Labour Work:(مزدوری کا کام)</label>
                                <input type="text" name="labour_work" class="form-control" id="labour_work">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="labour_price" class="form-label">Labour Price:(مزدوری کی قیمت)</label>
                                <input type="number" name="labour_price" class="form-control" id="labour_price">
                            </div>
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
<!-- <div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
            </div>
            <div class="col-12 col-sm-6 text-center text-sm-end">
                /*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/
                Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
            </div>
        </div>
    </div>
</div> -->
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

        $('#AgricultureForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('agriculture.store') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    $('#AgricultureForm')[0].reset();
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
