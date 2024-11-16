<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\PartnerMessage;
use Illuminate\Http\Request;

class PartnerMessageController extends Controller
{
    public function index()
    {
        $datas = PartnerMessage::with('partner')->get();
        return view('backoffice.pages.partner_message.index', compact('datas'));
    }

    public function changeReadStatus(Request $request)
    {
        $instance = PartnerMessage::findOrFail($request->input('id'));
        $instance->read = $request->input('read') == 'true' ? 1 : 0;
        $instance->save();
        return response()->json();
    }
}
