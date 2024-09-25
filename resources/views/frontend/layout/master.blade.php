<!DOCTYPE html>
<html lang="en">

    @include('frontend.partcial.css')

    <body>
        <!-- Spinner Start -->
       
        </div>
        @include('frontend.partcial.nav')
    
        @yield('content')

       @include('frontend.partcial.footer')
       
       @include('frontend.partcial.js')
        
    </body>

</html>