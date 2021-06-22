<?php


namespace App\Http\Controllers;


use App\Http\Requests\CategoryLife\StoreRequest;
use App\Http\Requests\CategoryLife\UpdateRequest;
use App\Models\CategoryLife;
use App\Services\CategoryLife\Service;

class CategoryLifeController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function create(){

        return view('category_life.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request ->validated();

        $this->service->store($data);

        return redirect()->route('admin.category_life.index');
    }

    public function edit(CategoryLife $category){

        return view('category_life.edit', compact('category'));
    }

    public function update(UpdateRequest $request, CategoryLife $category){
        $data = $request->validated();

        $this->service->update($category, $data);

        return redirect()->route('admin.category_life.index');
    }

    public function destroy(CategoryLife $category){
        $category->delete();
        $category->deleteConnectingPhotoAlbums();

        return redirect()->route('admin.category_life.index');
    }
}
