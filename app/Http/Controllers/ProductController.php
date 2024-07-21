<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = Product::query();
        if( $request->searchQuery != '' ){
            $products = Product::where('name', 'like', '%' . $request->searchQuery . '%');
        }

        //$products = $products->latest()->get();
        $products = $products->latest()->paginate(2);   // 1페이지당 2개씩

        return response()->json([
            'products' => $products
        ], 200);
    }

    /**
     * 수정할 데이타 가져오기
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        return response()->json([
            'product' => $product
        ], 200);
    }

    /**
     * 등록 저장
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);


        $product = new Product();

        $product->name = $request->name;
        $product->desc = $request->desc;


        if( $request->image != "" ){
            $strpos = strpos($request->image, ';');
            $sub = substr($request->image, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . '.' . $ex;
            $img = Image::read($request->image)->resize(200,200);

            $upload_path = storage_path() . "/app/public/";
            $img->save($upload_path . $name);

            $product->image = $name;
        }else{
            $product->image = '';
        }
        
        $product->type  = $request->type;
        $product->qty = $request->qty;
        $product->price = $request->price;

        $product->save();

    }

    
    /**
     * 수정 업데이트
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);
        
        $upload_path = storage_path() . "/app/public/";

        $product = Product::find($id);
        
        $product->name = $request->name;
        $product->desc = $request->desc;

        /**
         * 파일 삭제 체크를 하거나 새로 이미지를 올릴경우 기존 ㅍ이미지 삭제
         */
        if( $request->imgDel === true || $request->image != $product->image ){
            /**
             * 기존 이미지가 있을 경우 사제
             */
            $oldImage = $upload_path . $product->image;
            if(file_exists($oldImage)){
                @unlink($oldImage);
            }
            $product->image = '';
        }   

        if( $request->image != $product->image ){
            $strpos = strpos($request->image, ';');
            $sub = substr($request->image, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time() . '.' . $ex;
            $img = Image::read($request->image)->resize(200,200);

            $img->save($upload_path . $name);
            $product->image = $name;
        }
        
        
        $product->type  = $request->type;
        $product->qty = $request->qty;
        $product->price = $request->price;

        $product->save();

    }


    
    /**
     * 삭제 처리
     */
    public function destroy($id)
    {
        
        $product = Product::findOrFail($id);
    
        /**
         * 기존 이미지가 있을 경우 사제
         */
        $upload_path = storage_path() . "/app/public/";
        $oldImage = $upload_path . $product->image;
        if(file_exists($oldImage)){
            @unlink($oldImage);
        }

        $product->delete();

    }

}
