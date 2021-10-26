<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; //use sql

use URL;

use App\Models\Admin;

use App\Models\Store;

use App\Models\Products;

use App\Models\Variant;

use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // public function create (Request $request){



    //             $query = DB::table('products')
    //             ->insertGetId([
    //                 'title' => $request->title,
    //                 'description' => $request->description,
    //                 'status' => $request->status,
    //                 'store_id'=>$request->store_id
    //             ]);

    //             // variant
    //             $data = [];
    //             $data1 = [];
    //         if (!empty($data)&&!empty($data1)){
    //             foreach($request->input('variant') as $key => $value) {
    //                 $data["variant.{$key}"] = 'required';
    //             }
    //             foreach($request->input('detail') as $key => $value) {
    //                 $data1["detail.{$key}"] = 'required';
    //             }
    //             $validator = Validator::make($request->all(), $data);
    //             $validator1 = Validator::make($request->all(), $data1);
    
    //             if ($validator->passes() && $validator1->passes()) {
    
    
    //                 function myCombinedArray($keys, $values) {
    //                     foreach($values as $index => $value) {
    //                         yield $keys[$index] => $value;
    //                     }
    //                 }
                    
    //                 foreach (myCombinedArray($request->input('variant'), $request->input('detail')) as $value => $detail)  {
                        
    //                         $query2 = DB::table('product_variants')
    //                         ->insert([
    //                             'type'=>$value,
    //                             'type_value'=>$detail,
    //                             'product_id'=>$query,
    //                         ]);
                        

    //                 }
                    
    
    //                 return back()->with('success','Created!');
    //             }
    
    //             return back()->with('fail','something went wrong'); 
    //         }
    //         return back()->with('success','Created!'); 
    // }




	public function storeData($store_name,Request $request)
	{   
        $product_id = DB::table('products')
                ->insertGetId([
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => $request->status,
                    'store_id'=>$request->store_id,
                    'price'=>$request->price,
                ]);
                
        $query = DB::table('gallery')
                ->insert([
                    'product_id' => $product_id,
                    'picture' => $request->description,
                    'documents' => $request->description,
                ]);

                $data = [];
                $data1 = [];
                foreach($request->input('variant') as $key => $value) {
                    $data["variant.{$key}"] = 'required';
                }
                foreach($request->input('detail') as $key => $value) {
                    $data1["detail.{$key}"] = 'required';
                }
                $validator = Validator::make($request->all(), $data);
                $validator1 = Validator::make($request->all(), $data1);
                if ($validator->passes() && $validator1->passes()) {
    
    
                    function myCombinedArray($keys, $values) {
                        foreach($values as $index => $value) {
                            yield $keys[$index] => $value;
                        }
                    }
                    
                    foreach (myCombinedArray($request->input('variant'), $request->input('detail')) as $value => $detail)  {
                        
                            $query2 = DB::table('product_variants')
                            ->insert([
                                'type'=>$value,
                                'type_value'=>$detail,
                                'product_id'=>$product_id,
                            ]);

                    }

                    // return response()->json(['status'=>"success", 'product_id'=>$product_id]);
                }
            return response()->json(['status'=>"success", 'product_id'=>$product_id]);
	}



	public function storeImage(Request $request)
	{
        
        if($request->hasFile('file')){
            
            $file = $request->file('file');
            $completeFileName = $file->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $randomized = rand();
            $documents = str_replace(' ', '', $fileNameOnly).'-'.$randomized.''.time().'.'.$extension;
            // $path = $file->storeAs('/uploads/images', $documents);
            if(!is_dir(public_path() . '/uploads/images/')){
                mkdir(public_path() . '/uploads/images/', 0777, true);
            }
            $file->move(public_path() . '/uploads/images/', $documents);
            // $test2 = $request->hasFile('file');

            $affected = DB::table('gallery')
              ->where('product_id', $request->product_id)
              ->update([
                  'documents' => $documents,
                  'picture'=>$documents
                ]);

        return redirect('/mystore/products')->with('success','you have been sucessful');       
        // return response()->json(['status'=>"success", 'product_id'=>$product_id]);
        }

	}
	public function search ($store_name)
	{
        $admin =admin::where('id','=',session('LoggedAdmin'))->first();

        $stores =Store::where('store_name','=',$store_name)->first();
        $search_text=$_GET['query'];
        $products = DB::table('products')
            ->leftjoin('gallery', 'products.product_id', '=', 'gallery.product_id')
            ->where('title','LIKE',$search_text.'%')->get();
        $data =[
            'LoggedAdminInfo'=>$admin,
            'Store'=>$stores,
             'products'=>$products
        ];

        // dd($products);
        return view('store.admin.search',$data);

	}

}

