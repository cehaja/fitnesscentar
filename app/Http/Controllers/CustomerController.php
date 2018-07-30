<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function showItemsInShop(){
        $items = Item::all();
        return view('shop',['items' => $items]);
    }

    public function orderItem($id,$quantity){
        $item = Item::find($id);
        $activeOrder = Order::where('userID',Auth::user()->id)->whereNull('orderDate')->get();
        if ($activeOrder->first()){
            $unfinishedOrder = $activeOrder[0];
        }
        else{
            $unfinishedOrder = new Order();
            $unfinishedOrder->userID = Auth::user()->id;
        }
        $unfinishedOrder->save();
        $orderItems = OrderItem::where('orderID',$unfinishedOrder->id)->get();
        foreach ($orderItems as $orderItem){
            if ($orderItem->itemID == $id){
                $orderItem->quantity = $orderItem->quantity + $quantity;
                $orderItem->save();
                return redirect('shop');
            }
        }
        $orderItem = new OrderItem();
        $orderItem->orderID = $unfinishedOrder->id;
        $orderItem->itemID = $id;
        $orderItem->quantity = $quantity;
        $orderItem->save();
        return redirect('shop');
    }

    public function newAddress(){
        return redirect('newAddress');
    }

    public function itemDetails($id){
        $item = Item::find($id);
        return view('itemDetails',['item' => $item]);
    }

    public function orderItemG($id){
       return $this->orderItem($id,1);
    }

    public function orderItemP(Request $request){
       return $this->orderItem($request->id,$request->quantity);
    }

    public function currentOrder(){
        $activeOrder = Order::whereNull('orderDate')->get();
        if ($activeOrder->first()){
            $orderItems = OrderItem::where('orderID',$activeOrder[0]->id)->get();
            if($orderItems->first())
                return view('currentOrder',['orderItems' => $orderItems]);
        }
        return view('currentOrder',['orderItems' => null]);
    }
}
