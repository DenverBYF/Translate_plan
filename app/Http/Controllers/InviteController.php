<?php

namespace App\Http\Controllers;

use App\Message;
use App\Providers\MessageServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InviteController extends Controller
{
    //
	public function index(Request $request)
	{
		$fUser = Auth::user();
		$message = new Message();
		$user = User::where('name', $request->input('name'))->select('id')->first();
		if (empty($user)) {
			return response('无此用户', 400);
		}
		$message->t_Id = $user['id'];
		$message->f_id = $fUser->id;
		$message->title = "邀请翻译通知";
		$message->content = "用户{$fUser->name}邀请翻译文章段落";
		$href = route('article.show', ['id' => $request->input('aId')]);
		$pId = $request->input('pId');
		$message->href = $href."#$pId";
		$messageHandle = new MessageServiceProvider($message);
		if ($messageHandle->create()) {
			return response('ok', 200);
		} else {
			return response('error', 500);
		}
	}
}
