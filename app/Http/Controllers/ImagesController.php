<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Storage;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Auth::user()->images()->orderBy('created_at', 'desc')->paginate(24);
        return view('images/index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('image');
        if(!$file->isValid()) {
            session()->flash('warning', $file->getErrorMessage());
            return redirect()->back();
        }

        $path = 'images/'.date("Y").'/'. date("m").'/'.str_random().'.'.$file->getClientOriginalExtension();

        Storage::put($path, file_get_contents($file->getRealPath()));

        $user = Auth::user()->images()->create([
            'path' => $path,
        ]);

        return redirect()->route('images.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::findOrFail($id);
        return response()->download(realpath(base_path('storage/app')).'/'.$image->path, null, [], null);
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
        //
    }

    public function download($id)
    {
        $image = Image::findOrFail($id);
        return response()->download(realpath(base_path('storage/app')).'/'.$image->path, null, []);
    }
}
