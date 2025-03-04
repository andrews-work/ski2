<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostCommentController extends Controller
{
    public function list()
    {
        Log::info('PostComment - List');
    }

    public function create()
    {
        Log::info('PostComment - Create');
    }

    public function update()
    {
        Log::info('PostComment - Update');
    }

    public function delete()
    {
        Log::info('PostComment - Delete');
    }
}
