<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">
        @if (Route::currentRouteName() == 'product.shop')
            Shop
        @elseif (Route::currentRouteName() == 'product.view.product')
            Product Detail
        @elseif (Route::currentRouteName() == 'product.cart')
            Cart
        @elseif (Route::currentRouteName() == 'product.checkout')
            Checkout
        @endif
    </h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">
            @if (Route::currentRouteName() == 'product.shop')
                Shop
            @elseif (Route::currentRouteName() == 'product.view.product')
                Product Detail
            @elseif (Route::currentRouteName() == 'product.cart')
                Cart
            @elseif (Route::currentRouteName() == 'product.checkout')
                Checkout
            @endif
        </li>
    </ol>
</div>
