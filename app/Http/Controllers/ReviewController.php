<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowReviewsRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Repositories\EloquentReviewRepository;
use App\Services\ReviewService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;

class ReviewController extends Controller
{
    public function index(ShowReviewsRequest $request, ReviewService $reviewService): View
    {
        $perPage = $request->input('per-page') ?? 10;
        $sort = $request->input('sort-input') ?? 'down';
        $search = $request->input('search') ?? null;

        try {
            $reviews = $reviewService->getReviews($perPage, $sort, $search);
        } catch (\RuntimeException $e) {
            abort(500, $e->getMessage());
        }

        return view('reviews.comments', compact('perPage', 'reviews', 'sort', 'search'));
    }

    public function show($id, EloquentReviewRepository $reviewRepository): Response
    {
        try {
            $review = $reviewRepository->getReview($id);
        } catch (ModelNotFoundException $e) {
            return response($e);
        }

        return response($review);
    }

    public function store(StoreReviewRequest $request, ReviewService $reviewService): RedirectResponse
    {
        try {
            $reviewService->storeReview($request);
        } catch (\RuntimeException $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        return back();
    }

    public function update(UpdateReviewRequest $request, ReviewService $reviewService): RedirectResponse
    {
        try {
            $reviewService->updateReview($request);
        } catch (\RuntimeException $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        return back();
    }
}
