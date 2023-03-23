<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newItem = new Item();
        $newItem->name = $request->name;
        $newItem->save();
        return $newItem;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if($item){
            $item->completed = $request->item['completed'] ? true :false;
            $item->completed_at = $request->item['completed'] ? Carbon::now() :null;
            $item->save();
            return $item;
        }else{
            return "Item Not Found..";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if($item){
            $item->delete();
            return "Item Deleted..";
        }else{
            return "Item Not found";
        }
    }
}
