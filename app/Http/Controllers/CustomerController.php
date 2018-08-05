<?php

namespace App\Http\Controllers;

use App\Address;
use App\Attendance;
use App\Country;
use App\Item;
use App\Membership;
use App\Order;
use App\OrderItem;
use App\Rules\LettersOnly;
use App\Rules\PasswordMatch;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function showItemsInShop()
    {
        $items = Item::all();
        return view('shop', ['items' => $items]);
    }

    public function orderItem($id, $quantity)
    {
        //find selected item
        $item = Item::find($id);
        //find active order
        $activeOrder = Order::where('userID', Auth::user()->id)->whereNull('orderDate')->get();
        //if active order exists
        if ($activeOrder->first()) {
            $unfinishedOrder = $activeOrder[0];
        } else {
            //else create new order
            $unfinishedOrder = new Order();
            $unfinishedOrder->userID = Auth::user()->id;
        }
        $unfinishedOrder->save();
        $orderItems = OrderItem::where('orderID', $unfinishedOrder->id)->get();
        foreach ($orderItems as $orderItem) {
            //if items on order = selected item
            if ($orderItem->itemID == $id) {
                $orderItem->quantity = $orderItem->quantity + $quantity;
                $orderItem->save();
                return redirect('order');
            }
        }
        $orderItem = new OrderItem();
        $orderItem->orderID = $unfinishedOrder->id;
        $orderItem->itemID = $id;
        $orderItem->quantity = $quantity;
        $orderItem->save();
        return redirect('order');
    }

    public function newAddress()
    {
        return redirect('newAddress');
    }

    public function itemDetails($id)
    {
        $item = Item::find($id);
        return view('itemDetails', ['item' => $item]);
    }

    public function orderItemG($id)
    {
        return $this->orderItem($id, 1);
    }

    public function orderItemP(Request $request)
    {
        return $this->orderItem($request->id, $request->quantity);
    }

    public function currentOrder()
    {
        $activeOrder = Order::whereNull('orderDate')->where('userID', Auth::user()->id)->get();
        //if active order exists
        if ($activeOrder->first()) {
            $orderItems = OrderItem::where('orderID', $activeOrder[0]->id)->get();
            //if order has any items
            if ($orderItems->first())
                return view('currentOrder', ['orderItems' => $orderItems]);
        }
        return view('currentOrder', ['orderItems' => null]);
    }

    public function displayAddresses()
    {
        $addresses = Address::where('userID', Auth::user()->id)->get();
        $countries = Country::all();
        //if user has any addresses
        if ($addresses->first()) {

            return view('chooseAddress', ['addresses' => $addresses, 'countries' => $countries]);
        }
        return view('chooseAddress', ['addresses' => null, 'countries' => $countries]);
    }

    public function checkoutNewAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|min:3|max:50',
            'city' => 'required|string|min:3|max:50',
            'zip' => 'numeric|required',
            'country' => 'required|exists:countries,id'
        ]);
        //find active order
        $_order = Order::whereNull('orderDate')->where('userID', Auth::user()->id)->get();
        $order = $_order[0];
        //add new address
        $address = new Address();
        $address->userID = Auth::user()->id;
        $address->countryID = $request->country;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->ZIPCode = $request->zip;
        $address->save();
        $order->addressID = $address->id;
        $order->save();
        //redirect to paypal
        return Redirect::route('pay', ['id' => $order->id]);
    }

    public function checkout(Request $request){
        //find active order
        $_order = Order::whereNull('orderDate')->where('userID', Auth::user()->id)->get();
        $order = $_order[0];
        //change order address to selected address
        $order->addressID = $request->address;
        $order->save();
        return Redirect::route('pay',['id' => $order->id]);
    }

    public function profileDetails()
    {
        //get current user
        $user = Auth::user();
        //if user type = member
        if (Auth::user()->type == 'member') {
            $memberships = Membership::where('userID', Auth::user()->id)->orderBy('endDate', 'desc')->get();
            $activeMembership = $memberships[0];
            return view('profile', ['user' => $user, 'membership' => $activeMembership]);
        }
        return view('profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'firstName' => ['string', 'required', 'min:3', 'max:25', new LettersOnly()],
            'lastName' => ['string', 'required', 'min:3', 'max:25', new LettersOnly()],
            'birthDate' => 'date|required|before:today'
        ]);
        //update profile
        $user = Auth::user();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->birthDate = $request->birthDate;
        $user->save();
        return redirect('profile');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => ['required',new PasswordMatch()],
            'password' => 'required|min:6|string|confirmed'
        ]);
        //set new password
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('shop');
    }

    public function completedOrders(){
        $orders = Order::where('userID',Auth::user()->id)->get();
        //if there are any completed orders
        if ($orders->first()){
            return view('completedOrders' , ['orders' => $orders]);
        }
        return view('completedOrders',['orders' => null]);
    }

    public function deleteOrderItem($id){
        $orderItem = OrderItem::find($id);
        $orderItem->delete();
        return redirect('order');
    }
    public function attendance(){
        $user = Auth::user();
        $attendances = Attendance::where('userID',$user->id)->get();
        if ($attendances->first()){
            return view('memberAttendance',['attendances' => $attendances]);
        }
        return view('memberAttendance',['attendances' => null]);
    }

}
