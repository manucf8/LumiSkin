{{-- Author: Juan Pablo Zuluaga Pelaez  --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>@yield('title', __('app.lumiskin'))</title>
</head>

<body>
    @if($errors->any())
    <ul class="alert alert-danger list-unstyled">
        @foreach($errors->all() as $error)
        <li>- {{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">{{ __('app.lumiskin') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}">{{ __('app.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('product.index') }}">{{ __('app.products') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('skincareTest.index') }}">{{ __('app.skincare_test') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile.index') }}">{{ __('app.profile') }}</a></li>

                    @guest
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                    <a class="nav-link active" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                    @else
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        <a role="button" class="nav-link active" onclick="document.getElementById('logout').submit();">{{ __('auth.logout') }}</a>
                        @csrf
                    </form>
                    @endguest

                    <li class="nav-item">
                        <a class="nav-link cart-icon" href="#" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
                            {{ __('app.cart') }} <span class="cart-badge">{{ $cartQuantity }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Offcanvas Sidebar - Shopping Cart -->
    <div class="offcanvas offcanvas-end p-3 bg-light shadow-lg" tabindex="-1" id="cartSidebar">
        <div class="offcanvas-header">
            <h5 class="fw-bold text-primary">{{ __('app.shopping_cart') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            @if(count($cartItems) > 0)
            <ul class="list-group">
                @forelse ($cartItems as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm border-0 rounded">
                    <div>
                        <strong class="text-dark">{{ $item['name'] }}</strong><br>
                        <small class="text-muted">${{ $item['price'] }}</small>
                    </div>

                    <form method="POST" action="{{ route('cart.update', ['id' => $item['id']]) }}" class="cart-update-form">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                            class="form-control form-control-sm text-center w-50 update-quantity"
                            data-id="{{ $item['id'] }}">
                    </form>

                    <form method="POST" action="{{ route('cart.remove', ['id' => $item['id']]) }}" class="cart-form">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm ms-2">{{ __('app.remove') }}</button>
                    </form>
                </li>
                @empty
                <p class="text-center text-muted fs-5">{{ __('cart.empty') }}</p>
                @endforelse
            </ul>

            <!-- Total Amount -->
            <div class="mt-3 p-2 bg-white text-center shadow-sm rounded">
                <h5 class="fw-bold text-success">
                    {{ __('cart.total') }}: ${{ number_format($cartTotal, 0) }}
                </h5>
            </div>

            <!-- Clear Cart and Checkout Buttons -->
            <div class="mt-3 d-flex flex-column gap-2">
                @auth
                <form method="POST" action="{{ route('order.store') }}" class="cart-form">
                    @csrf
                    <label for="delivery_date" class="fw-bold mb-1">{{ __('cart.date') }}:</label>
                    <input type="date" name="delivery_date" id="delivery_date" class="form-control mb-2" required min="{{ now()->addDay()->toDateString() }}">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">{{ __('cart.order') }}</button>
                </form>
                @endauth

                @guest
                <a href="{{ route('login') }}" class="btn btn-warning w-100 fw-bold"
                    onclick="alert( __('cart.login_alert') )">{{ __('cart.login') }}</a>
                @endguest

                <form method="POST" action="{{ route('cart.clear') }}" class="cart-form">
                    @csrf
                    <button class="btn btn-danger w-100 fw-bold">{{ __('cart.clear') }}</button>
                </form>
            </div>
            @else
            <p class="text-center text-muted fs-5">{{ __('cart.empty') }}</p>
            @endif
        </div>
    </div>
    <!-- End of Offcanvas -->

    <div class="container my-5" style="padding-top: 80px;">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p>{{ __('app.copyright') }}</p>
            <a href="#">{{ __('app.terms') }}</a> | <a href="#">{{ __('app.privacy') }}</a>
            <div class="mt-2">
                <a href="#">{{ __('app.instagram') }}</a> | <a href="#">{{ __('app.facebook') }}</a> | <a href="#">{{ __('app.tiktok') }}</a>
            </div>
        </div>
    </footer>
    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>