@extends('layouts.app')

@section('body')
    <section class="bg-gray pt-4 pb-5">
        <div class="container">
            <div class="mb-4">
                <div class="mb-3 d-flex align-items-center justify-content-between">
                    <h2 class="me-4 mb-0">
                        All Discussions
                    </h2>
                    <div>
                        51,875 discussions
                    </div>
                </div>
                <a class="btn btn-primary" href="">Create discussions</a>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 mb-5 mb-lg-0">
                    <div class="card card-discussions">
                        <div class="row">
                            <div class="col-12 col-lg-2 mb-1 mb-lg-0 d-flex flex-row flex-lg-column align-items-end">
                                <div class="text-nowrap me-2 me-lg-0">
                                    3 likes
                                </div>
                                <div class="text-nowrap color-gray">
                                    9 answers
                                </div>
                            </div>
                            <div class="col-12 col-lg-10">
                                <a href="{{ route('discussions.show') }}">
                                    <h3>How to add a custom validation in laravel?</h3>
                                </a>
                                <p>I am working on a blogging application in Laravel 8. There are 4 user roles, among which,
                                    the "...</p>
                                <div class="row">
                                    <div class="col me-1 me-lg-2">
                                        <a href="">
                                            <span class="badge rounded-pill text-bg-light">Eloquent</span>
                                        </a>
                                    </div>
                                    <div class="col-5 col-lg-4">
                                        <div class="avatar-sm-wrapper d-inline-block">
                                            <a class="me-1" href="">
                                                <img src="{{ asset('assets/images/avatar.png') }}" alt="Username"
                                                    class="avatar rounded-circle">
                                            </a>
                                        </div>
                                        <span class="fs-12px">
                                            <a class="me-1 fw-bold" href="">Username</a>
                                            <span class="color-gray">7 hours ago</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-discussions">
                        <div class="row">
                            <div class="col-12 col-lg-2 mb-1 mb-lg-0 d-flex flex-row flex-lg-column align-items-end">
                                <div class="text-nowrap me-2 me-lg-0">
                                    3 likes
                                </div>
                                <div class="text-nowrap color-gray">
                                    9 answers
                                </div>
                            </div>
                            <div class="col-12 col-lg-10">
                                <a href="">
                                    <h3>How to add a custom validation in laravel?</h3>
                                </a>
                                <p>I am working on a blogging application in Laravel 8. There are 4 user roles, among which,
                                    the "...</p>
                                <div class="row">
                                    <div class="col me-1 me-lg-2">
                                        <a href="">
                                            <span class="badge rounded-pill text-bg-light">Eloquent</span>
                                        </a>
                                    </div>
                                    <div class="col-5 col-lg-4">
                                        <div class="avatar-sm-wrapper d-inline-block">
                                            <a class="me-1" href="">
                                                <img src="{{ asset('assets/images/avatar.png') }}" alt="Username"
                                                    class="avatar rounded-circle">
                                            </a>
                                        </div>
                                        <span class="fs-12px">
                                            <a class="me-1 fw-bold" href="">Username</a>
                                            <span class="color-gray">7 hours ago</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-discussions">
                        <div class="row">
                            <div class="col-12 col-lg-2 mb-1 mb-lg-0 d-flex flex-row flex-lg-column align-items-end">
                                <div class="text-nowrap me-2 me-lg-0">
                                    3 likes
                                </div>
                                <div class="text-nowrap color-gray">
                                    9 answers
                                </div>
                            </div>
                            <div class="col-12 col-lg-10">
                                <a href="">
                                    <h3>How to add a custom validation in laravel?</h3>
                                </a>
                                <p>I am working on a blogging application in Laravel 8. There are 4 user roles, among which,
                                    the "...</p>
                                <div class="row">
                                    <div class="col me-1 me-lg-2">
                                        <a href="">
                                            <span class="badge rounded-pill text-bg-light">Eloquent</span>
                                        </a>
                                    </div>
                                    <div class="col-5 col-lg-4">
                                        <div class="avatar-sm-wrapper d-inline-block">
                                            <a class="me-1" href="">
                                                <img src="{{ asset('assets/images/avatar.png') }}" alt="Username"
                                                    class="avatar rounded-circle">
                                            </a>
                                        </div>
                                        <span class="fs-12px">
                                            <a class="me-1 fw-bold" href="">Username</a>
                                            <span class="color-gray">7 hours ago</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <h3>All categories</h3>
                        <div>
                            <a href="">
                                <span class="badge rounded-pill text-bg-light">Eloquent</span>
                                <span class="badge rounded-pill text-bg-light">Facade</span>
                                <span class="badge rounded-pill text-bg-light">Helper</span>
                                <span class="badge rounded-pill text-bg-light">Models</span>
                                <span class="badge rounded-pill text-bg-light">Controller</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
