@extends('layouts.mainLayout')
@section('content')
    <h3>Choose address</h3>

    @if($addresses != null)
        <div id="form1">
            <form action="{{route('checkout')}}" method="post">
                {{csrf_field()}}
                @foreach($addresses as $address)
                    <div class="form-check">
                        <input type="radio" value="{{$address->id}}" class="form-check-input" id="address"
                               name="address">
                        <label class="form-check-label"
                               for="address">{{$address->address.' '.$address->city.' '.$address->ZIPCode.' '.$address->country->name}}</label>
                    </div>
                @endforeach
                <button class="btn-primary btn">Checkout</button>
            </form>
            <button type="button" id="btn" class="btn-primary btn" style="margin-top: 20px;">New address</button>
        </div>
    @endif
<div  id="form2" @if($addresses != null) style="display: none" @endif>
    <form action="{{route('checkoutNewAddress')}}" method="post" >
        {{csrf_field()}}
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control col-md-6" id="address" name="address"
                   placeholder="Enter address">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>

            <div class="form-group col-md-4">
                <label for="country">Country</label>
                <select id="country" name="country" class="form-control">
                    @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zip">
            </div>
        </div>
        <button class="btn-primary btn">Checkout</button>
    </form>
</div>
    <script src="{{asset('js/chooseAddress.js')}}"></script>
@endsection