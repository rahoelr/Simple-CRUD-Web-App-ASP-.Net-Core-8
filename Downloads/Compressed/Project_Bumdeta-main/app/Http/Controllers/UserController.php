<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

date_default_timezone_set("Asia/Jakarta");

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard_admin_mitraAcc', [
            "title" => "| User",
            "users" => User::orderBy('created_at', 'asc')->paginate(10)
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array(
            'title' => "| User",
        );
        $users = User::find($id);
        return view('admin.admin_user', compact('users'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit_profile', [
            'title' => "| Dashboard",
            'users' => User::find($id)
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
                'name' => 'required|max:40'
            ]
        );
        $user = User::find($id);
        $user->name = $request->input('name');
        if ($files = $request->file('images')) {
            if ($user->images) {
                if ($user->images != 'user_image_default.png') {
                    unlink('storage/user_images/' . $user->images);
                }
            }
            $filenameWithExt = $files->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $files->storeAs('public/user_images', $filenameSimpan);
            $thumbnailPath = public_path("storage/user_images/{$filenameSimpan}");
            $img = Image::make($thumbnailPath)->resize(500, 500)->save($thumbnailPath);
            $image = $filenameSimpan;
        }
        $user->images = $image;
        $user->update();
        return redirect('/home')->with('success', 'Berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->images) {
            if ($user->images != 'user_image_default.png') {
                unlink('storage/user_images/' . $user->images);
            }
        }
        $user->delete();
        return redirect('db_admin-user')->with('success', 'Berhasil dihapus!!');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
