<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function infoPage()
    {
        return view('user.info');
    }

    public function infoUpdate(UserRequest $request)
    {

//        $validatedDate = $request->validate([
//            'name' => 'required|min:4|max:32',
//            'email' => 'required|email',
//        ], [
//            'name.required' => '用户名不能为空',
//            'name.min' => '用户名不能小于4位',
//            'name.max' => '用户名不能大于32位',
//        ]);

        $name = $request->input('name');
        $email = $request->input('email');

        $errors = [];
        if (empty($name)) array_push($errors, '用户不能为空') ;
        if (empty($email)) array_push($errors, '邮箱不能为空') ;
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }

        $uid = auth()->id();

        // 更新用户数据
        $res = DB::table('users')
            ->where('id', $uid)
            ->update(['name' => $name, 'email' => $email]);

        if ($res) {
            return back()->with(['success' => '更新成功']);
        } else {
            return back()->with(['warning' => '未做更改']);
        }
    }

    public function avatarPage()
    {
        return view('user.avatar');
    }

    public function avatarUpdate(Request $request)
    {
        $validatedDate = $request->validate([
            'avatar' => 'required|image',
        ], [
            'avatar.required' => '请选择图片',
            'avatar.image' => '请选择正确的文件格式'
        ]);

        // 获取上传的文件
        $file = $request->file('avatar');

        // 指定磁盘使用public
        $path = $file->store('avatar', 'public');

        // 在更新之前获取用户原有头像
        $oldAvatar = auth()->user()->avatar;

        // 更新当前登录用户的头像
        $uid = auth()->id();
        $res = DB::table('users')
            ->where('id', $uid)
            ->update(['avatar' => $path]);

        if ($res) {
            // 用户头像更新之后， 删除原有的头像
            Storage::disk('public')->delete($oldAvatar);

            return back()->with(['success' => '头像更新成功']);
        } else {
            return back()->withErrors('头像未更新');
        }
    }

    public function blog()
    {
        // 查询用户所有博客
        $blogs = auth()
            ->user()
            ->blogs()
            ->withCount('comments')
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
        return view('user.blog', ['blogs' => $blogs]);
    }

}
