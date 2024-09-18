<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function index(): JsonResponse
    {
        return response()
            ->json(
                Tag::all()
            );
    }
}
