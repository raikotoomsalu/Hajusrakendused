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

            <table id="cart" class="table table-bordered table-hover table-condensed mt-3">
            <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                </tr>
            </thead>
            <tbody>

                <?php $total = 0 ?>

                @if(session('cart'))
                @foreach(session('cart') as $id => $details)

                <?php $total += $details['price'] * $details['quantity'] ?>

                <tr>
                    <td data-th="Product">
                        <div class="row">

                            <div class="col-sm-9">
                                <p class="nomargin">{{ $details['name'] }}</p>
                                <p class="remove-from-cart cart-delete" data-id="{{ $id }}" title="Delete">Remove</p>
                            </div>
                        </div>
                    </td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                </tr>

                @endforeach
                @endif

            </tbody>
            <tfoot>
                @if(!empty($details))
                <tr class="visible-xs">
                    <td class="text-right" colspan="2"><strong>Total</strong></td>
                    <td class="text-center"> ${{ $total }}</td>
                </tr>
                @else
                <tr>
                    <td class="text-center" colspan="3">Your Cart is Empty.....</td>
                <tr>
                    @endif
            </tfoot>

            </table>
            <a href="{{ url('http://127.0.0.1:8000/dashboard') }}" class="btn shopping-btn">Home</a>
            <!-- <a href="" class="btn btn-warning check-btn">Proceed Checkout</a> -->
                <a href="{{ route('stripe.checkout') }}" class="btn btn-primary check-btn">Proceed checkout</a>
            <div class="container products">
                <div class="row">

                    @foreach($products as $product)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="card mb-4">
                            <img src="{{ $product->photo }}" class="card-img-top img-size" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit(strtolower($product->description), 50) }}
                                </p>
                                <p class="card-text"><strong>Price: </strong> ${{ $product->price }}</p>
                                <a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <script>
                $(".remove-from-cart").click(function(e) {
                    e.preventDefault();

                    var ele = $(this);

                    if (confirm("Are you sure want to remove product from the cart.")) {
                        $.ajax({
                            url: '{{ url("remove-from-cart") }}',
                            method: "DELETE",
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: ele.attr("data-id")
                            },
                            success: function(response) {
                                window.location.reload();
                            }
                        });
                    }
                });
            </script>
    </body>
</html>





