<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\helpers\ApiResponse;
use App\Services\PostService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Auth\Access\AuthorizationException;

class PostController extends Controller
{
    public function __construct(protected PostService $postService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->get([], ['user'], ['created_at' => 'desc']);

        return ApiResponse::success(
            PostResource::collection($posts),
            'Posts retrieved successfully.',
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function indexWithPaginate()
    {
        $perPage = request()->get('per_page', 10);
        $perPage == null ? $perPage = 10 : $perPage;
        $posts = $this->postService->pagination($perPage, [], ['user'], ['created_at' => 'desc']);

        return ApiResponse::success(
            [
                'pagination' => $this->formatPagination($posts),
                'data' => PostResource::collection($posts),
            ],
            'Posts retrieved successfully.',
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $this->postService->store($data);

        return ApiResponse::success(
            null,
            'Post created successfully.',
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return ApiResponse::success(
            new PostResource($post->load('user')),
            'Post retrieved successfully.',
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);

        $this->postService->update($post, $request->validated());

        return ApiResponse::success(
            new PostResource($post->load('user')),
            'Post updated successfully.',
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        
        $this->postService->delete($post);

        return ApiResponse::success(
            null,
            'Post deleted successfully.',
        );
    }

    private function formatPagination($paginator): array
    {
        return [
            'total' => $paginator->total(),
            'count' => $paginator->count(),
            'per_page' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
        ];
    }
}
