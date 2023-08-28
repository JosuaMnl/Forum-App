<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\StoreRequest;
use App\Models\Answer;
use App\Models\Discussion;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, string $slug)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();
        $validated['discussion_id'] = Discussion::where('slug', $slug)->first()->id;

        $createAnswer = Answer::create($validated);

        if ($createAnswer) {
            session()->flash('notif.success', 'Your answer created successfully!');
            return redirect()->route('discussions.show', $slug);
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
