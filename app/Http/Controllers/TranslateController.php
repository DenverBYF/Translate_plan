<?php

namespace App\Http\Controllers;

use App\Message;
use App\Part;
use App\Providers\MessageServiceProvider;
use App\Translate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TranslateController extends Controller
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
     * @return View
     */
    public function store(Request $request)
    {
        //
		$translate = new Translate();
		$translate->content = $request->input('translate');
		$translate->u_id = Auth::id();
		$translate->p_id = $request->input('pid');
		$translate->a_u_id = $request->input('auid');
		if ($translate->save()) {
			return redirect()->route('article.show', $request->input('aid'))->with('success', '翻译成功, 请等待审核');
		} else {
			$errors = collect(['储存失败']);
			return view('article.translate', compact('errors'));
		}

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        //
		$translate = Translate::findOrFail($id);
		$part = Part::findOrFail($translate->p_id);
		$tContent = $translate->content;
		$pContent = $part->content;
		return view('translate.accept', compact('tContent', 'pContent', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        //
		$article = Part::findOrFail($id);
		return view('article.translate', compact('article'));
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
    }

    /**
     * Accept or deny the translate part
	 * @param int $id int $status(-1,1)
	 * @return View
     * */
    public function accept($id, $status)
	{
		$translate = Translate::findOrFail($id);
		$uId = Auth::id();
		if ($translate->a_u_id !== $uId) {
			return view('layouts._403');
		} else {
			$translate->status = $status;
			$href = route('article.show', ['id' => $translate->part->a_id]);
			if ($status == 1) {
				$ret = $this->sendMessage($translate->u_id, '恭喜!您的翻译已经被审核通过.', $href, '审核通过');
			} else {
				$ret = $this->sendMessage($translate->u_id, '抱歉!您的翻译未审核通过.', $href, '审核未通过');
			}
			if ($translate->save()) {
				return redirect()->route('person.show', $uId)->with('success', "更新成功");
			} else {
				return redirect()->route('person.show', $uId)->with('danger', "操作失败");
			}
		}
	}

	/**
	 * Like a translate part
	 * @param int $id
	 * @param int $status
	 * @return Response
	 * */
	public function like($id, $status)
	{
		$uId = Auth::id();
		$judge = DB::table('t_like')->where('u_id', $uId)->where('t_id', $id)->get();
		if (!$judge->isEmpty()) {
			return response('repeat', 400);
		}
		DB::table('t_like')->insert([
			't_id' => $id,
			'u_id' => $uId,
			'status' => $status
		]);
		return response('ok', 200);
	}

	/**
	 * Create a new message
	 * @param int $tId
	 * @param string $content
	 * @param string $href
	 * @param string $title
	 * @return boolean
	 * */
	protected function sendMessage($tId, $content, $href = null, $title = '新的消息通知')
	{
		$message = new Message();
		$message->f_id = Auth::id();
		$message->t_id = $tId;
		$message->content = $content;
		$message->href = $href;
		$message->title = $title;
		$messageHandle = new MessageServiceProvider($message);
		return $messageHandle->create();
	}
}
