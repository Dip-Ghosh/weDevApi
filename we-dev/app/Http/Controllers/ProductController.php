<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
    * Dip Ghosh
    * email:dipghosh638@gmail.com
    * mobile:01744499902
    * Show the all product
    * @return json response
    */

    public function index(){
        $products =  DB::table('products')->get();
        return response()->json([
            'product'=>$products,
            'status'=>'success',
            'statusCode'=>200

        ]);
    }

    /**
     * Dip Ghosh
     * email:dipghosh638@gmail.com
     * mobile:01744499902
     * store data  in the products table
     * @param $request
     * @return json response
     */

    public function store(Request $request){

        $name = null;
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath ='public/images/';
            $image->move($destinationPath, $name);
        }

        $data = [
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'image' =>$name
        ];

        DB::table('products')->insert($data);
        return response()->json([
            'status'=>'success',
            'statusCode'=>200,
            'product'=>$data,
            'message'=>'Products data has been added successfully.'
        ]);
    }

    /**
     * Dip Ghosh
     * email:dipghosh638@gmail.com
     * mobile:01744499902
     * Show the single Product in the List
     * @param $id
     * @return json response
     */

    public function show($id){

        $product = DB::table('products')->where('id',$id)->get();
        return response()->json([
            'status'=>'success',
            'statusCode'=>200,
            'data'=>$product
        ]);
    }

    /**
     * Dip Ghosh
     * email:dipghosh638@gmail.com
     * mobile:01744499902
     * Show the update  in the List
     * @param  Request $request,$id
     * @return json response
     */

    public function update(Request $request,$id){
        $val = DB::table('products')->where('id',$id)->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath ='public/images/';
            $image->move($destinationPath, $name);
           // $data['image'] = $name;
        }

        $data = [
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'image'=>($request->hasFile('image'))?$name :$val->image
        ];
      // dd($data);
       DB::table('products')->where('id',$id)->update($data);
        return response()->json([
            'status'=>'success',
            'statusCode'=>200,
            'message'=>$data
        ]);
    }

    /**
     * Dip Ghosh
     * email:dipghosh638@gmail.com
     * mobile:01744499902
     * delete Product  From the List
     * @param  $id
     * @return json response
     */

    public function destroy($id){

        DB::table('products')->where('id',$id)->delete();
        return response()->json([
            'status'=>'success',
            'statusCode'=>200,
            'message'=>'Products data has been deleted successfully.'
        ]);
    }





}
