<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LikeController extends Controller {

    public function __construct()
    {
        $this->middleware('jwt');
    }


    public function like(Reply $reply)
    {
        $isLiked = !!$reply->like()->where('user_id', auth()->user()->id)->first();

        $reply->like()->create(
            ['user_id' => auth()->user()->id]
        );
        broadcast(new LikeEvent($reply->id, 1))->toOthers();
//        return response('liked', Response::HTTP_CREATED);
    }

    public function disLike(Reply $reply)
    {
        $reply->like()->where('user_id', auth()->user()->id)->first()->delete();
        broadcast(new LikeEvent($reply->id, 0))->toOthers();
//        return response('disliked', Response::HTTP_NO_CONTENT);
    }
}
