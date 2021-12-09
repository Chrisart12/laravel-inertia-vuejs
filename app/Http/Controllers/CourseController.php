<?php

namespace App\Http\Controllers;

use DB;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('user')
        ->select('courses.*', DB::raw(
            '(SELECT COUNT(DISTINCT(user_id))
            FROM completions
            INNER JOIN episodes ON completions.episode_id = episodes.id
            WHERE episodes.course_id = courses.id
            ) AS participants'
        ))
        ->withCount('episodes')->latest()->get();
        
        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

    public function show(int $id)
    {
       
        $course = Course::where('id', $id)->with('episodes')->first();
        
        $watched = auth()->user()->episodes;
        // dd($watched);
        // Nombre total d'épisode
        // $totalEpisodes = count(Course::findOrFail($id)->episodes);

        // $totalWatcheds = count($watched);
        
        return Inertia::render('Courses/Show', [
            'course' => $course,
            'watched' => $watched,
            // 'totalEpisodes' => $totalEpisodes,
            // 'totalWatcheds' => $totalWatcheds
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:50'],
            'description' => ['required', 'min:20'],
            'episodes' => ['required', 'array'],
            'episodes.*.title' => ['required', 'min:5', 'max:50'],
            'episodes.*.description' => ['required', 'min:5', 'max:50'],
            'episodes.*.video_url' => ['required', 'min:5', 'max:50'],

        ]);


        $course = Course::create(
            $request->all()
        );

        foreach ($request->input('episodes') as $episode) {
            $episode['course_id'] = $course->id;
            Episode::create($episode);
        }

        return Redirect::route('course')->with('success', 'Félicitation, la formation a bien été mise en ligne.');
    }

    public function toggleProgress(Request $request)
    {
        $id = $request->input('episodeId');
        $user = auth()->user();

        $user->episodes()->toggle($id);

        return $user->episodes;
    }

    public function edit(int $id)
    {
        $course = Course::where('id', $id)->with('episodes')->first();

        $this->authorize('update', $course);

        return Inertia::render('Courses/Edit', [
            'course' => $course,
            // 'watched' => $watched,
            
        ]);
        
    }

    public function update(Request $request)
    {
        
        $course = Course::where('id', $request->id)->with('episodes')->first();
    
        $this->authorize('update', $course);

        $course->update($request->all());
        $course->episodes()->delete();

        foreach ($request->input('episodes') as $episode) {
            $episode['course_id'] = $course->id;
            Episode::create($episode);
        }

        return Redirect::route('course')->with('success', 'Félicitation, la formation a bien été mise à jour.');

        
    }
}
