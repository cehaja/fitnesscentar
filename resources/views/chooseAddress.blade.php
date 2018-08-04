@extends('layouts.mainLayout')
@section('content')
    <h3>Choose address</h3>

    @if($addresses != null)
        <form>
            @foreach($addresses as $address)
                <div class="form-check">
                    <input type="radio" value="{{$address->id}}" class="form-check-input" id="materialGroupExample1"
                           name="address">
                    <label class="form-check-label"
                           for="materialGroupExample1">{{$address->address.' '.$address->city.' '.$address->ZIPCode.' '.$address->country->name}}</label>
                </div>
            @endforeach
            <button class="btn-primary btn">Checkout</button>
        </form>
    @else
        <form action="{{route('checkout')}}" method="post">
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
    @endif
@endsection