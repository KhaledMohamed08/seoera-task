<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [];
        $data['postsCount'] = app(PostService::class)->count();
        $data['usersCount'] = app(UserService::class)->count();
        return view('admin.index', compact('data'));
    }
}
