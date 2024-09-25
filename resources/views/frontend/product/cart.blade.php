@extends('frontend.layout.master')

@section('content')
@include('frontend.partcial.breadcrumb')

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('product/images/' . $cart->product->image) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{ $cart->product->product_name }}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4 product-price">{{ $cart->product->price }}$</p>
                        </td>
                        <td>
                            <div class="input-group quantity mt-4" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" data-id="{{ $cart->id }}" data-price="{{ $cart->product->price }}">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0 qty-input" data-id="{{ $cart->id }}" value="{{ $cart->qty }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border" data-id="{{ $cart->id }}" data-price="{{ $cart->product->price }}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 mt-4 total-price" id="total-price-{{ $cart->id }}">{{ number_format($cart->qty * $cart->product->price, 2) }} $</p>
                        </td>
                        <td>
                             <a href="javascript:void(0)" class="btn btn-md rounded-circle bg-light border mt-4 delete-btn" data-id="{{ $cart->id }}">
                                <i class="fa fa-times text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div>

        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0" id="subtotal">{{ number_format($carts->sum(function ($cart) {
                                return $cart->qty * $cart->product->price;
                            }), 2) }} $</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0" id="shipping">Flat rate: $3.00</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Shipping to Ukraine.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4" id="total">{{ number_format($carts->sum(function ($cart) {
                            return $cart->qty * $cart->product->price;
                        }) + 3, 2) }} $</p>
                    </div>
                   <form action="{{ route('product.checkouts') }}" method="POST">
                    @csrf
                    <!-- Include cart data as hidden inputs -->
                    @foreach($carts as $cart)
                        <input type="hidden" name="cart[{{ $cart->id }}][id]" value="{{ $cart->id }}">
                        <input type="hidden" name="cart[{{ $cart->id }}][qty]" value="{{ $cart->qty }}">
                    @endforeach

                    <!-- Hidden fields for subtotal and total -->
                    <input type="hidden" name="subtotal" value="{{ number_format($carts->sum(function ($cart) {
                        return $cart->qty * $cart->product->price;
                    }), 2) }}">
                    <input type="hidden" name="total" value="{{ number_format($carts->sum(function ($cart) {
                        return $cart->qty * $cart->product->price;
                    }) + 3, 2) }}">

                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="submit">Proceed Checkout</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('footer-script')
<script>
$(document).ready(function() {
    const shippingCost = 3.00; // Flat rate shipping cost

    // Function to update the total price for each item
    function updateTotalPrice(cartId, newQty, price) {
        const newTotal = (newQty * price).toFixed(2);
        $('#total-price-' + cartId).text(newTotal + ' $');
    }

    // Function to update the subtotal
    function updateSubtotal() {
        let subtotal = 0;
        $('.qty-input').each(function() {
            const cartId = $(this).data('id');
            const qty = parseInt($(this).val(), 10);
            const price = parseFloat($('.btn-plus[data-id="' + cartId + '"]').data('price'));
            subtotal += qty * price;
        });
        $('#subtotal').text(subtotal.toFixed(2) + ' $');
        return subtotal;
    }

    // Function to update the total amount
    function updateTotalAmount() {
        const subtotal = updateSubtotal();
        const total = (subtotal + shippingCost).toFixed(2);
        $('#total').text(total + ' $');
    }

    // Handle quantity increase
    $('.btn-plus').click(function() {
        const cartId = $(this).data('id');
        const price = parseFloat($(this).data('price'));
        let qtyInput = $('.qty-input[data-id="' + cartId + '"]');
        let currentQty = parseInt(qtyInput.val(), 10);

        // Increment the quantity
        let newQty = currentQty + 0;
        qtyInput.val(newQty);

        // Update the total price for the specific cart item
        updateTotalPrice(cartId, newQty, price);

        // Update the subtotal and total amount
        updateTotalAmount();
    });

    // Handle quantity decrease
    $('.btn-minus').click(function() {
        const cartId = $(this).data('id');
        const price = parseFloat($(this).data('price'));
        let qtyInput = $('.qty-input[data-id="' + cartId + '"]');
        let currentQty = parseInt(qtyInput.val(), 10);

        if (currentQty > 0) {
            // Decrement the quantity
            let newQty = currentQty - 0;
            qtyInput.val(newQty);

            // Update the total price for the specific cart item
            updateTotalPrice(cartId, newQty, price);

            // Update the subtotal and total amount
            updateTotalAmount();
        }
    });

    // Initialize the totals on page load
    updateTotalAmount();
});
</script>
<script>
$(document).ready(function() {
    $('.delete-btn').on('click', function() {
        var rowId = $(this).data('id');
        var rowSelector = '#row-' + rowId;

        // Show confirmation dialog
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this item!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // Proceed with deletion
                $.ajax({
                    url: '{{ route("product.delete-item") }}', 
                    method: 'POST',
                    data: {
                        id: rowId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $(rowSelector).remove(); 
                            updateTotalAmount(); 
                            toastr.success("Item deleted successfully!");
                            location.reload();
                        } else {
                            toastr.error("Error deleting item.");
                        }
                    },
                    error: function() {
                        toastr.error("Error sending request.");
                    }
                });
            } else {
                toastr.info("Item deletion cancelled.");
            }
        });
    });

    // Function to update the total amount
    function updateTotalAmount() {
        let subtotal = 0;
        $('.total-price').each(function() {
            subtotal += parseFloat($(this).text().replace('$', ''));
        });
        $('#subtotal').text(subtotal.toFixed(2) + ' $');
        $('#total').text((subtotal + 3.00).toFixed(2) + ' $'); // Assuming flat rate shipping cost of $3.00
    }

    // Initialize the totals on page load
    updateTotalAmount();
});
</script>

@endpush
@endsection
