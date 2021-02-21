<?php

namespace App\Http\Controllers;
use App\Http\Resources\MessageResource;

use App\Models\Message;
use App\Models\Conversation;

use App\Http\Requests\storeMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeMessageRequest $request)
    {
      
        $user = $request->user();

        $message= new Message();
        $message->body=$request['body'];
        $message->read=false;
        $message->user_id=$user->id;
        $message->conversation_id=$request['conversation_id'];
        $message->save();

        // Send notification to other end
        $conversation = $message->conversation;
        $receiver_id = $conversation->user_id;

        if ($conversation->user_id == $user->id) {
            $receiver_id = $conversation->second_useer_id; 
        } 

        $receiver = User::find($receiver_id);
 
        sendNotification([$receiver->fcm_token], $message->body);

        return new MessageResource($message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
