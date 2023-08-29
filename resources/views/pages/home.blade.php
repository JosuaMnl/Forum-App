@extends('layouts.app')

@section('body')
    {{-- Hero Section --}}
    <section class="container hero">
        <div class="row align-items-center h-100">
            <div class="col-12 col-lg-6">
                <h1>The Laravel <br>Community Forum</h1>
                <p class="mb-4">Empowering the laravel community to connect, share and learn</p>
                @guest
                    <a href="{{ route('auth.sign-up.show') }}" class="btn btn-primary me-2 mb-2 mb-lg-0">Sign Up</a>
                    <a href="{{ route('discussions.index') }}" class="btn btn-secondary mb-2 mb-lg-0">Join Discussions</a>
                @endguest
            </div>
            <div class="col-12 col-lg-6 h-315px order-first order-lg-last mb-3 mb-lg-0">
                <img class="hero-image float-lg-end" src="{{ asset('assets/images/hero-image.png') }}" alt="Hero">
            </div>
        </div>
    </section>
    {{-- Hero End Section --}}

    {{-- Promotion Stats Section --}}
    <section class="container min-h-372px">
        <div class="row">
            <div class="col-12 col-lg-4 text-center">
                <img class="promote-icon mb-2" src="{{ asset('assets/images/discussions-icon.png') }}" alt="Discussions">
                <h2>{{ Str::plural('Discussion', $discussionCount) }}</h2>
                <p class="fs-3">{{ $discussionCount }}</p>
            </div>
            <div class="col-12 col-lg-4 text-center">
                <img class="promote-icon mb-2" src="{{ asset('assets/images/answers-icon.png') }}" alt="Answers">
                <h2>{{ Str::plural('Answer', $answerCount) }}</h2>
                <p class="fs-3">{{ $answerCount }}</p>
            </div>
            <div class="col-12 col-lg-4 text-center">
                <img class="promote-icon mb-2" src="{{ asset('assets/images/users-icon.png') }}" alt="Users">
                <h2>{{ Str::plural('User', $userCount) }}</h2>
                <p class="fs-3">{{ $userCount }}</p>
            </div>
        </div>
    </section>
    {{-- Promotion Stats End Section --}}

    {{-- Help Others Section --}}
    <section class="bg-gray">
        <div class="container py-80px">
            <h2 class="text-center mb-5">Help Others</h2>
            <div class="row">
                @forelse ($latestDiscussion as $itemLatestDiscussion)
                    <div class="col-12 col-lg-4 mb-3">
                        <div class="card">
                            <a href="{{ route('discussions.show', $itemLatestDiscussion->slug) }}">
                                <h3>{{ $itemLatestDiscussion->title }}</h3>
                            </a>
                            <div>
                                <p class="mb-5">
                                    {{ $itemLatestDiscussion->content_preview }}
                                </p>
                                <div class="row">
                                    <div class="col me-1 me-lg-2">
                                        <a
                                            href="{{ route('discussions.categories.show', $itemLatestDiscussion->category->slug) }}"><span
                                                class="badge rounded-pill text-bg-light">{{ $itemLatestDiscussion->category->name }}</span></a>
                                    </div>
                                    <div class="col-5 col-lg-7">
                                        <div class="avatar-sm-wrapper d-inline-block">
                                            <a href="{{ route('users.show', $itemLatestDiscussion->user->username) }}"
                                                class="me-1">
                                                <img src="{{ filter_var($itemLatestDiscussion->user->picture, FILTER_VALIDATE_URL) ? $itemLatestDiscussion->user->picture : Storage::url($itemLatestDiscussion->user->picture) }}"
                                                    alt="{{ $itemLatestDiscussion->user->username }}"
                                                    class="avatar rounded-circle">
                                            </a>
                                        </div>
                                        <span class="fs-12px">
                                            <a href="{{ route('users.show', $itemLatestDiscussion->user->username) }}"
                                                class="me-1 fw-bold">{{ Str::length($itemLatestDiscussion->user->username) > 7
                                                    ? Str::substr($itemLatestDiscussion->user->username, 0, 7) . '...'
                                                    : $itemLatestDiscussion->user->username }}</a>
                                            <span
                                                class="color-gray">{{ $itemLatestDiscussion->created_at->diffForHumans() }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    {{-- Help Others End Section --}}

    @guest
        {{-- CTA Section --}}
        <section class="container min-h-372px d-flex flex-column align-items-center justify-content-center">
            <h2>Ready to Contribue?</h2>
            <p class="mb-4"> Want to make a big impact?</p>
            <div class="text-center">
                <a href="{{ route('auth.sign-up.show') }}" class="btn btn-primary me-2 mb-2 mb-lg-0">Sign Up</a>
                <a href="{{ route('discussions.index') }}" class="btn btn-secondary mb-2 mb-lg-0">Join Discussions</a>
            </div>
        </section>
        {{-- CTA End Section --}}
    @endguest
@endsection
