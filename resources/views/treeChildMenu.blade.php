<ul>
    @foreach($categories as $category)

        <li>
            <a href="{{ route('catalog.sub',['categorySlug'=>$prev_id,
                                                'subcategorySlug' => $category->slug,
                                                 ])}}">{{ $category->name }}</a>
            {{--            получаю слаг первой второй, а по последней третьей--}}
        </li>
        @if($category->ProductCategory->count() > 0)
            @include('treeChild', ['categories' => $category->ProductCategory, 'subSlug'=>$category->slug])
        @endif
    @endforeach
</ul>

