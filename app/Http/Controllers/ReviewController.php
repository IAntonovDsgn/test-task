<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('reviews.comments');
    }

    public function create()
    {

    }

    public function store()
    {

    }

}
