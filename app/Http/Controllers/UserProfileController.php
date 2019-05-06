<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show(Request $request){
        echo "顯示路由參數:".$request->id."<br>";
        //判斷路徑
        if($request->is('admin/*')) {
            echo "顯示路徑:" . $request->path() . "<br>";
            //url方法將返回不帶查詢字符串的URL
            echo $request->url(). "<br>";
            //fullUrl方法包含查詢字符串
            echo $request->fullUrl(). "<br>";
        }
        if ($request->isMethod('get')){
            echo "這是GET";
        }
    }

}
