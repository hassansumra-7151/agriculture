<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ url('') }}/admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('') }}/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ url('') }}/admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Sign Up</h3>
                            </a>
                            
                        </div>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                           <div class="form-floating mb-3">
                                <x-text-input id="floatingText" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
                                <x-input-label for="floatingText" :value="__('Name')" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="form-floating mb-3">
                                <x-text-input id="floatingInput" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                                <x-input-label for="floatingInput" :value="__('Email')" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                             <div class="form-floating mb-4">
                                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                                <x-input-label for="password" :value="__('Password')" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="form-floating mb-4">
                                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                        </form>
                        <p class="text-center mb-0">Already have an Account? <a href="{{ route('admin.login')}}">Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/admin/lib/chart/chart.min.js"></script>
    <script src="{{ url('') }}/admin/lib/easing/easing.min.js"></script>
    <script src="{{ url('') }}/admin/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ url('') }}/admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ url('') }}/admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{ url('') }}/admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{ url('') }}/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ url('') }}/admin/js/main.js"></script>
</body>

</html>
