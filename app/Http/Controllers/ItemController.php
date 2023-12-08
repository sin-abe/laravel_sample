<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //データを全て取得
        $items = Item::get();
        $data["items"] = $items;

        //ページの表示
        return view("item.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("item.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        //データ取得
        $data = $request->all();
        //データベースへ保存
        //Eloquent
        Item::create($data);
        //リダイレクト
        return redirect(route("item.index"));
        //dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $items = [
            1 => "コーヒー",
            2 => "紅茶",
            3 => "ほうじ茶"
        ];
        if($id > 0 && in_array($id,array_keys($items))) {
            $item = $items[$id];
        }
        $data = ["item" => $item];

        return view("item.show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        // Itemの発見・データ化
        $item = Item::find($id);
        $data["item"] = $item;
        //dd($data);

        return view("item.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // 全データ取得
        $data = $request->all();
        //dd($data);

        // update items set price = ??? where id = ???
        // _tokenを削除
        //unset($data["_token"]);
        //Item::where("id",$id)->update($data);
        Item::find($id)->fill($data)->save();

        //リダイレクト
        return redirect(route("item.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // itemの削除
        Item::destroy($id);
        // 一覧へバック
        return redirect(route("item.index"));
    }
}
