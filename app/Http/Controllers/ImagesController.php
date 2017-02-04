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
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $file = $request->file('image');
        if(!$file) {
            return response('未接收到文件', 503);
        }
        if(!$file->isValid()) {
            return response($file->getErrorMessage(), 502);
        }

        $path = 'images/'.date("Y").'/'. date("m").'/'.str_random().'.'.$file->getClientOriginalExtension();

        Storage::put($path, file_get_contents($file->getRealPath()));

        Auth::user()->images()->create([
            'path' => $path,
        ]);

        return response()->json(['result'=>200, 'message'=>'上传成功']);
    }

    public function upload(Request $request)
    {
        $file = $request->file('image');
        if(!$file) {
            return response('error|文件上传失败');
        }
        if(!$file->isValid()) {
            return response('error|文件上传错误');
        }

        $path = 'images/'.date("Y").'/'. date("m").'/'.str_random().'.'.$file->getClientOriginalExtension();

        Storage::put($path, file_get_contents($file->getRealPath()));

        $image = Auth::user()->images()->create([
            'path' => $path,
        ]);

        return response(route('images.show', $image->id));
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
        session()->flash('success', '图像裁剪成功');
        return redirect()->back();
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
