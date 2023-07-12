<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
        <div class="container flex justify-content-between">
            <a class="navbar-link" href="{{ route('home') }}">
                <img class="h-32px" src="{{ asset('assets/images/navbar-logo.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-0 mx-lg-3">
                    <li class="nav-item d-block d-lg-none d-xl-block">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Discussions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" aria-current="page" href="#">About Us</a>
                    </li>

                </ul>
                <form class="d-flex w-100 me-4 my-2 my-lg-0" role="search" action="" method="GET">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <img src="{{ asset('assets/images/icon-search.png') }}" alt="Search">
                        </span>
                        <input class="form-control border-start-0 ps-0" type="search" placeholder="Search"
                            aria-label="Search" name="" value="">
                    </div>
                </form>
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item my-auto">
                        <a class="nav-link text-nowrap" aria-current="page" href="#">Log In</a>
                    </li>
                    <li class="nav-item ps-1 pe-0">
                        <a class="btn btn-primary-white" aria-current="page" href="#">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="container hero">
        <div class="row align-items-center h-100">
            <div class="col-12 col-lg-6">
                <h1>The Laravel <br>Community Forum</h1>
                <p class="mb-4">Empowering the laravel community to connect, share and learn</p>
                <a href="" class="btn btn-primary me-2 mb-2 mb-lg-0">Sign Up</a>
                <a href="" class="btn btn-secondary mb-2 mb-lg-0">Join Discussions</a>
            </div>
            <div class="col-12 col-lg-6 h-315px order-first order-lg-last mb-3 mb-lg-0">
                <img class="hero-image float-lg-end" src="{{ asset('assets/images/hero-image.png') }}" alt="Hero">
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</body>

</html>
