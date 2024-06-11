<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class isShopController extends Controller
{
    public function index()
    {
        // $articles = Article::all();
        // return Inertia::render('Article/Index', ['articles' => $articles]);
        return Inertia::render('Shop/index', [
            'products' => Product::all(),
        ]); 


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return Inertia::render('Article/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Article::create($request->validate([
        //     'description' => 'required',
        //     'title' => 'required',
        // ]));

        // return redirect()->route('articles.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('Shop/Show', [
            'products' => Product::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Article $article)
    // {
    //     return Inertia::render('Article/Edit', ['article' => $article]);
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Article $article)
    // {
    //     $article->update([
    //         'description' => $request->description,
    //         'title' => $request->title,
    //     ]);

    //     return redirect()->route (route: 'articles.index');

    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Article $article)
    // {
    //     $article->delete();
    //     return redirect()->route (route: 'articles.index');

    // }
}
