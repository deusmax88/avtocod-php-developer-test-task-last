<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Добавить новое сообщение
     *
     * @param NewMessage $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publishNew(NewMessage $request)
    {
        $validated = $request->validated();

        $request->user()->messages()->create($validated);

        return back();
    }

    /**
     * Удалить существующее сообщение
     *
     * @param $messageId
     * @return void
     */
    public function deleteMessage(Request $request, $messageId)
    {
        if ($request->user()->messages()->where('id', $messageId)->first()) {
            \App\Message::destroy($messageId);
        }

        return back();
    }


    /**
     * Оторбразить список всех сообщений
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $messages = \App\Message::orderBy('created_at', 'DESC')->get();

        return view('list', [
            'messages' => $messages
        ]);
    }
}
