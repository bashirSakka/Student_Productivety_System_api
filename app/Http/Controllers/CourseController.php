<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::where("user_id", request()->user()->id)->get();
        return response()->json($course);
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([

            'name' => ['required', 'string'],
            'code' => ['nullable', 'string'],
            'instructor' => ['nullable', 'string'],
            'credits' => ['required', 'numeric'],
            'color' => ['required', 'string'],
            'semester' => ['required', 'string'],
            'status' => ['required', 'in:active,completed'],
            'grade' => ['nullable', 'string'],
        ]);

        $course = Course::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);
        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return Course::find($course->user->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $validated = request()->validate([

            'name' => ['required', 'string'],
            'code' => ['nullable', 'string'],
            'instructor' => ['nullable', 'string'],
            'credits' => ['required', 'numeric'],
            'color' => ['required', 'string'],
            'semester' => ['required', 'string'],
            'status' => ['required', 'in:active,completed'],
            'grade' => ['nullable', 'string'],
        ]);

        $course = Course::update([
            ...$validated,
            'user_id' => request()->user()->id,
        ]);
        return response()->json($course, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {


        $course->delete();

        return response()->json([
            'message' => 'Course deleted'
        ]);
    }
}