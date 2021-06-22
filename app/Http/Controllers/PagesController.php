<?php


namespace App\Http\Controllers;

use App\Models\CategoryLife;

class PagesController extends Controller
{
    public function aboutUs(){
        $categories_life = CategoryLife::all();

        return view('our_life.index')->with('categories_life', $categories_life);
    }
}
