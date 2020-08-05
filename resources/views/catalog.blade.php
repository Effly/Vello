@extends('layouts.layout')
<h1>Catalog</h1>

@if(session()->has('success'))
<p class="alert alert-success"> {{session()->get('success')}} </p>
@endif
<ul>
    @foreach($rootCategories as $rootCategory)
        <li>
            <a href="{{ route('catalog',['categorySlug'=>$rootCategory->slug]) }}">
                {{ $rootCategory->name }}
            </a>
        </li>
        @if($rootCategory->ProductCategory->count() > 0)
            @include('treeChildMenu', ['categories' => $rootCategory->ProductCategory, 'prev_id' =>$rootCategory->slug ])
        @endif
    @endforeach
</ul>
