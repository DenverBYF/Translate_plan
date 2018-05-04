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
		$divide = $request->input('divide')??300;
		foreach ($data as $eachPart) {
			$buffer .= $eachPart;
			$num = $num + strlen($eachPart);
			if ($num > $divide and substr_count($buffer, '```')%2 === 0) {
				$part[] = $buffer;
				$num = 0;
				$buffer = "";
			}
		}
		//添加剩余的内容
		$part[] = $buffer;
		$article = new Article();
		$article->title = $request->input('title');
		$article->t_id = $request->input('t_id');
		$article->u_id = Auth::id();
		$article->content = $content;
		//事务处理,储存文章及分段结果
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
		$part = Part::where('a_id', $id)->get();
		return view('article.show', compact('article', 'part'));
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
