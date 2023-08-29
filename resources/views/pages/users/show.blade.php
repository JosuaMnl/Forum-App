@extends('layouts.app')

@section('body')
    <section class="bg-gray pt-4 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 mb-5 mb-lg-0">
                    <div class="d-flex mb-4">
                        <div class="avatar-wrapper rounded-circle overflow-hidden flex-shrink-0 me-4">
                            <img class="avatar" src="{{ $picture }}" alt="Avatar User">
                        </div>
                        <div>
                            <div class="mb-4">
                                <div class="fs-2 fw-bold mb-1 lh-1 text-break">
                                    {{ $user->username }}
                                </div>
                                <div class="color-gray">
                                    Member since {{ $user->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="text" id="current-url" class="d-none" value="{{ request()->url() }}">
                        <a id="share-profile" href="javascript:;" class="btn btn-primary me-4">Share</a>
                        @auth
                            @if ($user->id === auth()->id())
                                <a href="{{ route('users.edit', $user->username) }}">Edit Profile</a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="mb-5">
                        <h2 class="mb-3">My Discussions</h2>
                        <div>
                            @forelse ($discussions as $discussion)
                                <div class="card card-discussions">
                                    <div class="row">
                                        <div
                                            class="col-12 col-lg-2 mb-1 mb-lg-0 d-flex flex-row flex-lg-column align-items-end">
                                            <div class="text-nowrap me-2 me-lg-0">
                                                {{ $discussion->likeCount . ' ' . Str::plural('Like', $discussion->likeCount) }}
                                            </div>
                                            <div class="text-nowrap color-gray">
                                                {{ $discussion->answers->count() . ' ' . Str::plural('Answer', $discussion->answers->count()) }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-10">
                                            <a href="{{ route('discussions.show', $discussion->slug) }}">
                                                <h3>{{ $discussion->title }}</h3>
                                            </a>
                                            <p>{!! $discussion->content_preview !!}</p>
                                            <div class="row">
                                                <div class="col me-1 me-lg-2">
                                                    <a
                                                        href="{{ route('discussions.categories.show', $discussion->category->slug) }}">
                                                        <span
                                                            class="badge rounded-pill text-bg-light">{{ $discussion->category->name }}</span>
                                                    </a>
                                                </div>
                                                <div class="col-5 col-lg-4">
                                                    <div class="avatar-sm-wrapper d-inline-block">
                                                        <a class="me-1"
                                                            href="{{ route('users.show', $discussion->user->username) }}">
                                                            <img src="{{ filter_var($discussion->user->picture, FILTER_VALIDATE_URL) ? $discussion->user->picture : Storage::url($discussion->user->picture) }}"
                                                                alt="{{ $discussion->user->username }}"
                                                                class="avatar rounded-circle">
                                                        </a>
                                                    </div>
                                                    <span class="fs-12px">
                                                        <a class="me-1 fw-bold"
                                                            href="{{ route('users.show', $discussion->user->username) }}">{{ $discussion->user->username }}</a>
                                                        <span
                                                            class="color-gray">{{ $discussion->created_at->diffForHumans() }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="card card-discussions">
                                    Currently, there are no discussions.
                                </div>
                            @endforelse
                            {{-- Discussions Pagination --}}
                            {{ $discussions->appends(['answers' => $answers->currentPage()])->links() }}
                        </div>
                    </div>

                    <div>
                        <h2 class="mb-3">My Answers</h2>
                        @forelse ($answers as $answer)
                            <div class="card card-discussions">
                                <div class="row align-items-center">
                                    <div class="col-2 col-lg-1 text-center">
                                        {{ $answer->likeCount }}
                                    </div>
                                    <div class="col">
                                        <span>Replied to </span>
                                        <span class="fw-bold text-primary">
                                            <a
                                                href="{{ route('discussions.show', $answer->discussion->slug) }}">{{ $answer->discussion->title }}</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card card-discussions">
                                Currently, there are no answers.
                            </div>
                        @endforelse

                        {{-- Answers Pagination --}}
                        {{ $answers->appends(['discussions' => $discussions->currentPage()])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('after-script')
    <script>
        $(document).ready(function() {
            $('#share-profile').click(function() {
                var copyText = $('#current-url');
                copyText[0].select();
                copyText[0].setSelectionRange(0, 99999);
                navigator.clipboard.writeText(copyText.val());
                alert('Link to this profile copied successfully!', 'success')
            })
        })
    </script>
@endsection
