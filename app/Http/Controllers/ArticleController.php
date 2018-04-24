<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Part;
use App\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
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
     * @param Article $article = null
     * @return \Illuminate\Http\Response
     */
    public function create(Article $article = null)
    {
        //
		$type = Type::all();
		return view('article.edit', compact('type', 'article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //
		$data = array_merge($request->all(), ['u_id' => Auth::id()]);
		$content = $request->input('content');
		//分段
		$data = explode("\n", $content);
		$num = 0;
		$part = [];
		$buffer = "";
		foreach ($data as $eachPart) {
			$buffer .= $eachPart;
			$num = $num + strlen($eachPart);
			if ($num > 300) {
				$part[] = $buffer;
				$num = 0;
				$buffer = "";
			}
		}
		$article = new Article();
		$article->title = $request->input('title');
		$article->t_id = $request->input('t_id');
		$article->u_id = Auth::id();
		$article->content = $content;
		DB::transaction(function () use ($article, $part) {
			$article->save();
			foreach ($part as $eachPart) {
				$newPart = new Part();
				$newPart->a_id = $article->id;
				$newPart->content = $eachPart;
				$newPart->save();
			}
		});
		return redirect()->route('article.show', ['id' => $article->id]);
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
		$article = Article::findOrFail($id);
		return view('article.show', compact('article'));
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
     * @param  ArticleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
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
