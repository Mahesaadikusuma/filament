<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // atest('published_at')->take(3)->get()
        $featuredPost = Post::published()->featured()->latest('published_at')->take(3)->get();
        $latestPost = Post::published()->latest('published_at')->take(9)->get();

        // $excludedIds = $featuredPost->pluck('id')->toArray();

        // $latestPost = Post::published()
        //     ->whereNotIn('id', $excludedIds)
        //     ->latest('published_at')
        //     ->get();
        return view('home', [
            'featuredPost' => $featuredPost,
            // Default
            // 'latestPost' => Post::published()->featured()->latest('published_at')->get(),

            'latestPost' => $latestPost,
        ]);
    }
}
