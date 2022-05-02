<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreatePostRequest;
use App\Http\Requests\CategoryStatusPostRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories', [
            'categories' => Category::all()
        ]);
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
    public function store(CategoryCreatePostRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->bcolor = $request->bcolor;
        $category->active = 1;
        $category->save();
        // todo message
        return redirect()->route('admin.categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories');
    }

    public function enable(CategoryStatusPostRequest $request){
        /*
         * // Moved to private function changeCategoryStatus
        $category = Category::find($request->id);
        $category->active = 1;
        $category->save();
        */
        $this->changeCategoryStatus($request->id, 1);
        return redirect()->route('admin.categories');
    }

    public function disable(CategoryStatusPostRequest $request){
        $this->changeCategoryStatus($request->id, 0);
        return redirect()->route('admin.categories');
    }

    private function changeCategoryStatus($id, $status){
        $category = Category::find($id);
        $category->active = $status;
        return $category->save();
    }
}
