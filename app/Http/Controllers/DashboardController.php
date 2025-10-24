<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Load user statistics
        $user->loadCount(['posts', 'comments']);
        
        // Get recent posts
        $recentPosts = $user->posts()
            ->latest()
            ->take(5)
            ->get();
        
        // Get recent comments
        $recentComments = $user->comments()
            ->with('post')
            ->latest()
            ->take(5)
            ->get();
        
        return view('dashboard', compact('user', 'recentPosts', 'recentComments'));
    }
}
