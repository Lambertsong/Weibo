<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Storage;
use Intervention\Image\ImageManager;

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
        $images = Auth::user()->images()->orderBy('created_at', 'desc')->paginate(12);
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
        if(!$file) {
            abort(503, '未接收到文件');
        }
        if(!$file->isValid()) {
            abort(502, $file->getErrorMessage());
        }

        $path = 'images/'.date("Y").'/'. date("m").'/'.str_random().'.'.$file->getClientOriginalExtension();

        Storage::put($path, file_get_contents($file->getRealPath()));

        $user = Auth::user()->images()->create([
            'path' => $path,
        ]);

        return response()->json(['result'=>200, 'message'=>'上传成功']);
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

        $manager = new ImageManager();

        return $manager->make(realpath(base_path('storage/app')).'/'.$image->path)->response();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('images/edit', compact('image'));
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
        $image = Image::findOrFail($id);

        $x = $request->input('x');
        $y = $request->input('y');
        $w = $request->input('w');
        $h = $request->input('h');

        $manager = new ImageManager();
        $manager->make(realpath(base_path('storage/app')).'/'.$image->path)->crop($w, $h, $x, $y)->save();
        return redirect()->route('images.show', $image->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::delete($image->path);
        $image->delete();
        session()->flash('success', '图片已被成功删除！');
        return redirect()->back();
    }

    public function download($id)
    {
        $image = Image::findOrFail($id);
        return response()->download(realpath(base_path('storage/app')).'/'.$image->path, null, []);
    }
}
