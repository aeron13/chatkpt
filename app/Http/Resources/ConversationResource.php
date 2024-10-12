<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class ConversationResource extends JsonResource
{
    private function getCategoryData() {
        if ( empty($this->categories) ) {
            return null;
        }

        return Category::whereIn('id', $this->categories)->get();
    }

    private function formatDate($date) {
        
        $timestamp = strtotime($date);
        return date('d M Y', $timestamp);
    }
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => route('conversation', $this->id),
            'current_node' => $this->current_node,
            'create_time' => $this->formatDate($this->create_time),
            'author' => Auth::user()->name,
            'messages' => Message::where([['conversation_id', $this->id], ['author','!=', 'system']])->get(),
            'categories' => $this->getCategoryData()
        ];
    }
}
