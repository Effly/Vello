@extends('layouts.layout')
@extends('')
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Редактирование продукта
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('shares.update', $product->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Название продукта:</label>
                    <input type="text" maxlength=150 class="form-control" name="title" value="{{ $product->title }}" />
                </div>
                <div class="form-group">
                    <label for="price">Цена:</label>
                    <input type="text" class="form-control" name="cost" value="{{ $product->cost }}" />
                </div>
                <div class="form-group">
                    <label for="code">Код:</label>
                    <input type="text" class="form-control" name="code" value="{{ $product->code }}" />
                </div>
                <div class="form-group">
                    <label for="brand">Бренд:</label>
                    <input type="text" class="form-control" name="brand" value="{{ $product->brand }}" />
                </div>
                <div class="form-group">
                    <label for="model">Модель:</label>
                    <input type="text" class="form-control" name="model" value="{{ $product->model }}" />
                </div>
                <div class="form-group">
                    <label for="desc">Описание:</label>
                    <input type="text" class="form-control" name="desc" value="{{ $product->desc }}" />
                </div>


                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
