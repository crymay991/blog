@extends('layout.app')

@section('title', '所有博客')

@section('style')
    <style>
        .blog-list:last-child {
            border-bottom: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-3">
                @include('common.user-menu', ['nav' => 'blog'])
            </div>
            <div class="col-sm-9 p-0">
                <div class="card">
                    <div class="card-header bg-white fs-14">
                        所有博客
                    </div>
                    <div class="card-body">
                        @foreach($blogs as $blog)
                            <div class="blog-list border-bottom pb-3 mb-3 blog-item">
                                <div><a href="{{ route('blog.show', $blog) }}" class="text-dark text-decoration-none">{{ $blog->title }}</div>
                                <div class="mt-2 d-flex justify-content-between">
                                    <div class="fs-14 text-muted">
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
                                        <span></span>{{ $blog->comments_count }}
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="custom-control custom-switch mr-3">
                                            <input {{ $blog->status == 1 ? 'checked' : '' }} data-url="{{ route('blog.status', $blog) }}" type="checkbox" class="status-blog custom-control-input" id="status-{{ $blog->id }}">
                                            <label class="custom-control-label text-muted" style="font-size: 14px;" for="status-{{ $blog->id }}">是否发布</label>
                                        </div>
                                        <a href="{{ route('blog.edit', $blog) }}" class="btn btn-sm py-0 px-3 btn-primary">编辑</a>
                                        <a href="javascript:;" data-url="{{ route('blog.destroy', $blog) }}" class="del-blog btn btn-sm py-0 px-3 btn-danger ml-2">删除</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            /**
             * 删除博客
             */
            $('.del-blog').click(function () {
                var that = this;
                $.ajax({
                    url: $(this).data('url'),
                    type: 'delete',
                    dataType: 'json',
                    success: function (res) {
                        if (res.code == 200) {
                            // 让删除的这条从页面中消失
                            $(that).parents('.blog-item').remove()
                            notify('success', res.msg);
                        } else {
                            notify('error', res.msg);
                        }
                    }
                })
            })

            /**
             * 改变博客状态
             */
            $('.status-blog').change(function () {
                var that = this;
                $.ajax({
                    url: $(this).data('url'),
                    type: 'patch',
                    dataType: 'json',
                    success: function (res) {
                        if (res.code == 200) {
                            notify('success', res.msg);
                        } else {
                            notify('error', res.msg);
                        }
                    }
                })
            })
        })


    </script>
@endsection
