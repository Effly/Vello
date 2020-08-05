@extends('layouts.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Добавление товара
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <form method="post" action="{{ route('shares.store') }}">

                    <div class="form-group">
                    @csrf
                        <label for="name">Название продукта:</label>
                        <input type="text" class="form-control" name="title" />
                    </div>
                    <div class="form-group">

                        <label for="name">Категория продукта:</label>
                        <select name="category" id="category_id" class="form-control">
                            @foreach($rootCategories as $rootCategory)

                                    <option value="{{ $rootCategory->slug }}"

                                    >{{ $rootCategory->name }}</option>


                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="price">Цена:</label>
                        <input type="text" class="form-control" name="cost" />
                    </div>
                    <div class="form-group">
                        <label for="code">Код:</label>
                        <input type="text" class="form-control" name="code" />
                    </div>
                    <div class="form-group">
                        <label for="brand">Бренд:</label>
                        <input type="text" class="form-control" name="brand" />
                    </div>
                    <div class="form-group">
                        <label for="model">Модель:</label>
                        <input type="text" class="form-control" name="model" />
                    </div>
                    <div class="form-group">
                        <label for="desc">Описание:</label>
                        <input type="text" class="form-control" name="desc" />
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>

            </form>
        </div>
    </div>
@endsection
