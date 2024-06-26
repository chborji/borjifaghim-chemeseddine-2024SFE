<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Conversation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ConversationController extends Controller
{
    public function messages_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        if (!empty($request->file('image'))) {
            $image_name = Helpers::upload('conversation/', 'png', $request->file('image'));
        } else {
            $image_name = null;
        }
        
        $conv = new Conversation;
        $conv->user_id = $request->user()->id;
        $conv->message = $request->message;
        $conv->image = $image_name;
        $conv->save();

        return response()->json(['message' => 'successfully sent!'], 200);
    }

    public function chat_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        if (!empty($request->file('image'))) {
            $image_name = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';
            if (!Storage::disk('public')->exists('conversation')) {
                Storage::disk('public')->makeDirectory('conversation');
            }
            $note_img = Image::make($request->file('image'))->stream();
            Storage::disk('public')->put('conversation/' . $image_name, $note_img);
        } else {
            $image_name = 'def.png';
        }

        $url = asset('storage/app/public/conversation') . '/' . $image_name;

        return response()->json(['image_url' => $url], 200);
    }


    public function messages(Request $request)
    {
        return response()->json([Conversation::where(['user_id' => $request->user()->id])->latest()->get()], 200);
    }
}
