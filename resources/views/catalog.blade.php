<h1>Catalog</h1>
<ul>
    @foreach($rootCategories as $rootCategory)
        <li>{{ $rootCategory->name }}</li>
        @if($rootCategory->ProductCategory->count() > 0)
            @include('treeChildMenu', ['categories' => $rootCategory->ProductCategory])
        @endif
    @endforeach
</ul>
