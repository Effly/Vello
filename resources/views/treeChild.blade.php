<ul>
    @foreach($categories as $category)

        <li>
            <a href="{{ route('catalog.third',['categorySlug'=>$prev_id,
                                                'subcategorySlug' => $subSlug,
                                                 'thirdcategorySlug' => $category->slug,])}}">{{ $category->name }}</a>
            {{--            получаю слаг первой второй, а по последней третьей--}}
        </li>
        @if($category->ProductCategory->count() > 0)
            @include('treeChild', ['categories' => $category->ProductCategory])
        @endif
    @endforeach
</ul>

