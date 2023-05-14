<?php

namespace App\Http\Controllers;

use App\Models\JenisUsaha;
use Illuminate\Http\Request;

class JenisUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard_admin_jenisUsaha', [
            "title" => "| Jenis Usaha",
            "jenisUsahas" => JenisUsaha::orderBy('jenisUsaha', 'asc')->paginate(20)
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
            'title' => "| Jenis Usaha"
        );
        return view('admin.add_jenisUsaha')->with($data);
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
                'jenisUsaha' => 'required|unique:jenis_usahas,jenisUsaha'
            ]
        );
        $jenisUsaha = new JenisUsaha;
        $jenisUsaha->jenisUsaha = $request->input('jenisUsaha');
        $jenisUsaha->save();
        return redirect('db_admin-jenis_usaha')->with('success', 'Berhasil Menambah Jenis Usaha Baru!!');
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
            'title' => "| Jenis Usaha",
        );
        $jenisUsahas = JenisUsaha::find($id);
        return view('admin.admin_usaha', compact('jenisUsahas'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit_usaha', [
            'title' => "| Jenis Usaha",
            'jenisUsahas' => JenisUsaha::find($id)
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
                'jenisUsaha' => 'required'
            ]
        );
        $jenisUsaha = JenisUsaha::find($id);
        $jenisUsaha->jenisUsaha = $request->input('jenisUsaha');
        $jenisUsaha->update();
        return redirect('db_admin-jenis_usaha')->with('success', 'Berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenisUsaha = JenisUsaha::find($id);
        $jenisUsaha->delete();
        return redirect('db_admin-jenis_usaha')->with('success', 'Berhasil dihapus!!');
    }
}
