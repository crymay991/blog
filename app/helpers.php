<?php

if (! function_exists('categories')) {
    function categories()
    {
        // 查询数据库
        $categories = cache()->rememberForever('categories', function (){
            $categories = \Illuminate\Support\Facades\DB::table('categories')
                ->pluck('name','id');
            return $categories;
        });
        return $categories;
    }
}

if (! function_exists('avatar')) {
    function avatar($avatar)
    {
        // 返回头像
        $avatar_url = $avatar ? asset('storage/'. $avatar) : asset('img/default/defaultavatar.png');

        return $avatar_url;
    }
}
