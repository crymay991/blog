@extends('layout.app')

@section('title', '登录')

@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row pt-4">
            <div class="card col-lg-4 offset-4 mb-3 mt-5">
                <div class="card-body">

                    @include('auth.nav-top', ['nav' => 'login'])

                    <hr>

                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="fs-14 font-weight-bold">用户名 or 邮箱</label>
                            <input type="email" class="form-control form-control-sm"
                                   id="exampleInputEmail1"
                                   placeholder="请填写用户名或邮箱"
                                   aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="fs-14 font-weight-bold">密码</label>
                            <input type="password" placeholder="请输入密码" class="form-control form-control-sm" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100 mt-4 bg-blue text-white">登录</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
