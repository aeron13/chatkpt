<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConversationUpdateRequest;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\ConversationCollection;
use Illuminate\Http\Request;
use App\Http\Requests\ConversationStoreRequest;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class ConversationController extends Controller
{
    /**
     * Get the conversations from the db
     */
    public function index() 
    {
        return new ConversationCollection(Conversation::where('author_id', Auth::id())->orderBy('create_time', 'desc')->get());
    }
    
    /**
     * Store the conversations in the db
     */
    public function store(ConversationStoreRequest $request)
    {

        $conversationsData = json_decode($request->input('conversations'));

        foreach ($conversationsData as $conversationData) {

            // check if the conversation is already in the db
            $conversation = Conversation::where([['author_id', Auth::id()], ['current_node', $conversationData->current_node]])->first();

            if( empty($conversation) ) {

                // if not create a new record
                $conversation = new Conversation();
                $conversation->create_time = date('Y-m-d H:i:s', $conversationData->create_time);
                $conversation->update_time = date('Y-m-d H:i:s', $conversationData->update_time);
                $conversation->title = $conversationData->title;
                $conversation->current_node = $conversationData->current_node;
                $conversation->author_id = Auth::id();
                $conversation->save();
            }

            $messagesData = $conversationData->mapping;

            foreach($messagesData as $messageData) {

                if ($messageData->message) {

                    // check if the message is already in the db
                    $create_time = date('Y-m-d H:i:s', $messageData->message->create_time);
                    $message = Message::where([['conversation_id', $conversation->id],['create_time', $create_time]])->first();

                    if (empty($message)) {
                        
                        $message = new Message();
                        $message->author = $messageData->message->author->role;
                        $message->create_time = $create_time;
                        $message->update_time = date('Y-m-d H:i:s', $messageData->message->update_time);
                        $message->content = $messageData->message->content;
                        $message->metadata = $messageData->message->metadata;
                        $message->status = $messageData->message->status;
                        $message->end_turn = $messageData->message->end_turn;
                        $message->conversation_id = $conversation->id;
                        $message->save();

                    }
                }
            }
        }

        session(['conversations' => '1']);
        return response()->json(['message' => 'Json saved']);
    }

    /**
     * Get a single conversation from the db
     */
    public function show(Request $request) 
    {
        $id = request('id');

        return new ConversationResource(Conversation::where([['author_id', Auth::id()],['id', $id]])->first());
    }

    /**
     * Add a category to the conversation
     */
    public function update(ConversationUpdateRequest $request) 
    {
        $id = request('id');

        $data = $request->validated();
        $cat_ids = $data['categories'];

        $conversation = Conversation::where([['id', $id]])->first();
        $conversation->update(['categories' => $cat_ids]);

        return response()->json(['message' => 'Conversation updated']);
    }

    public function delete(Request $request) 
    {
        return response()->json(['message' => 'Conv deleted']);
    }
}
