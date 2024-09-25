@extends('admin.layout.master')
@section('content')

<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Role : {{$role->name}}</h2>
            </div>
            <div class="text-center">
                <a class="btn btn-success" style="float: right;" href="{{ route('role.list')}}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('give.permission',$role->id)}}" id="giveRole">
                @csrf
                <div class="form-group">
                    <label for="name">Permission:</label>
                    <br><br>
                    <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-2">
                            <label>
                                <input type="checkbox"
                                       class="form-check-input"
                                       id="permission_{{ $permission->id }}"
                                       name="permission[]"
                                       value="{{ $permission->name }}"
                                       {{ in_array($permission->id, $assignedPermissions) ? 'checked' : '' }}>
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>


                </div>
                <br>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>


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
            "positionClass": "toast-top-right",
            "closeButton": true,
            "progressBar": true,
        };

        $('#giveRole').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    location.reload();
                    $('#giveRole')[0].reset();
                },
                error: function(response) {
                    if(response.responseJSON.errors) {
                        $.each(response.responseJSON.errors, function(key, value) {
                            toastr.error(value);
                        });
                    } else {
                        toastr.error('name already axist.');
                    }
                }
            });
        });
    });
</script>

@endpush
@endsection
