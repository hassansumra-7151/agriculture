 <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('')}}/admin/lib/chart/chart.min.js"></script>
    <script src="{{url('')}}/admin/lib/easing/easing.min.js"></script>
    <script src="{{url('')}}/admin/lib/waypoints/waypoints.min.js"></script>
    <script src="{{url('')}}/admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{url('')}}/admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{url('')}}/admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{url('')}}/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{url('')}}/admin/js/main.js"></script>
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
   </script>
@stack('footer-script')