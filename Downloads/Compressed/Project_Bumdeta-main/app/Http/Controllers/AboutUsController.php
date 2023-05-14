<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Team;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

date_default_timezone_set("Asia/Jakarta");

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin_about-us', [
            "title" => "| About Us",
            "about_us" => AboutUs::orderBy('id', 'asc')->paginate(10)
        ]);
    }

    public function adminView($id)
    {
        return view('admin.dashboard_admin_aboutus', [
            "title" => "| About Us",
            'about_us' => AboutUs::find($id)
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
            'title' => "| About Us"
        );
        return view('admin.add_about-us')->with($data);
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
                'history' => 'required',
                'logo_meaning' => 'required',
                'visi' => 'required',
                'misi' => 'required'
            ]
        );

        if ($files = $request->file('images')) {
            $filenameWithExt = $files->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $files->storeAs('public/aboutUs_images', $filenameSimpan);
            $thumbnailPath = public_path("storage/aboutUs_images/{$filenameSimpan}");
            $img = Image::make($thumbnailPath)->resize(600, 600)->save($thumbnailPath);
            $image = $filenameSimpan;
        }
        $ab_us = new AboutUs;
        $ab_us->images = $image;
        $ab_us->history = nl2br($request->input('history'));
        $ab_us->logo_meaning = nl2br($request->input('logo_meaning'));
        $ab_us->visi = nl2br($request->input('visi'));
        $ab_us->misi = nl2br($request->input('misi'));
        $ab_us->save();
        return redirect('db_admin-aboutus/1')->with('success', 'Berhasil Menambah Data Baru!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('tentang_kami', [
            'title' => "| About Us",
            'about_us' => AboutUs::orderBy('id', 'desc')->get(),
            'teams' => Team::orderBy('level', 'asc')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit_about-us', [
            'title' => "| About Us",
            'about_us' => AboutUs::find($id)
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
                'history' => 'required',
                'logo_meaning' => 'required',
                'visi' => 'required',
                'misi' => 'required'
            ]
        );
        $ab_us = AboutUs::find($id);
        $ab_us->history = nl2br($request->input('history'));
        $ab_us->logo_meaning = nl2br($request->input('logo_meaning'));
        $ab_us->visi = nl2br($request->input('visi'));
        $ab_us->misi = nl2br($request->input('misi'));
        if ($files = $request->file('images')) {
            if ($ab_us->images) {
                unlink('storage/aboutUs_images/' . $ab_us->images);
            }
            $filenameWithExt = $files->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $files->storeAs('public/aboutUs_images', $filenameSimpan);
            $thumbnailPath = public_path("storage/aboutUs_images/{$filenameSimpan}");
            $img = Image::make($thumbnailPath)->resize(600, 600)->save($thumbnailPath);
            $image = $filenameSimpan;
        }
        $ab_us->images = $image;
        $ab_us->update();
        return redirect('db_admin-aboutus/1')->with('success', 'Berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ab_us = AboutUs::find($id);
        if ($ab_us->images) {
            unlink('storage/aboutUs_images/' . $ab_us->images);
        }
        $ab_us->delete();
        return redirect('db_admin-aboutus/1')->with('success', 'Berhasil dihapus!!');
    }

    public function __construct()
    {
        $this->middleware('auth', ["except" => ["show"]]);
    }
}
