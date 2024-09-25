@extends('admin.layout.master')
@section('content')

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="bg-secondary rounded p-4" style="width: 100%;">
                    <h6 class="mb-8 text-center">Update plow</h6>
                    <form method="POST" id="plowForm" action="{{ route('plow.update',$plow->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="plow_name" class="form-label">plow Name:(ٹریکٹر کا ہل
)</label>
                            <input type="text" name="plow_name" class="form-control" id="plow_name" value="{{$plow->plow_name}}">
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
            "positionClass": "toast-top-right", 
            "closeButton": true,
            "progressBar": true,
        };

        $('#plowForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('plow.update',$plow->id) }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    $('#plowForm')[0].reset();
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
