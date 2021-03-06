<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Mail;
use Storage;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['edit', 'update', 'destroy', 'followings', 'followers']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $statuses = $user->statuses()->orderBy('created_at', 'desc')->paginate(20);
        return view('users.show', compact('user', 'statuses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'confirmed|min:6'
        ]);

        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        $data = array_filter([
            'name' => $request->name,
            'password' => $request->password,
        ]);
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $id);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    public function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'd4smart@foxmail.com';
        $name = '易水人去';
        $to = $user->email;
        $subject = "感谢注册 Weibo 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    public function followings($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followings()->paginate(20);
        $title = '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followers()->paginate(20);
        $title = '粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function getAvatar($id)
    {
        $user = User::findOrFail($id);
        return view('users.avatar', compact('user'));
    }

    public function postAvatar(Request $request, $id)
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

        $image = Auth::user()->images()->create([
            'path' => $path,
        ]);

        $user = User::findOrFail($id);
        $user->avatar = $image->id;
        $user->save();

        return redirect()->back();
    }

    public function getUserInfo(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);

        if(!$user) {
            return response('未找到用户', 404);
        } else {
            return view('users.user_info', compact('user'));
        }
    }
}
