<?php

namespace App\Repositories;

use App\Models\Review;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Eloquent\Model;

class EloquentReviewRepository
{
    public function getReview($id): Model
    {
        return Review::with('user:id,name')->findOrFail($id);
    }

    public function getReviewsWithPaginate(int $perPage, string $sort, string|null $search): LengthAwarePaginator
    {
        return Review::with('user:id,name')
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
    }

    public function getUsersReviews(int $userId): Collection
    {
        return Review::with('user:id,name')->where('user_id','=', $userId)->orderBy('created_at', 'desc')->get();
    }

    public function storeReview(array $data): void
    {
        Review::create($data);
    }
}
