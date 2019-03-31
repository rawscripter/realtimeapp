<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LikeController extends Controller {

    public function like(Reply $reply)
    {
        $reply->like()->create(
            ['user_id' => '1']
        );
        return response('liked', Response::HTTP_CREATED);
    }

    public function disLike(Reply $reply)
    {
        $reply->like()->where('user_id', '1')->first()->delete();
        return response('disliked', Response::HTTP_NO_CONTENT);
    }
}
