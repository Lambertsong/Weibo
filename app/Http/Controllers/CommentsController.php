<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'content' => 'required|max:100'
        ]);

        Auth::user()->comments()->create([
            'content' => $request->input('content'),
            'status_id' => $request->input('status')
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {

    }
}
