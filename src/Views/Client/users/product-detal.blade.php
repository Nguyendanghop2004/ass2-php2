<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href=" <?= $_ENV['BASE_URL'] ?>assets/css/style1.css ">
    {{-- <link rel="stylesheet" href=" {{asset('assets/css/style1.css')}} ">; --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <h1 class=" mt-5 ">Welcome {{ $name }} to my website!</h1>

    @if (isset($_SESSION['user']))
        <a class="btn btn-primary" href="{{ url('client/users/logout') }}">logout</a>
    @endif

    @if (!isset($_SESSION['user']))
        <a class="btn btn-primary" href="{{ url('client/users/login') }}">login</a>
    @endif
    <div class="row mt-5">


        <div class="col-md-4 mb-2 mt-2">
            <div class="card">
                <img class="card-img-top" style="max-height:200px" src="{{ asset($products['img_thumbnail']) }}"
                    alt="Card image">
                <div class="card-body">
                    <h4 class="card-title">{{ $products['name'] }}</h4>
                    {{-- <p class="card-text">{{ $products['content'] }}</p> --}}
                    <form action="{{url('client/users/cart/add')}}" method="get">
                        <input type="hidden" name="productID" value="{{$products['id']}}">
                        <input type="number" min="1" name=quantity value="1">
                        <button type="submit"> Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
        </div>


    </div>

</body>

</html>
