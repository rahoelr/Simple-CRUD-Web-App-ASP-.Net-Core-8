<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Mitra;
use App\Models\Kecamatan;
use App\Models\JenisUsaha;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

date_default_timezone_set("Asia/Jakarta");

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.admin_mitra', [
        //     "title" => "| Mitra",
        //     "mitras" => Mitra::orderBy('mitra_name', 'asc')->paginate(20)
        // ]);
    }

    public function adminView()
    {
        return view('admin.dashboard_admin_mitra', [
            "title" => "| Mitra",
            "mitras" => Mitra::orderBy('mitra_name', 'asc')->paginate(20)
        ]);
    }

    public function details_mitra($id)
    {
        return view('detail_mitra', [
            'title' => "| Detail Mitra",
            "mitra" => Mitra::find($id),
            "products" => Product::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function mitraView($userId)
    {
        return view('admin.dashboard_mitra_toko', [
            "title" => "| Mitra",
            'mitras' => Mitra::where('userId', $userId)->first()
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
            'title' => "| Mitra",
            "usahas" => JenisUsaha::orderBy('jenisUsaha', 'asc')->get(),
            "desas" => Desa::orderBy('desa', 'asc')->get(),
            'kecamatans' => Kecamatan::orderBy('kecamatan', 'asc')->get()
        );
        return view('admin.add_mitra')->with($data);
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
                'mitra_name' => 'required|unique:mitras,mitra_name|max:50',
                'owner' => 'required|max:30',
                't_o_business' => 'required|max:30',
                'desa' => 'required|max:100',
                'kecamatan' => 'required|max:100'
            ]
        );
        if ($files = $request->file('images')) {
            $filenameWithExt = $files->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $files->storeAs('public/mitra_images', $filenameSimpan);
            $thumbnailPath = public_path("storage/mitra_images/{$filenameSimpan}");
            $img = Image::make($thumbnailPath)->resize(464, 379)->save($thumbnailPath);
            $image = $filenameSimpan;
        }
        $mitra = new Mitra;
        $mitra->images = $image;
        $mitra->mitra_name = $request->input('mitra_name');
        $mitra->owner = $request->input('owner');
        $mitra->t_o_business = $request->input('t_o_business');
        $mitra->desa = $request->input('desa');
        $mitra->kecamatan = $request->input('kecamatan');
        $mitra->userId = Auth::user()->id;
        $mitra->save();
        if (Auth::user()->level == 'admin') {
            return redirect('db_admin-mitra')->with('success', 'Berhasil Menambah Mitra Baru!!');
        } else {
            return redirect('db_mitra-toko/' . Auth::user()->id)->with('success', 'Berhasil Menambah Mitra Baru!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('mitra', [
            'title' => "| Mitra",
            "mitras" => Mitra::orderBy('mitra_name', 'asc')->paginate(10)
        ]);
    }

    public function adminShow($id)
    {
        $data = array(
            'title' => "| Mitra",
        );
        $mitras = Mitra::find($id);
        return view('admin.admin_mitra', compact('mitras'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit_mitra', [
            'title' => "| Mitra",
            'mitras' => Mitra::find($id),
            "usahas" => JenisUsaha::orderBy('jenisUsaha', 'asc')->get(),
            "desas" => Desa::orderBy('desa', 'asc')->get(),
            'kecamatans' => Kecamatan::orderBy('kecamatan', 'asc')->get()
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
                'mitra_name' => 'required|max:50',
                'owner' => 'required|max:30',
                't_o_business' => 'required|max:30',
                'desa' => 'required|max:100',
                'kecamatan' => 'required|max:100'
            ]
        );
        $mitra = Mitra::find($id);
        $mitra->mitra_name = $request->input('mitra_name');
        $mitra->owner = $request->input('owner');
        $mitra->t_o_business = $request->input('t_o_business');
        $mitra->desa = $request->input('desa');
        $mitra->kecamatan = $request->input('kecamatan');
        if ($files = $request->file('images')) {
            if ($mitra->images) {
                unlink('storage/mitra_images/' . $mitra->images);
            }
            $filenameWithExt = $files->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $files->storeAs('public/mitra_images', $filenameSimpan);
            $thumbnailPath = public_path("storage/mitra_images/{$filenameSimpan}");
            $img = Image::make($thumbnailPath)->resize(464, 379)->save($thumbnailPath);
            $image = $filenameSimpan;
        }
        $mitra->images = $image;
        $mitra->userId = Auth::user()->id;
        $mitra->update();
        if (Auth::user()->level == 'admin') {
            return redirect('db_admin-mitra')->with('success', 'Berhasil Merubah Data Mitra!!');
        } else {
            return redirect('db_mitra-toko/' . Auth::user()->id)->with('success', 'Berhasil Merubah Data Mitra!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mitra = Mitra::find($id);
        if ($mitra->images) {
            unlink('storage/mitra_images/' . $mitra->images);
        }
        $mitra->delete();
        if (Auth::user()->level == 'admin') {
            return redirect('db_admin-mitra')->with('success', 'Berhasil Menghapus Data Mitra!!');
        } else {
            return redirect('db_mitra-toko/' . Auth::user()->id)->with('success', 'Berhasil Menghapus Data Mitra!!');
        }
    }

    public function __construct()
    {
        $this->middleware('auth', ["except" => ["show", "details_mitra"]]);
    }
}
