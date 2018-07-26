@extends ("layouts.adminLayout")
@section('content')

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th >Image</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($itemsData as $item)
            <tr>
                <td><img src="{{asset('storage/itemImages/'.$item['image'])}}" style="height: 75px; height: 75px;"></td>
                <td>{{$item['name']}}</td>
                <td>{{$item['price']}}</td>
                <td>{{$item['category'].'( '.$item['subcategory'].' )'}}</td>
                <td><a href="{{route('editItem',['id' => $item['id']])}}">Edit</a></td>
                <td><a href="{{route('deleteItem',['id' => $item['id']])}}">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection