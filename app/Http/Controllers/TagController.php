<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tags = Tag::all();
        } catch (\Illuminate\Database\QueryException $e) {
            $tags = null;
        }
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
            'name' => 'required|unique:tags',
            'description' => 'required'
        ]);

        Tag::create($validatedData);
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        try {
            $tag->update($validatedData);
            return redirect()->route('tags.index');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = "Hai modificato il nome del tag, ma il nome: $tag->name è già presente. Usa un altro nome";
            $backTo = "tags.edit";
            $routeData = $tag;
            return view('error_message', compact('errorMessage', 'backTo', 'routeData'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $articlesIds = $this->extractIds($tag->articles);
        $tag->articles()->detach($articlesIds); // Rimuovo i record nella tabella article_tag inerenti al tag che sto per cancellare
        $tag->delete(); // Cancello il tag dal database
        return redirect()->route('tags.index');
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
