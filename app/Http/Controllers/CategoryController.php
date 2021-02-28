<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Category::latest()->get();
        } catch (\Illuminate\Database\QueryException $e) {
            $categories = null;
        }
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            "name" => "required|unique:categories",
            "description" => "required",
        ]);
        Category::create($validatedData);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            "name" => "required",
            "description" => "required",
        ]);
        
        try {
            $category->update($validatedData);
            return redirect()->route('categories.show', $category); 
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = "Hai cercato di modificare il nome della categoria, ma il nome: $category->name è già presente. Usa un altro nome";
            $backTo = "categories.edit";
            $routeData = $category;
            return view('error_message', compact('errorMessage', 'backTo', 'routeData'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = "Impossibile cancellare la categoria di nome: $category->name, perché collegata a degli articoli";
            $backTo = "categories.index";
            $routeData = null;
            return view('error_message', compact('errorMessage', 'backTo', 'routeData'));
        }
    }
}
