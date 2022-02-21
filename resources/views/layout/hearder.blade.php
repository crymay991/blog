<header class="header">
    <div class="container bg-light d-flex justify-content-between align-items-center">
        <div class="d-flex">
            <a class="logo" href="{{ route('index') }}">Laravel</a>
            <form method="get" action="{{ route('index') }}" class="form-inline my-2 my-lg-0 ml-3">
                <input value="{{ request()->query('keyword') }}" name="keyword" class="form-control form-control-sm" type="search" placeholder="搜索" aria-label="Search">
                <select name="category_id" class="form-control form-control-sm ml-2" id="exampleFormControlSelect1">
                    <option value="0">请选择分类</option>
                    @foreach(categories() as $id => $name)
                        <option {{ request()->query('category_id') == $id ? 'selected' : '' }} value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-sm btn-outline-success ml-2 px-4" type="submit">搜索</button>
            </form>
        </div>
        <div class="right-btn">
            @auth
                <a href="{{ route('user.info') }}" class="text-dark mr-3 text-decoration-none">
                    <img width="30" height="30" src="{{ avatar(auth()->user()->avatar) }}" class="rounded-pill" alt="...">
                    {{--                    <span>{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>--}}
                    <span>{{ auth()->user()->name }}</span>
                </a>
                <a href="{{ route('blog.create') }}" class="text-dark mr-3 text-decoration-none">
                   发布博客
                </a>
                <form method="post" action="{{ route('logout') }}" class="d-inline" id="logout">
                    @csrf
                    <a href="javascript:;" onclick="document.getElementById('logout').submit()" class="text-dark text-decoration-none">退出</a>
                </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-sm btn-primary">登录</a>
            <a href="{{ route('register') }}" class="btn btn-sm btn-outline-success ml-2">注册</a>
            @endauth
        </div>
    </div>
</header>
