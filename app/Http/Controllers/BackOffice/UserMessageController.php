<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserMessageController extends Controller
{
    public function index()
    {
        $datas = UserMessage::all();
        return view('backoffice.pages.user_message.index', compact('datas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('client.contact')
                ->withErrors($validator)
                ->withInput();
        }

        UserMessage::create($validator->validated());
        return redirect()->back()->with('message', "Nous répondrons le plus rapidement possible à votre message.");
    }

    public function changeReadStatus(Request $request)
    {
        $instance = UserMessage::findOrFail($request->input('id'));
        $instance->read = $request->input('read') == 'true' ? 1 : 0;
        $instance->save();
        return response()->json();
    }
}
