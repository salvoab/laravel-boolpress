<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $articles = Article::latest()->get();
        } catch (\Illuminate\Database\QueryException $e) {
            $articles = null;
        }
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $categories = Category::all();
        } catch (\Illuminate\Database\QueryException $e) {
            $categories = null;
        }
        try {
            $tags = Tag::all();
        } catch (\Illuminate\Database\QueryException $e) {
            $tags = null;
        }
        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'exists:tags,id'
        ]);
        Article::create($validatedData); // prende i dati validati e li salva nella tabella articles
        $article = Article::orderBy('id', 'desc')->first();
        $article->tags()->attach($request->tags);
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'exists:tags,id'
        ]);
        $article->update($validatedData);
        $article->tags()->sync($request->tags);
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $tagsId = $this->extractIds($article->tags);
        //dd($tagsId);
        $article->tags()->detach($tagsId); // Rimuovo i record nella tabella article_tag inerenti all'articolo che sto per cancellare
        $article->delete(); // Cancello l'articolo dal database
        return redirect()->route('articles.index');
    }

    /**
     * Take a collection of models and return an array of their ids
     * 
     * @param \Illuminate\Database\Eloquent\Collection $models
     * @return array Array containing the models' ids 
    */
    private function extractIds($models)
    {
        $ids = [];
        foreach($models as $model){
            $ids[] = $model->id;
        }
        return $ids;
    }
}
