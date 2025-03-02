<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Carbon;

class StoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('stories', 'public');

        Story::create([
            'user_id' => Auth::id(),
            'image' => $path,
        ]);

        return redirect()->back()->with('success', 'Story berhasil diunggah.');
    }

    public function index()
    {
        $stories = Story::where('deleted_at', null)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->latest()
            ->get();

        return Inertia::render('Home', [
            'stories' => $stories
        ]);
    }
}
