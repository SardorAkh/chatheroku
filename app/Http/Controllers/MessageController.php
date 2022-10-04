<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class MessageController extends Controller
{
    /**
     * Retrieves message list which depends on last message
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function getMessages(Request $request): JsonResponse
    {
        $query = $request->query;
        if (!$query->has("id")) {
            return response()->json(Message::with(["user"])->get());
        }
        $data = Message::with(["user"])->where("id",">",$query->get("id"))->get();
        return response()->json($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

        $user_id = $request->json()->get("user_id");
        $content = $request->json()->get("content");

        Message::create([
           "content" => $content,
           "user_id" => $user_id
        ]);

        return response()->json("", 204);
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
     * Update the specified resource in storage.
     *
     * @param Request $request
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
