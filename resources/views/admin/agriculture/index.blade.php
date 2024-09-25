@extends('admin.layout.master')
@section('content')

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <a href="{{ route('agriculture.pdf') }}" class="btn btn-warning" style="float: right;">Dawnload PDF</a>
                            <a href="{{ route('agriculture.create') }}" class="btn btn-warning" style="float: right;margin-right: 20px">Add New</a>
                            <h6 class="mb-4">Banner</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr No</th>
                                            <th scope="col">Crop Name</th>
                                            <th scope="col">Total Area</th>
                                            <th scope="col">Plow Name</th>
                                            <th scope="col">See</th>
                                            <th scope="col">Plow Price</th>
                                            <th scope="col">Fertilizer Name</th>
                                            <th scope="col">Fertilizer Quantity</th>
                                            <th scope="col">Fertilizer Price</th>
                                            <th scope="col">Spray Name</th>
                                            <th scope="col">Spray Price</th>
                                            <th scope="col">Labour Work</th>
                                            <th scope="col">Labour Price</th>
                                            <th scope="col">Total Bill</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($agricultures as $index => $agriculture)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $agriculture->agriculture_name }}</td>
                                                <td>{{ $agriculture->total_area }}</td>
                                                <td>{{ $agriculture->plow_name }}</td>
                                                <td>{{ $agriculture->see }}</td>
                                                <td>{{ $agriculture->plow_price }}</td>
                                                <td>{{ $agriculture->fertilizer_name }}</td>
                                                <td>{{ $agriculture->fertilizer_qty }}</td>
                                                <td>{{ $agriculture->fertilizer_price }}</td>
                                                <td>{{ $agriculture->sapray_name }}</td>
                                                <td>{{ $agriculture->sapray_price }}</td>
                                                <td>{{ $agriculture->labour_work }}</td>
                                                <td>{{ $agriculture->labour_price }}</td>
                                                <!-- Calculate Total Bill -->
                                                <td class="total-bill">
                                                    {{
                                                        $totalBill = $agriculture->plow_price + 
                                                        $agriculture->fertilizer_price + 
                                                        $agriculture->sapray_price + 
                                                        $agriculture->labour_price
                                                    }}
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" data-id="{{$agriculture->id}}" class="btn btn-danger agriculture_delete">
                                                    <i class="fas fa-trash-alt"></i> 
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="col-4 mb-3" style="float: right;">
                                    <label for="subtotal" class="form-label">Sub total</label>
                                    <input type="text" disabled="" name="subtotal" class="form-control" id="subtotal" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">
                            fruit.com</a>, All Right Reserved. 
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
        toastr.options = {
            "positionClass": "toast-top-right",
            "closeButton": true,
            "progressBar": true,
        };

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $(document).on('click', '.agriculture_delete', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var _this = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/agriculture/delete/" + id, 
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then(() => {
                            location.reload();
                        });
                            _this.closest('tr').remove();
                        },
                        error: function(response) {
                            Swal.fire(
                                'Error!',
                                'An error occurred. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });

    $(document).ready(function() {
        let subtotal = 0;
        $('.total-bill').each(function() {
            let totalBillValue = parseFloat($(this).text()) || 0;
            subtotal += totalBillValue;
        });
        $('#subtotal').val(subtotal.toFixed(2));
    });
</script>
@endpush
@endsection
