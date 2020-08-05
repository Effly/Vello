@extends('layouts.layout')
@extends('admin.master')

    <div class="starter-template">
    <h1>Корзина</h1>

    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Название</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Стоимость</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products as $product)
                <tr>
                    <td>
                        <a href="">
                            <img height="56px" src="https://via.placeholder.com/150">
                            {{$product->name}}
                        </a>
                    </td>
                    <td><span class="badge">{{$product->pivot->count}}</span>
                        <div class="btn-group form-inline">
                            <form action="{{ route('basket-remove',$product) }}" method="POST">
                                <button type="submit" class="btn btn-danger" href=""><span
                                        class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>

                                @csrf
                            </form>

                            <form action="{{ route('basket-add',$product) }}" method="POST">
                                <button type="submit" class="btn btn-success"
                                        href=""><span
                                        class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                @csrf
                            </form>
                        </div>
                    </td>
                    <td>{{ $product->cost }} ₽</td>
                    <td>{{ $product->getPriceForCount() }} ₽</td>

                </tr>
            @endforeach

            <tr>
                <td colspan="3">Общая стоимость:</td>
                <td>{{ $order->getFullPrice() }} ₽</td>
            </tr>
            </tbody>
        </table>
        <br>
        <div class="btn-group pull-right" role="group">
            <a type="button" class="btn btn-success" href="{{route('basket-place')}}">Оформить заказ</a>
        </div>
    </div>
    </div>
