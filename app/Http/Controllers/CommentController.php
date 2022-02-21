<?php

namespace App\Http\Controllers;

use App\Jobs\CommentEmail;
use App\Mail\BlogComment;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Blog $blog)
    {
       $comment = $blog->comments()->create([
           'user_id' => auth()->id(),
           'content' => $request->input('content')
       ]);

        if ($comment){
            $resDate = [
                'avatar_url' => avatar(auth()->user()->avatar),
                'user_name' => auth()->user()->name,
                'content' => $request->input('content')
            ];

            // 发送邮件通知作者有新的评论 to() 里面可以传用户模型/邮箱地址
//            Mail::to($blog->user)->send(new BlogComment($comment));

            // 使用队列发送邮件
            CommentEmail::dispatch($comment);

            // 使用邮件队列发送
            Mail::to($blog->user)->queue(new BlogComment($comment));

//            dd($comment);

            return response()->api('评论成功', 200, $resDate);
        } else {
            return response()->api('评论失败', 400);
        }
    }
}
