<ul>
    @foreach($categories as $category)
        <li>{{ $category->name }}</li>
        @if($category->ProductCategory->count() > 0)
            @include('treeChildMenu', ['categories' => $category->ProductCategory])
        @endif
    @endforeach
</ul>
