@extends('layouts.layout')

<h1>products</h1>
<form method="GET" action="{{route('catalog.third',['categorySlug'=>Route::current()->categorySlug,
                                                'subcategorySlug' => Route::current()->subcategorySlug,
                                                 'thirdcategorySlug' => Route::current()->thirdcategorySlug,])}}">
    <div class="filters row">
        <div class="col-sm-6 col-md-3">
            <label for="price_from">Цена от <input type="text" name="price_from" id="price_from" size="6" value="">
            </label>
            <label for="price_to">до<input type="text" name="price_to" id="price_to" size="6"  value="">
            </label>
        </div>
        <div class="col-sm-6 col-md-3">
            <button type="submit" class="btn btn-primary">Фильтр</button>
            <a href="" class="btn btn-warning">Сброс</a>
        </div>
        <div >
        @foreach($properties as $property)
        <div class="col-sm-6 col-md-6">
            <label for="brand">
                <input type="checkbox" name="{{$property->brand}}" id="brand" > {{$property->brand}} </label>
        </div>
        @endforeach
        </div>
    </div>
</form>
        @foreach($products as $product)

            <div class="caption">
                <h3>{{ $product->title }}</h3>
                @if($product->cost != 0)
                <p>{{ $product->cost  }} ₽</p>
                @else
                    <p>Уточните цену у менеджера</p>
                @endif
                <p>{{ $product->brand }} </p>
                <p>
                <form action="{{ route('basket-add',$product) }}" method="POST">
                    <button type="submit" class="btn btn-primary" role="button">В корзину</button>

                    <a href="{{ route('product',$product->slug) }}"
                       class="btn btn-default"
                       role="button">Подробнее</a>

                    @csrf
                </form>
                </p>
            </div>
        @endforeach

