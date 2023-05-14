<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

date_default_timezone_set("Asia/Jakarta");

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard_admin_message', [
            "title" => "| Message",
            "messages" => Message::orderBy('created_at', 'desc')->paginate(10)
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
        $request->validate(
            [
                'fullName' => 'required|max:30',
                'email' => 'required|max:40',
                'subject' => 'required|max:100',
                'content' => 'required'
            ]
        );
        $message = new Message;
        $message->fullName = $request->input('fullName');
        $message->email = $request->input('email');
        $message->subject = $request->input('subject');
        $message->content = nl2br($request->input('content'));
        $message->save();
        return redirect('home')->with('success', 'Berhasil Mengirim Pesan!!');
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
            'title' => "| Message",
        );
        $messages = Message::find($id);
        return view('admin.admin_message', compact('messages'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $messages = Message::find($id);
        $messages->delete();
        return redirect('db_admin-message')->with('success', 'Berhasil dihapus!!');
    }

    public function __construct()
    {
        $this->middleware('auth', ["except" => ["store"]]);
    }
}
