<?php

namespace App\Http\Controllers;

use App\Article;
use App\Part;
use App\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$translate = new Translate();
		$translate->content = $request->input('translate');
		$translate->u_id = Auth::id();
		$translate->p_id = $request->input('pid');
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
}
