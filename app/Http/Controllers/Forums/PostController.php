<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function list()
    {
        Log::info('PostController - List');
    }

    public function create()
    {
        Log::info('PostController - Create');
    }

    public function update()
    {
        Log::info('PostController - Update');
    }

    public function delete()
    {
        Log::info('PostController - Delete');
    }
}
