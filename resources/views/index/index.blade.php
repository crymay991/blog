@extends('layout.app')

@section('title', '首页')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <style>

    </style>
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid px-0">
        <div class="container text-center text-white">
            <h4 class="display-6">基于Laravel的博客项目</h4>
            <p class="lead">项目仅用于学习</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        @foreach($blogs as $blog)
                            <div class="article-body">
                                <div>
                                    <span class="article-author">{{ $blog->user->name }}</span>
                                    <span class="article-time">{{ $blog->updated_at->diffForHumans() }}</span>
                                </div>
                                <h2 class="font-weight-bold my-3 article-title">
                                    <a class="text-dark" href="{{ route('blog.show', $blog) }}">{{ $blog->title }}</a>
                                </h2>
                                <div class="article-des">{{ $blog->content }}</div>
                                <div>
                                    <a href="#" class="badge badge-warning mt-3 article-category">{{ categories()[$blog->category_id] }}</a>
                                </div>
                            </div>
                            <hr>
                        @endforeach
{{--                        {{ $blogs->appends(["keyword", request()->query('keyword')])->links('vendor.pagination.my-page') }}--}}
                        {{ $blogs->withQueryString()->links('vendor.pagination.my-page') }}
{{--                        <nav class="d-flex justify-content-center mt-4">--}}
{{--                            <ul class="pagination">--}}
{{--                                <li class="page-item disabled">--}}
{{--                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">上一页</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                                <li class="page-item active" aria-current="page">--}}
{{--                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a class="page-link" href="#">下一页</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </nav>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-3 p-0">
                @include('common.right-card', [
                    'imgUrl' => 'https://cdn2.lmonkey.com/Fl5bGoCQYm7i0G7yk3vatG5sok7K',
                    'title' => '博客网站',
                    'content' => '一个用来学习Laravel的博客项目, 基于Bootstrap4.0开发',
                    'count' => $blogs->total(),
                ])
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
