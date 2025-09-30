<?php

namespace App\Http\Controllers\Admin\Modules;

use App\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories_data = category::all();
        return view('admin.modules.categories.index',compact('categories_data'));
    }

    public function create()
    {
        return view('admin.modules.categories.create');
    }

    public function store(Request $request)
    {
        $category = new category;

        $category->name = $request->input('txt_category_name');

        $category->active = $request->input('radio_active');

        $category->save();

        return redirect('/admin/modules/categories');
    }


    public function edit($id)
    {
        $category = category::find($id);
        if(!$category){
            return abort(404);
        }
        return view('admin.modules.categories.edit',compact('category'));

    }

    public function update(Request $request, $id)
    {
        $category_name = $request->input('txt_category_name');
        $category_status = $request->input('radio_active');

        $data = array(
            'name' => $category_name,
            'active' => $category_status

        );
        category::Where('id',$id)
            ->update($data);

        return redirect('/admin/modules/categories');
    }

    public function destroy($id)
    {
        $category = category::find($id);
        if(!$category){
            return abort(404);
        }
        category::Where('id',$id)->delete();
        return redirect('/admin/modules/categories');
    }
}
