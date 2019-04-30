<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'name' => ucfirst($this->user->name),
            'user_id' => $this->user->id,
            'question_slug' => $this->question->slug,
            'like_count' => $this->like->count(),
            'isLiked' => auth()->user() ? !!$this->like->where('user_id', auth()->user()->id)->count() : false,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
