<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowReviewsRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use Nette\Schema\ValidationException;

class ReviewController extends Controller
{
    public function index(ShowReviewsRequest $request): View
    {
        $perPage = $request->input('per-page') ?? 10;
        $sort = $request->input('sort-input') ?? 'down';
        $search = $request->input('search') ?? null;

        $reviews = Review::with('user:id,name')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('text', 'like', "%{$search}%");
                });
            })
            ->when($sort, function ($query, $sort) {
                if ($sort === 'down') {
                    return $query->orderBy('created_at', 'desc');
                } else {
                    return $query->orderBy('created_at', 'asc');
                }
            })
            ->paginate($perPage);

        $reviews->appends(['per-page' => $perPage, 'sort-input' => $sort, 'search' => $search]);

        return view('reviews.comments', compact('perPage', 'reviews', 'sort', 'search'));

    }

    public function show($id): Response
    {
        $review = Review::with('user:id,name')->findOrFail($id);

        return response($review);
    }

    public function store(StoreReviewRequest $request): RedirectResponse
    {
        try {
            Review::create($request->validated());
        } catch (ValidationException $exception) {
            return back()->withErrors($exception);
        }

        return back();
    }
}
