@extends('layouts.layout')

@section('content')
<table class="table table-striped">
    <thead>
    <tr>
        <td>ID</td>
        <td>Название продукта</td>
        <td>Код</td>
        <td>Бренд</td>
        <td>Цена</td>
        <td>Модель</td>
        <td>Описание</td>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->title}}</td>
            <td>{{$product->code}}</td>
            <td>{{$product->brand}}</td>
            <td>{{$product->cost}}</td>
            <td>{{$product->model}}</td>
            <td>{{$product->desc}}</td>
            <td><a href="{{ route('shares.edit',$product->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('shares.destroy', $product->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
        {{ $products->links() }}
@endsection
