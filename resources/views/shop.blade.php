<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body class="font-sans antialiased ">
        <div class="container mt-5">
        <h2>Product Gallery</h2>
        </div>

        <div class="container products">
            <div class="row">
                @if(!empty($products)) @foreach($products as $product)
                <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card mb-4">
                    <img
                    src="{{ $product->photo }}"
                    class="card-img-top img-size"
                    alt="{{ $product->name }}"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit(strtolower($product->description),
                            50) }}
                        </p>
                        <p class="card-text"> 
                            <strong>Price: </strong> ${{ $product->price }}
                        </p>
                        <a
                            href="javascript:void(0);"
                            data-product-id="{{ $product->id }}"
                            id="add-cart-btn-{{ $product->id }}"
                            class="btn btn-warning btn-block text-center add-cart-btn add-to-cart-button"
                            > Add to cart </a>
                        <span   id="adding-cart-{{ $product->id }}"
                                class="btn btn-warning btn-block text-center added-msg"
                                style="display: none"> Added. </span>
                    </div>
                </div>
                </div>
                @endforeach @endif
            </div>
        </div>
    <script>
        $(document).ready(function () {
            $('.add-to-cart-button').on('click', function () {
                var productId = $(this).data('product-id');

                $.ajax({
                    type: 'GET',
                    url: '/add-to-cart/' + productId,
                    success: function (data) {
                        $("#adding-cart-" + productId).show();
                        $("#add-cart-btn-" + productId).hide();
                    },
                    error: function (error) {
                        console.error('Error adding to cart:', error);
                    }
                });
            });
        });
    </script>
    
</body>
</html>





