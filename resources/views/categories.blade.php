@extends('layouts.layout')

<h1></h1>
@foreach($rootCategories as $rootCategory)
    <li>
        <a href="{{ route('catalog',['categorySlug'=>$rootCategory->slug, ]) }}">
            {{ $rootCategory->name }}
        </a>
    </li>

@endforeach
