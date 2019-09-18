<?php

namespace App\Http\Controllers;

use App\Item;
use Validator;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'expiry_date' => 'required'
        ]);
        if ($validator->fails()){
            $response = array('response' => $validator->messages(),'success' => false);
            return $response;
        }else{
//            create new item
            $item = new Item();
            $item->title = $request->get('title');
            $item->body = $request->get('body');
            $item->expiry_date = $request->get('expiry_date');
            $item->save();
            return response()->json($item);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'expiry_date' => 'required'
        ]);
        if ($validator->fails()){
            $response = array('response' => $validator->messages(),'success' => false);
            return $response;
        }else{
//            find an item
            $item = Item::find($id);
            $item->title = $request->get('title');
            $item->body = $request->get('body');
            $item->expiry_date = $request->get('expiry_date');
            $item->save();
            return response()->json($item);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        $response = array('response' => 'Item Deleted' ,'success' => True);
        return $response;
    }
}
