<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;

date_default_timezone_set("Asia/Jakarta");

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard_admin_team', [
            "title" => "| Team",
            "teams" => Team::orderBy('level', 'asc')->paginate(20)
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
            'title' => "| Team"
        );
        return view('admin.add_anggota')->with($data);
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
                'name' => 'required|max:50',
                'position' => 'required|max:50'
            ]
        );
        if ($files = $request->file('images')) {
            $filenameWithExt = $files->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $files->storeAs('public/team_images', $filenameSimpan);
            $thumbnailPath = public_path("storage/team_images/{$filenameSimpan}");
            $img = Image::make($thumbnailPath)->resize(353, 353)->save($thumbnailPath);
            $image = $filenameSimpan;
        }
        if ($request->input('position') == 'Ketua') {
            $level = '1';
        }
        if ($request->input('position') == 'Sekretaris 1') {
            $level = '2';
        }
        if ($request->input('position') == 'Sekretaris 2') {
            $level = '3';
        }
        if ($request->input('position') == 'Bendahara') {
            $level = '4';
        }
        if ($request->input('position') == 'Manager Unit Pangan') {
            $level = '5';
        }
        if ($request->input('position') == 'Manager Unit Barang & Jasa') {
            $level = '6';
        }
        $team = new Team;
        $team->images = $image;
        $team->name = $request->input('name');
        $team->position = $request->input('position');
        $team->level = $level;
        $team->save();
        return redirect('db_admin-team')->with('success', 'Berhasil Menambah Anggota Baru!!');
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
            'title' => "| Team",
        );
        $teams = Team::find($id);
        return view('admin.admin_anggota', compact('teams'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit_anggota', [
            'title' => "| Team",
            'teams' => Team::find($id)
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
                'name' => 'required|max:50',
                'position' => 'required|max:50'
            ]
        );
        $team = Team::find($id);
        $team->name = $request->input('name');
        $team->position = $request->input('position');
        if ($request->input('position') == 'Ketua') {
            $level = '1';
        }
        if ($request->input('position') == 'Sekretaris 1') {
            $level = '2';
        }
        if ($request->input('position') == 'Sekretaris 2') {
            $level = '3';
        }
        if ($request->input('position') == 'Bendahara') {
            $level = '4';
        }
        if ($request->input('position') == 'Manager Unit Pangan') {
            $level = '5';
        }
        if ($request->input('position') == 'Manager Unit Barang & Jasa') {
            $level = '6';
        }
        $team->level = $level;
        if ($files = $request->file('images')) {
            if ($team->images) {
                unlink('storage/team_images/' . $team->images);
            }
            $filenameWithExt = $files->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $files->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $files->storeAs('public/team_images', $filenameSimpan);
            $thumbnailPath = public_path("storage/team_images/{$filenameSimpan}");
            $img = Image::make($thumbnailPath)->resize(353, 353)->save($thumbnailPath);
            $image = $filenameSimpan;
        }
        $team->images = $image;
        $team->update();
        return redirect('db_admin-team')->with('success', 'Berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        if ($team->images) {
            unlink('storage/team_images/' . $team->images);
        }
        $team->delete();
        return redirect('db_admin-team')->with('success', 'Berhasil dihapus!!');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
