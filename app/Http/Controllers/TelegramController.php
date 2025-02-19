<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller {

    public function sendMessage($message) {
        Http::post(env('TLG_BOT_URL') . env('TLG_BOT_TOKEN') . '/sendMessage', [
            'chat_id' => env('TLG_BOT_ID'),
            'text' => $message,
            'parse_mode' => 'html',
        ]);
    }

    public function sendContact() {
        Http::post(env('TLG_BOT_URL') . env('TLG_BOT_TOKEN') . '/sendContact', [
            'chat_id' => env('TLG_BOT_ID'),
            'phone_number' => '+79119268188',
            'first_name' => 'Artem Gusev',
        ]);
    }

}
