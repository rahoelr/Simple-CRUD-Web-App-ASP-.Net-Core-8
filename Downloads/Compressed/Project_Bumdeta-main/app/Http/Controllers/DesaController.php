<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Mitra;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;

date_default_timezone_set("Asia/Jakarta");

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard_admin_desa', [
            "title" => "| Desa",
            "desas" => Desa::orderBy('desa', 'asc')->paginate(20)
        ]);
    }

    public function sort(Request $request)
    {
        //
    }

    public function details_desa($id)
    {
        return view('detail_desa', [
            'title' => "| Detail Desa",
            "desas" => Desa::find($id),
            "mitras" => Mitra::orderBy('created_at', 'desc')->get()
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
            'title' => "| Desa",
            'kecamatans' => Kecamatan::orderBy('kecamatan', 'asc')->get()
        );
        return view('admin.add_desa')->with($data);
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
                'desa' => 'required|unique:desas,desa|max:50',
                'kecamatan' => 'required|max:30',
                'kabupaten' => 'required|max:30',
                'provinsi' => 'required|max:100',
                'description' => 'required'
            ]
        );
        $image = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $file->storeAs('public/desa_images', $filenameSimpan);
                $thumbnailPath = public_path("storage/desa_images/{$filenameSimpan}");
                $img = Image::make($thumbnailPath)->resize(923, 540)->save($thumbnailPath);
                $image[] = $filenameSimpan;
            }
        }
        $desa = new Desa;
        $desa->images = implode('|', $image);
        $desa->desa = $request->input('desa');
        $desa->kecamatan = $request->input('kecamatan');
        $desa->kabupaten = $request->input('kabupaten');
        $desa->provinsi = $request->input('provinsi');
        $desa->description = nl2br($request->input('description'));
        $desa->save();
        return redirect('admin-desas')->with('success', 'Berhasil Menambah Desa Baru!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('desa', [
            'title' => "| Desa",
            "desas" => Desa::orderBy('desa', 'asc')->paginate(10),
            'kecamatans' => Kecamatan::orderBy('kecamatan', 'asc')->get()
        ]);
    }

    public function adminShow($id)
    {
        $data = array(
            'title' => "| Desa",
        );
        $desas = Desa::find($id);
        return view('admin.admin_desa', compact('desas'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit_desa', [
            'title' => "| Desa",
            'desa' => Desa::find($id),
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
                'desa' => 'required|max:50',
                'kecamatan' => 'required|max:30',
                'kabupaten' => 'required|max:30',
                'provinsi' => 'required|max:100',
                'description' => 'required'
            ]
        );
        $desa = Desa::find($id);
        $desa->desa = $request->input('desa');
        $desa->kecamatan = $request->input('kecamatan');
        $desa->kabupaten = $request->input('kabupaten');
        $desa->provinsi = $request->input('provinsi');
        $desa->description = nl2br($request->input('description'));
        $image = array();
        if ($files = $request->file('images')) {
            if ($desa->images) {
                $imgs = explode('|', $desa->images);
                foreach ($imgs as $item) {
                    unlink('storage/desa_images/' . $item);
                }
            }
            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $file->storeAs('public/desa_images', $filenameSimpan);
                $thumbnailPath = public_path("storage/desa_images/{$filenameSimpan}");
                $img = Image::make($thumbnailPath)->resize(923, 540)->save($thumbnailPath);
                $image[] = $filenameSimpan;
            }
        }
        $desa->images = implode('|', $image);
        $desa->update();
        return redirect('admin-desas')->with('success', 'Berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desa = Desa::find($id);
        if ($desa->images) {
            $image = explode('|', $desa->images);
            foreach ($image as $item) {
                unlink('storage/desa_images/' . $item);
            }
        }
        $desa->delete();
        return redirect('admin-desas')->with('success', 'Berhasil dihapus!!');
    }
}
