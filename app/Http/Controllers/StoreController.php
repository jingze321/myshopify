<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB; //use sql

use Redirect;

use App\Models\Admin;

use App\Models\User;

use App\Models\Store;

use App\Models\Products;

use App\Models\Cart;

use App\Models\Order;

use App\Models\OrderItem;




class StoreController extends Controller
{
    public function index($store_name,Request $request){
        $admin =admin::where('id','=',session('LoggedAdmin'))->first();
        $stores1 = Store::where('store_name','=',$store_name)->first();
        $request->session()->put('store_name1',$stores1->store_name);
        $stores =Store::where('store_name','=',$store_name)->first();
        $data =[
            'LoggedAdminInfo'=>$admin,
            'Store'=>$stores,
            'storeid'=>$stores1
        ];
        return view('store.admin.mystore',$data);
    }

    public function products($store_name){
        $admin =admin::where('id','=',session('LoggedAdmin'))->first();

        $stores =Store::where('store_name','=',$store_name)->first();
        $data =[
            'LoggedAdminInfo'=>$admin,
            'Store'=>$stores
        ];
        return view('store.admin.products',$data);
    }
    public function new_product($store_name){
        $admin =admin::where('id','=',session('LoggedAdmin'))->first();

        $stores =Store::where('store_name','=',$store_name)->first();
        $data =[
            'LoggedAdminInfo'=>$admin,
            'Store'=>$stores
        ];
        return view('store.admin.add_product',$data);
    }

        public function create (Request $request){
            $admin =admin::where('id','=',session('LoggedAdmin'))->first();

            $stores =Store::where('store_name','=',$store_name)->first();
                if ($request->hasFile('avatar')){
                    $file =$request->file('avatar');
                    $filename =$file->getClientOriginalName();
                    $folder = uniqid().'-'.now()->timestamp;
                    $file->storeAs('avatars/'.$stores->ID,$filename);
                    return $folder;
                }
                
                // Image::make(storage_path(path:'app/public/avatars'.$stores->ID.'/'.$filename))
                // ->fit(50,50)
                // ->save(storage_path(path:'app/public/avatars'.$stores->ID.'/thumb-'.$filename))
                // $stores->update([
                //     'avatar'=>filename,
                // ])
        }

        public function userindex ($store_name,Request $request){
            $admin =admin::where('id','=',session('LoggedAdmin'))->first();
            $stores =Store::where('store_name','=',$store_name)->first();
            // $products = products::where('store_id','=',$stores->ID);
            // dd($products);
            $data =[
                'LoggedAdminInfo'=>$admin,
                'Store'=>$stores,
                // 'Products' =>$products,                
            ];
            
            return view('store.user.index',$data);

        }

        public function product_details ($store_name,$product_id,Request $request){
            $admin =admin::where('id','=',session('LoggedAdmin'))->first();
            $stores =Store::where('store_name','=',$store_name)->first();
            $products = products::where('product_id','=',$product_id);
            // dd($products);
            $data =[
                'LoggedAdminInfo'=>$admin,
                'Store'=>$stores,
                'Product_id' =>$product_id,  
                              
            ];
            
            return view('store.user.product_details',$data);

        }

        public function cart ($store_name,Request $request){
            $user =User::where('id','=',session('LoggedUser'))->first();
            // dd($user);
            $stores =Store::where('store_name','=',$store_name)->first();
            // $carts =Cart::where('user_id','=',$user->id);
            $data =[
                'LoggedUserInfo'=>$user,
                'Store'=>$stores,
                              
            ];
            
            return view('store.user.cart',$data);

        }

        public function add ($store_name,$product_id){
            $user =User::where('id','=',session('LoggedUser'))->first();
            $stores =Store::where('store_name','=',$store_name)->first();
            $carts = DB::table('carts')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->join('cart_details', 'cart_details.cart_id', '=', 'carts.cart_id')
            ->join('products', 'cart_details.product_id', '=', 'products.product_id')
            ->Where ('users.id',$user->id)
            ->Where ('products.product_id',$product_id)
            ->count();
            // dd($carts);
            if (!$carts){
                $cart_id =DB::table('carts')->insertGetId([

                    'user_id' => $user->id ,
                    'store_id' =>$stores->id,
                ]);
                DB::table('cart_details')->insert([ 
    
                    'cart_id' => $cart_id,
                    'product_id' => $product_id,
                    'item_quantity' => '1',
    
                    
                ]);
                return back()->with('success','Succesful add to cart');
            }


            return back()->with('fail','Already added!');
        }

        public function update ($store_name,$cartdetail_id,Request $request){
            $user =User::where('id','=',session('LoggedUser'))->first();

            // DB::update('update from cart_details where cartdetails_id = ?',[$cartdetail_id]);
            $affected = DB::table('cart_details')
              ->where('cart_id', $cartdetail_id)
              ->update(['item_quantity' => $request->quantity]);

            return back();
        }

        public function destroy ($store_name,$cartdetail_id){
            $user =User::where('id','=',session('LoggedUser'))->first();
            // dd($user);
            $stores =Store::where('store_name','=',$store_name)->first();
            // $products = products::where('cartdetails_id','=',$cartdetail_id);
            // $carts = DB::table('cart_details')
            // ->remove ($cartdetail_id);
            DB::delete('delete from carts where cart_id = ?',[$cartdetail_id]);
            DB::delete('delete from cart_details where cart_id = ?',[$cartdetail_id]);

            // dd($carts);
            return back();
        }

        public function checkout ($store_name){
            $user =User::where('id','=',session('LoggedUser'))->first();
            // dd($user);
            $store =Store::where('store_name','=',$store_name)->first();
            // $cart = Cart::where('user_id','=',$user->id)->first();
            $cart = DB::table('carts')
            ->join('cart_details', 'cart_details.cart_id', '=', 'carts.cart_id')
            ->join('products', 'cart_details.product_id', '=', 'products.product_id')
            ->Where ('carts.user_id',$user->id)
            ->get();

            // dd($store->id);

            // $cart = Cart::all();
            $totalAmount = 0;
            foreach ($cart as $item) {
                $totalAmount += $item->price * $item->item_quantity;
            }
            $order = new Order();
            $order->user_id = $user->id;
            $order->store_id = $store->id;
            $order->amount = $totalAmount;
            $order->save();
            // $data = [];
            
                

            foreach ($cart as $item) {

                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->product_id;
                $orderItem->quantity = $item->item_quantity;
                $orderItem->amount = $item->price;
                $orderItem->save();

                DB::table('cart_details')
                ->where('cart_id',$item->cart_id)
                ->delete();
            }
            DB::table('carts')
            ->where('user_id',$user->id)
            ->where('store_id',$store->id)
            ->delete();

            return redirect()->route('cart.invoice', [$store_name,'id'=>$order->id]);

        }


        public function order ($store_name,Request $request){
            $admin =admin::where('id','=',session('LoggedAdmin'))->first();
            $stores =Store::where('store_name','=',$store_name)->first();
            // dd($store_name);
            $data =[
                'LoggedAdminInfo'=>$admin,
                'Store'=>$stores,
            ];
            
            return view('store.admin.order',$data);

        }
        public function invoice ($store_name,$orders){
            $admin =admin::where('id','=',session('LoggedAdmin'))->first();
            // $stores =Store::where('store_name','=',$store_name)->first();
            // dd($store_name);
            // dd($orders);
            $data =[
                'LoggedAdminInfo'=>$admin,
                // 'Store'=>$stores,
                'Orders'=>$orders
            ];
            
            return view('store.user.invoice',$data);

        }

        public function order_details ($store_name,$orders){
            $admin =admin::where('id','=',session('LoggedAdmin'))->first();
            $stores =Store::where('store_name','=',$store_name)->first();

            $data =[
                'LoggedAdminInfo'=>$admin,
                'Store'=>$stores,
                'Orders'=>$orders
            ];
            
            return view('store.admin.order_details',$data);

        }
}
