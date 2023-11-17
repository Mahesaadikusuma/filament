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
        return view('home', [
            'featuredPost' => Post::published()->featured()->latest('published_at')->take(3)->get(),
            'latestPost' => Post::published()->featured()->latest('published_at')->get(),
        ]);
    }
}
