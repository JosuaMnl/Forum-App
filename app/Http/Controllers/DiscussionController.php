<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discussion\StoreRequest;
use App\Http\Requests\Discussion\UpdateRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $discussions = Discussion::with('user', 'category');

        if ($request->search) {
            $discussions->where('title', 'like', "%$request->search%")
                ->orWhere('content', 'like', "%$request->search%");
        }

        return response()->view('pages.discussions.index', [
            'discussions' => $discussions->orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
            'categories' => Category::all(),
            'search' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('pages.discussions.form', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $categoryId = Category::where('slug', $validated['category_slug'])->first()->id;

        $validated['category_id'] = $categoryId;
        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        $stripContent = strip_tags($validated['content']);
        $isContentLong = strlen($stripContent) > 120;
        $validated['content_preview'] = $isContentLong
            ? substr($stripContent, 0, 120) . '...'
            : $stripContent;

        $createDiscussion = Discussion::create($validated);

        if ($createDiscussion) {
            session()->flash('notif.success', 'Discussion created successfully!');
            return redirect()->route('discussions.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $discussion = Discussion::with(['user', 'category'])->where('slug', $slug)->first();

        if (!$discussion) {
            return abort(404);
        }

        $discussionAnswers = Answer::where('discussion_id', $discussion->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $notLikedIcon = asset('assets/images/icon-like.png');
        $likedIcon = asset('assets/images/icon-liked.png');

        return response()->view('pages.discussions.show', [
            'discussion' => $discussion,
            'categories' => Category::all(),
            'likedIcon' => $likedIcon,
            'notLikedIcon' => $notLikedIcon,
            'answers' => $discussionAnswers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        //
        $discussion = Discussion::with('category')->where('slug', $slug)->first();

        if (!$discussion) {
            return abort(404);
        }

        $isOwnedByUser = $discussion->user_id === auth()->id();

        if (!$isOwnedByUser) {
            return abort(404);
        }

        return response()->view('pages.discussions.form', [
            'discussion' => $discussion,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $slug)
    {
        $discussion = Discussion::with('category')->where('slug', $slug)->first();

        if (!$discussion) {
            return abort(404);
        }

        $isOwnedByUser = $discussion->user_id === auth()->id();

        if (!$isOwnedByUser) {
            return abort(404);
        }

        $validated = $request->validated();
        $categoryId = Category::where('slug', $validated['category_slug'])->first()->id;

        $validated['category_id'] = $categoryId;
        $validated['user_id'] = auth()->id();

        $stripContent = strip_tags($validated['content']);
        $isContentLong = strlen($stripContent) > 120;
        $validated['content_preview'] = $isContentLong
            ? substr($stripContent, 0, 120) . '...'
            : $stripContent;

        $updateDiscussion = $discussion->update($validated);

        if ($updateDiscussion) {
            session()->flash('notif.success', 'Discussion updated successfully!');
            return redirect()->route('discussions.show', $slug);
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $discussion = Discussion::with('category')->where('slug', $slug)->first();
        if (!$discussion) {
            return abort(404);
        }

        $isOwnedByUser = $discussion->user_id === auth()->id();
        if (!$isOwnedByUser) {
            return abort(404);
        }

        $deleteDiscussion = $discussion->delete();
        if($deleteDiscussion) {
            session()->flash('notif.success', 'Discussion deleted successfully!');
            return redirect()->route('discussions.index');
        }

        return abort(500);
    }
}
