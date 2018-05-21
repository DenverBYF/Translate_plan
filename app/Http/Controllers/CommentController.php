<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Message;
use App\Providers\MessageServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$comment = new Comment();
		$comment->a_id = intval($request->input('aId'));
		$comment->u_id = Auth::id();
		if ($request->input('pId') != 0) {
			$replayUser = User::findOrFail($request->input('pId'));
			$content = "@{$replayUser->name} \n".$request->input('content');
		}
		$comment->content = isset($content)?$content:$request->input('content');
		$comment->p_id = $request->input('pId');
		if ($comment->save()) {
			if (Auth::id() == $request->input('uId')) {
				return redirect()->route('article.show', ['id' => $request->input('aId')])->with('success', '评论成功');
			}
			$message = new Message();
			$message->f_id = Auth::id();
			$message->t_id = $request->input('uId');
			$message->content = "您的文章有了新的评论!";
			$message->title = "新的评论通知";
			$message->href = route('article.show', ['id' => $request->input('aId')]);
			$messageHandle = new MessageServiceProvider($message);
			$messageHandle->create();
			return redirect()->route('article.show', ['id' => $request->input('aId')])->with('success', '评论成功');
		} else {
			return redirect()->route('article.show', ['id' => $request->input('aId')])->with('danger', '评论失败');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$comment = Comment::findOrFail($id);
		if (intval($comment->u_id) !== Auth::id()) {
			return view('latouts._403');
		} else {
			if ($comment->delete()) {
				return response('ok', 200);
			} else {
				return response('error', 500);
			}
		}
    }
}
