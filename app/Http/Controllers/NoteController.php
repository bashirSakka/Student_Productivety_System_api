<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::where("user_id", request()->user()->id)->paginate(5);
        return response()->json($notes);
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'course_id' => ['nullable', 'exists:courses,id'],
            'pinned' => ['boolean'],
        ]);

        $note = Note::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($note, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title'      => ['sometimes', 'string'],
            'content'    => ['nullable', 'string'],
            'course_tag' => ['nullable', 'string'],
            'pinned'     => ['nullable', 'boolean'],
        ]);

        $note->update($validated);

        return response()->json($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}