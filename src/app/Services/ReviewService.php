<?php

namespace App\Services;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Repositories\EloquentReviewRepository;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function __construct(
        private readonly EloquentReviewRepository $reviewRepository
    )
    {
    }

    public function getReviews(int $perPage, string $sort, string|null $search): LengthAwarePaginator
    {
        try {
            $reviews = $this->reviewRepository->getReviewsWithPaginate($perPage, $sort, $search);
            $reviews->appends(['per-page' => $perPage, 'sort-input' => $sort, 'search' => $search]);
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }
        return $reviews;
    }

    public function storeReview(StoreReviewRequest $request): void
    {
        $data = $request->all();
        $data['is_recommended'] = $request->has('recommend') ? $request->boolean('recommend') : NULL;
        try {
            $this->reviewRepository->storeReview($data);
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }
    }

    public function updateReview(UpdateReviewRequest $request): void
    {
        try {
            $review = $this->reviewRepository->getReview($request->input('id-update'));

            if (Auth::user()->id === $review->user_id) {
                $review->title = $request->input('title-update');
                $review->text = $request->input('text-update');
                $review->is_recommended = $request->has('recommend-update') ? $request->boolean('recommend-update') : NULL;
                $review->save();
            }
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }
    }

    public function getUsersReview(int $userId): Collection
    {
        try {
            $reviews = $this->reviewRepository->getUsersReviews($userId);
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }

        return $reviews;
    }
}
