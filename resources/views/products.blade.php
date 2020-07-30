<h1>products</h1>

        @foreach($products as $product)
            <p>{{ $product->title}}</p>
        @endforeach

