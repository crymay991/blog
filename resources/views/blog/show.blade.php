@extends('layout.app')

@section('title', '博客详情')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/markdown.css') }}">
    <style>
        .replay:last-child {
            border-bottom: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        @if(auth()->id() == $blog->user_id)
                        <div class="text-right"><a href="{{ route('blog.edit', $blog) }}" class="btn btn-primary btn-sm">编辑</a></div>
                        @endif
                        <h3 class="font-weight-light text-center mb-3">{{ $blog->title }}</h3>
                        <div class="text-center fs-14 text-muted">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                                <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            <span class="mr-2">{{ $blog->updated_at->diffForHumans() }}</span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                            <span class="mr-2">{{ $blog->view }}</span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <span></span>2
                        </div>
                        <hr>
                        <div class="markdown" id="content">

                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-white fs-14">
                        回复数量
                    </div>
                    <div class="card-body" id="comment-list">
                    @forelse($blog->comments as $comment)
                    <div class="media mb-3 border-bottom pb-3 replay">
                        <img width="50" height="50" src="{{ avatar($comment->user->avatar) }}" class="mr-3 rounded-pill" alt="...">
                        <div class="media-body">
                            <h5 class="mt-0">{{ $comment->user->name }}</h5>
                            {{ $comment->content }}
                        </div>
                    </div>
                    @empty
                    <div id="empty" class="text-center py-3 text-muted">暂无评论...</div>
                    @endforelse
                    </div>
                </div>

                @auth
                    <div class="card mt-4">
                        <div class="card-body pb-2">
                            <form id="form-comment" method="post" action="{{ route('blog.comment', $blog)}}">
                                @csrf
                                <div class="form-group">
                                    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="text-right">
                                    <button id="btn-comment" type="button" class="btn btn-primary btn-sm px-5">评论</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card mt-4">
                        <div class="card-body pb-2">
                            <div class="alert alert-warning" role="alert">
                                您还有没有登录, 请登录!
                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm py-1 px-4 ml-3">马上登录</a>
                            </div>
                        </div>
                    </div>
                @endauth

            </div>
            <div class="col-sm-3 p-0">
                @include('common.right-card', [
                      'imgUrl' => 'https://cdn2.lmonkey.com/Fl5bGoCQYm7i0G7yk3vatG5sok7K',
                      'title' => $blog->category->name,
                      'content' => '收录了'.$blog->category->name.'相关的文章',
                      'count' => $blog->category->blogs()->count(),
                      'category_id' => $blog->category_id
                  ])
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/showdown.min.js') }}"></script>
    <script src="{{ asset('js/showdown-table.min.js') }}"></script>
    <script>
        function convert(){
            var text = @json($blog->content);
            var converter = new showdown.Converter({extensions: ['table'] });
            var html = converter.makeHtml(text);
            $('#content').html(html)
            $('#content > table').addClass('table table-bordered');
        }
        convert();

        $(function () {
            /**
             * 点击发送评论
             */
            $('#btn-comment').click(function () {
                var form = $('#form-comment');
                // 提交评论
                $.ajax({
                    url: form.attr('action'),
                    type:'post',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (res) {
                        if(res.code == 200) {
                            // 评论成功之后，评论内容显示到评论列表里面
                            $('#comment-list').append(`
                                <div class="media mb-3 border-bottom pb-3 replay">
                                <img width="50" height="50" src="${ res.date.avatar_url }" class="mr-3 rounded-pill" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">${ res.date.user_name }</h5>
                                    ${ res.date.content }
                                </div>
                            </div>`);
                            // 清空输入框的内容
                            $('textarea[name="content"]').val('')
                            // 让没有评论的提示隐藏
                            $('#empty').hide()
                            notify('success', res.msg)
                        } else {
                            notify('error', res.msg)
                        }
                    }
                })
            })
        })
    </script>
@endsection
