@extends('layouts.app')

@section('body')
    <section class="bg-gray pt-4 pb-5">
        <div class="container">
            <div class="mb-5">
                <div class="d-flex align-items-center">
                    <div class="d-flex">
                        <div class="fs-2 fw-bold color-gray me-2 mb-0">Discussions</div>
                        <div class="fs-2 fw-bold color-gray me-2 mb-0">></div>
                    </div>
                    <h2 class="mb-0">{{ $discussion->title }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 mb-5 mb-lg-0">
                    <div class="card card-discussions mb-5">
                        <div class="row">
                            <div class="col-1 d-flex flex-column justify-content-start align-items-center">
                                <a id="discussion-like" href="javascript:;" data-liked="{{ $discussion->liked() }}">
                                    <img id="discussion-like-icon" class="like-icon mb-1"
                                        src="{{ $discussion->liked() ? $likedIcon : $notLikedIcon }}" alt="Like">
                                </a>
                                <span id="discussion-like-count"
                                    class="fs-4 color-gray mb-1">{{ $discussion->likeCount }}</span>
                            </div>

                            <div class="col-11">
                                <p>
                                    {!! $discussion->content !!}
                                </p>
                                <div class="mb-3">
                                    <a href="{{ route('discussions.categories.show', $discussion->category->slug) }}"><span
                                            class="badge rounded-pill text-bg-light">{{ $discussion->category->name }}</span></a>
                                </div>
                                <div class="row align-items-start justify-content-between">
                                    <div class="col">
                                        <span class="color-gray me-2">
                                            <a href="javascript:;" id="share-discussion"><small>Share</small></a>
                                            <input type="text" value="{{ request()->url() }}" id="current-url"
                                                class="d-none">
                                        </span>

                                        @if ($discussion->user_id === auth()->id())
                                            <span class="color-gray me-2">
                                                <a href="{{ route('discussions.edit', $discussion->slug) }}">
                                                    <small>Edit</small>
                                                </a>
                                            </span>
                                            <form action="{{ route('discussions.destroy', $discussion->slug) }}"
                                                class="d-inline-block lh-1" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn color-gray p-0 lh-1" type="submit"
                                                    id="delete-discussion">
                                                    <small class="card-discussion-btn-delete">Delete</small>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="col-5 col-lg-3 d-flex">
                                        <a class="card-discussions-show-avatar-wrapper flex-shrink-0 rounded-circle overflow-hidden me-1"
                                            href="{{ route('users.show') }}">
                                            <img src="{{ filter_var($discussion->user->picture, FILTER_VALIDATE_URL) ? $discussion->user->picture : Storage::url($discussion->user->picture) }}"
                                                alt="{{ $discussion->user->username }}" class="avatar">
                                        </a>
                                        <div class="fs-12px lh-1">
                                            <span class="text-primary">
                                                <a class="fw-bold d-flex align-items-start text-break mb-1"
                                                    href="{{ route('users.show') }}">
                                                    {{ $discussion->user->username }}
                                                </a>
                                            </span>
                                            <span class="color-gray">{{ $discussion->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="mb-5">
                        {{ $discussion->answers->count() . ' ' . Str::plural('Answer', $discussion->answers->count()) }}
                    </h3>

                    <div class="mb-5">
                        @forelse ($answers as $answer)
                            <div class="card card-discussions">
                                <div class="row">
                                    <div class="col-1 d-flex flex-column justify-content-start align-items-center">
                                        <a href="">
                                            <img src="{{ asset('assets/images/icon-like.png') }}" alt="Like"
                                                class="like-icon mb-1">
                                        </a>
                                        <span class="fs-4 color-gray mb-1">12</span>
                                    </div>
                                    <div class="col-11">
                                        <p>
                                            {!! $answer->answer !!}
                                        </p>
                                        <div class="row align-items-end justify-content-end">
                                            <div class="col-5 col-lg-3 d-flex">
                                                <a class="card-discussions-show-avatar-wrapper flex-shrink-0 rounded-circle overflow-hidden me-1"
                                                    href="">
                                                    <img src="{{ filter_var($answer->user->picture, FILTER_VALIDATE_URL) ? $answer->user->picture : Storage::url($answer->user->picture) }}"
                                                        alt="{{ $answer->user->username }}" class="avatar">
                                                </a>
                                                <div class="fs-12px lh-1">
                                                    <span
                                                        class="{{ $answer->user->username === $discussion->user->username ? 'text-primary' : '' }}">
                                                        <a class="fw-bold d-flex align-items-start text-break mb-1"
                                                            href="{{ route('users.show', $answer->user->username) }}">
                                                            {{ $answer->user->username }}
                                                        </a>
                                                    </span>
                                                    <span
                                                        class="color-gray">{{ $answer->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card card-dicussions">
                                Currently no answer yet.
                            </div>
                        @endforelse

                        {{-- Pagination Answers --}}
                        {{ $answers->links() }}
                    </div>

                    @auth
                        <h3 class="mb-5">Your Answer</h3>
                        <div class="card card-discussions">
                            <form action="{{ route('discussions.answer.store', $discussion->slug) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="answer" id="answer">{{ old('answer') }}</textarea>
                                </div>
                                <div>
                                    <button class="btn btn-primary me-4">Submit</button>
                                </div>
                            </form>
                        </div>
                    @endauth

                    @guest
                        <div class="fw-bold text-center">
                            Please <a class="text-primary" href="{{ route('auth.login.show') }}">sign in</a> or <a
                                class="text-primary" href="{{ route('auth.sign-up.show') }}">create an account</a> to
                            participate in this discussion.
                        </div>
                    @endguest
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card">
                        <h3>All categories</h3>
                        <div>
                            @foreach ($categories as $category)
                                <a href="{{ route('discussions.categories.show', $category->slug) }}">
                                    <span class="badge rounded-pill text-bg-light">{{ $category->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('after-script')
    <script>
        $(document).ready(function() {
            $('#share-discussion').click(function() {
                var copyText = $('#current-url');
                copyText[0].select();
                copyText[0].setSelectionRange(0, 99999);
                navigator.clipboard.writeText(copyText.val());
                alert('Link to this discussion copied successfully!', 'success')
            })

            $('#answer').summernote({
                placeholder: 'Write your solution here...',
                tabSize: 2,
                height: 320,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('span.note-icon-caret').remove();

            $('#discussion-like').click(function() {
                var isLiked = $(this).data('liked');
                var likeRoute = isLiked ? "{{ route('discussions.like.unlike', $discussion->slug) }}" :
                    "{{ route('discussions.like.like', $discussion->slug) }}";

                $.ajax({
                        method: 'POST',
                        url: likeRoute,
                        data: {
                            '_token': '{{ csrf_token() }}'
                        }
                    })
                    .done(function(res) {
                        if (res.status === 'success') {
                            $('#discussion-like-count').text(res.data.likeCount);

                            if (isLiked) {
                                $('#discussion-like-icon').attr('src', '{{ $notLikedIcon }}');
                            } else {
                                $('#discussion-like-icon').attr('src', '{{ $likedIcon }}');
                            }

                            $('#discussion-like').data('liked', !isLiked);
                        }
                    });
            });

            $('#delete-discussion').click(function(event) {
                if (!confirm('Delete this discussion?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
