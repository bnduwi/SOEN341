<?php

    namespace App\Http\Controllers;

    use App\Comment;
    use App\Http\Resources\Comment as CommentResource;
    use Illuminate\Support\Facades\Auth;

    class CommentsController extends Controller {
        public function __construct() {
            $this->middleware('auth:api')->except(['show','index']);
        }

        public function store($model, $id) {
            $this->validate(request(), [
                'body'        => 'required',
            ]);

            $model = $this->determineModel($model, $id);

            $model->addComment(request('body'),Auth::guard('api')->id());

            return CommentResource::collection($model->comments);
        }

        public function index($model, $id) {
            $model = $this->determineModel($model, $id);

            if ($model) {
                return CommentResource::collection($model->comments);
            }
            return null; //TODO: write failure json
        }

        public function show($id) {
            $comment = Comment::whereId($id)->first();
            if ($comment) {
                return new CommentResource($comment);
            }
            return null; //TODO: write failure json
        }
    }
