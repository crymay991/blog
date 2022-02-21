<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
//        $blog = new Blog();
//        $blog->user_id = auth()->id();
//        $blog->title = $request->input('title');
//        $blog->content = $request->input('content');
//        $blog->category_id = $request->input('category_id');
//        $res = $blog->save();

        // 需在模型类里设置允许批量赋值的字段
//        $res = Blog::create([
//            'user_id' => auth()->id(),
//            'title' => $request->input('title'),
//            'content' => $request->input('content'),
//            'category_id' => $request->input('category_id'),
//        ]);
        // 使用$request->all()添加
        $request->offsetSet('user_id', auth()->id());
        $res = Blog::create($request->except(['_token']));

        if ($res){
            return back()->with(['success' => '添加成功']);
        } else {
            return back()->withErrors('添加失败')->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 预加载
        $blog = Blog::with('comments.user')->where('id', $id)->first();
        // 浏览量自增
        $blog->timestamps = false;
        $blog->increment('view');
        $blog->timestamps = true;
        return view('blog.show', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->category_id = $request->input('category_id');
        $res = $blog->save();
        if ($res){
            return back()->with(['success' => '添加成功']);
        } else {
            return back()->withErrors('添加失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
//        // 使用事务删除博客
//        DB::beginTransaction();
//
//        try {
//            // 删除博客
//            $blog->delete();
//
//            // 删除博客相关的评论
//            $blog->comments()->delete();
//
//            // 提交事务
//            DB::commit();
//
//            return response()->api('删除成功');
//        } catch (\Exception $e) {
//            // 出现异常进行回滚
//            DB::rollBack();
//            return response()->api('删除失败', 400);
//        }

        // 使用模型事件，删除博客时，自动删除相关评论
        $res = $blog->delete();
        if ($res) {
            return response()->api('删除成功');
        } else {
            return response()->api('删除失败', 400);
        }
    }

    public function status(Blog $blog)
    {
        $blog->timestamps = false;
        $blog->status = $blog->status == 1 ? 0 : 1;
        $res = $blog->save();
        if ($res){
            $msg = $blog->status == 1 ? '发布成功' : '取消发布';
            return response()->api($msg);
        } else {
            return response()->api('失败', 400);
        }
    }

}
