<?php
/**
 * Class        PostController
 * @package     App\Http\Controllers
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
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
