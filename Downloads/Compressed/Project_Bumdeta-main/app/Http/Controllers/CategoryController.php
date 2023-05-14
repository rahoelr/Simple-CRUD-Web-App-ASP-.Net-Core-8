<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;

date_default_timezone_set("Asia/Jakarta");

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard_admin_category', [
            "title" => "| Category",
            "categories" => Category::orderBy('category', 'asc')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'title' => "| Category"
        );
        return view('admin.add_category')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'images' => 'required',
                'category' => 'required|unique:categories,category'
            ]
        );
        if ($files = $request->file('images')) {
            $filenameWithExt = $files->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $files->storeAs('public/category_images', $filenameSimpan);
            $thumbnailPath = public_path("storage/category_images/{$filenameSimpan}");
            $img = Image::make($thumbnailPath)->resize(154, 154)->save($thumbnailPath);
            $image = $filenameSimpan;
        }
        $category = new Category;
        $category->images = $image;
        $category->category = $request->input('category');
        $category->save();
        return redirect('db_admin-category')->with('success', 'Berhasil Menambah Category Baru!!');
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
    }

    public function adminShow($id)
    {
        $data = array(
            'title' => "| Category",
        );
        $categories = Category::find($id);
        return view('admin.admin_category', compact('categories'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit_category', [
            'title' => "| Category",
            'categories' => Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'images' => 'required',
                'category' => 'required'
            ]
        );
        $category = Category::find($id);
        $category->category = $request->input('category');
        if ($files = $request->file('images')) {
            if ($category->images) {
                unlink('storage/category_images/' . $category->images);
            }
            $filenameWithExt = $files->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $files->storeAs('public/category_images', $filenameSimpan);
            $thumbnailPath = public_path("storage/category_images/{$filenameSimpan}");
            $img = Image::make($thumbnailPath)->resize(154, 154)->save($thumbnailPath);
            $image = $filenameSimpan;
        }
        $category->images = $image;
        $category->update();
        return redirect('db_admin-category')->with('success', 'Berhasil diupdate!!');
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
        if ($category->images) {
            unlink('storage/category_images/' . $category->images);
        }
        $category->delete();
        return redirect('db_admin-category')->with('success', 'Berhasil dihapus!!');
    }
}
