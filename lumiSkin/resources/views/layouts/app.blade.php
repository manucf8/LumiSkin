<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>@yield('title', 'LumiSkin')</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">LumiSkin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('product.index') }}">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Skincare test</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Account</a></li>
                    <li class="nav-item">
                        <a class="nav-link cart-icon" href="#" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
                            🛒 <span class="cart-badge">{{ session('cart') ? count(session('cart')) : 0 }}</span>
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
            <h5 class="fw-bold text-primary">🛍️ Shopping Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            @if(session('cart') && count(session('cart')) > 0)
            <ul class="list-group">
                @foreach(session('cart') as $id => $item)
                <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm border-0 rounded">
                    <div>
                        <strong class="text-dark">{{ $item['name'] }}</strong><br>
                        <small class="text-muted">${{ $item['price'] }}</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- Decrease Button -->
                        <form method="POST" action="{{ route('cart.decrease') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button class="btn btn-outline-secondary btn-sm px-2">-</button>
                        </form>

                        <span class="mx-2">{{ $item['quantity'] }}</span>

                        <!-- Increase Button -->
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button class="btn btn-outline-secondary btn-sm px-2">+</button>
                        </form>

                        <!-- Remove Button -->
                        <form method="POST" action="{{ route('cart.remove', ['id' => $id]) }}">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm ms-2">X</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>

            <!-- Total Amount -->
            <div class="mt-3 p-2 bg-white text-center shadow-sm rounded">
                <h5 class="fw-bold text-success">Total: ${{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart'))) }}</h5>
            </div>

            <!-- Clear Cart Button -->
            <div class="mt-3">
                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf
                    <button class="btn btn-danger w-100 fw-bold">🗑️ Clear Cart</button>
                </form>
            </div>
            @else
            <p class="text-center text-muted fs-5">Your cart is empty.</p>
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
            <p>© 2025 LumiSkin - All rights reserved.</p>
            <a href="#">Terms and Conditions</a> | <a href="#">Privacy Policy</a>
            <div class="mt-2">
                <a href="#">Instagram</a> | <a href="#">Facebook</a> | <a href="#">TikTok</a>
            </div>
        </div>
    </footer>
    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>