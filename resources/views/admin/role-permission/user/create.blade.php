@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2>Add User Management</h2>
            </div>
            <div class="text-center">
                <a class="btn" style="float: right; background:  #FF6600;color: white" href="{{ route('user.list')}}"> Back</a>
            </div>
        </div>
    </div>
    @if(@!$user->id)
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('user.store')}}" id="userForm">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name"s>
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="text" class="form-control" id="name" name="email">
                </div>
                <div class="form-group">
                    <label for="name">Password:</label>
                    <input type="password" class="form-control" id="name" name="password">
                </div>
                <div class="form-group">
                    <label for="name">Roles:</label>
                    <select name="roles[]" class="form-control" multiple>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{$role}}">{{$role}}</option>
                        @endforeach
                    </select>

                </div>

                <br>
                <button type="submit" class="btn" style="background:#FF3399;color: white">Submit</button>
            </form>
        </div>
    </div>
    @else()
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('user.update',$user->id)}}" id="userForm">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="email" class="form-control" readonly="" id="email" name="email" value="{{$user->email}}">
                </div>
                <!-- <div class="form-group">
                    <label for="name">Password:</label>
                    <input type="password" class="form-control" id="name" name="password" value="{{$user->password}}">
                </div> -->
                <div class="form-group">
                    <label for="name">Roles:</label>
                    <select name="roles[]" class="form-control" multiple>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option 
                            value="{{$role}}"
                            {{ in_Array($role, $userRoles) ? 'selected' :''}}
                            >{{$role}}</option>
                        @endforeach
                    </select>

                </div>

                <br>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
    @endif
</div>

@push('footer-script')
<script>
    $(document).ready(function() {
        toastr.options = {
            "positionClass": "toast-top-right", // Change this to "toast-top-left", "toast-bottom-right", "toast-bottom-left" as needed
            "closeButton": true,
            "progressBar": true,
        };

        $('#userForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'), // Use the form's action attribute for URL
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    $('#userForm')[0].reset();
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