<?php

// namespase : パッケージみたいなもの
namespace App\Http\Controllers;

// importとかusing的なやつ
use Illuminate\Http\Request;


class HomeController extends Controller
{
    function about() {
        return view("about");
    }

    function search(Request $request) {
        // dd($request);
        //$keyword = $request->q;
        // $message = "Keyword: {$keyword}";

        $data = ["keyword" => $request->q];
        return view("search",$data);
    }
}
