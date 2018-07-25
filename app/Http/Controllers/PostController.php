<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class PostController
 * @package App\Http\Controllers
 * @uses CommentRequest for validation
 */
class PostController extends Controller
{
    /**
     * Show the form to create a new blog post.
     *
     * @return Response
     */
    public function create(CommentRequest $request)
    {
        $validated = $request->rules();
        return view('admin.create');
        
    }
}
