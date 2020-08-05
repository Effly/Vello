@extends('layouts.layout')

  @foreach($product as $good)
    <div class="starter-template">

        <h1>{{ $good->title }}</h1>


        <p>Цена: <b>{{ $good->cost }}</b></p>
        <img src="https://via.placeholder.com/150">
        <p>{{ $good->code }}</p>
        <p>{{ $good->model }}</p>
        <p>{{ $good->desc }}</p>

        <form action="{{ route('basket-add',$good) }}" method="POST">
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
        @csrf

        </form>

    </div>
  @endforeach
