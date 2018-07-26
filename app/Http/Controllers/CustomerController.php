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

    public function orderItem($id){
        $item = Item::find($id);
        $order = Order::where('userID',Auth::user()->id)->whereNull('orderDate')->get();
        if ($order->first()){
           $unfinishedOrder = $order[0];
        }
        else{
            $unfinishedOrder = new Order();
            $unfinishedOrder->userID = Auth::user()->id;
        }
        $unfinishedOrder->save();
        $orderItems = OrderItem::where('orderID',$unfinishedOrder->id)->get();
        foreach ($orderItems as $orderItem){
            if ($orderItem->itemID == $id){
                $orderItem->quantity++;
                $orderItem->save();
                return redirect('shop');
            }
        }
        $orderItem = new OrderItem();
        $orderItem->orderID = $unfinishedOrder->id;
        $orderItem->itemID = $id;
        $orderItem->save();
        return redirect('shop');
    }

    public function newAddress(){
        return redirect('newAddress');
    }
}
