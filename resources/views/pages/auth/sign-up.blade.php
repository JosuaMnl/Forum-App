@extends('layouts.auth')

@section('body')
    <section class="bg-gray vh-100">
        <div class="container">
            <div class="row pt-5 justify-content-center">
                <div class="col-12 col-lg-6 my-auto mb-5 mb-lg-auto me-0">
                    <div class="d-none d-lg-block">
                        <h2>Join the Laracuss Comunity</h2>
                        <p>
                        <ul>
                            <li>Stuck? Ask in the Discussions</li>
                            <li>Get answers from experienced developers from around the world</li>
                            <li>Contribute by answering questions</li>
                        </ul>
                        </p>
                    </div>
                    <div class="d-block d-lg-none fs-4 text-center">
                        Create your account in a minute. It's free and easy to get started.
                    </div>
                </div>
                <div class="col-12 col-lg-4 h-100">
                    <a href="" class="nav-link mb-5 text-center">
                        <img src="{{ asset('assets/images/footer-logo.png') }}" alt="Logo" class="h-32px">
                    </a>
                    <div class="card mb-5">
                        <form action="{{ route('auth.sign-up.sign-up') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username') }}" placeholder="name123"
                                    autocomplete="off" autofocus>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="****************">
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-primary rounded-2">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center">
                        Already have an account? <a href="{{ route('auth.login.show') }}"><u>Log in</u></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
