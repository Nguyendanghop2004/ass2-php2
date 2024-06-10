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
        @if (!empty($_SESSION['cart']) || !empty($_SESSION['cart-' . $_SESSION['user']['id']]))
            <div class="col-md-12 mb-2 mt-2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                            <th>Thành tiền</th>
                            <th> xoa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cart = $_SESSION['cart'] ?? $_SESSION['cart-' . $_SESSION['user']['id']];
                        @endphp
                        @foreach ($cart as $item)
                            <tr>
                                <td> {{ $item['name'] }}</td>
                                <td>
                                    <img src="{{ asset($item['img_thumbnail']) }}" alt="">
                                </td>
                                <td> {{ $item['quantity'] }}</td>
                                <td> {{ $item['price_sale'] ?: $item['price_regular'] }} </td>
                                <td> {{ $item['quantity'] * ($item['price_regular'] ?: $item['price_sale']) }} </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif




    </div>
    {{-- <div class="row">
            @if (!empty($_SESSION['cart']) || !empty($_SESSION['cart-' . $_SESSION['user']['id']]))
                <div class="col-md-8 mb-2 mt-2">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá tiền</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $cart = $_SESSION['cart'] ?? $_SESSION['cart-' . $_SESSION['user']['id']];
                            @endphp
                            @foreach ($cart as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>
                                        <img src="{{ asset($item['img_thumbnail']) }}" width="100px" alt="">
                                    </td>
                                    <td>
                                        @php
                                            $url = url('cart/quantityDec') . '?productID=' . $item['id'];

                                            if (isset($_SESSION['cart-' . $_SESSION['user']['id']])) {
                                                $url .= '&cartID=' . $_SESSION['cart_id'];
                                            }
                                        @endphp
                                        <a class="btn btn-danger" href="{{ $url }}">Giảm</a>

                                        {{ $item['quantity'] }}

                                        @php
                                            $url = url('cart/quantityInc') . '?productID=' . $item['id'];

                                            if (isset($_SESSION['cart-' . $_SESSION['user']['id']])) {
                                                $url .= '&cartID=' . $_SESSION['cart_id'];
                                            }
                                        @endphp
                                        <a class="btn btn-primary" href="{{ $url }}">Tăng</a>
                                    </td>
                                    <td>
                                        {{ $item['price_sale'] ?: $item['price_regular'] }}
                                    </td>
                                    <td>
                                        {{ $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']) }}
                                    </td>
                                    <td>
                                        @php
                                            $url = url('cart/remove') . '?productID=' . $item['id'];

                                            if (isset($_SESSION['cart-' . $_SESSION['user']['id']])) {
                                                $url .= '&cartID=' . $_SESSION['cart_id'];
                                            }
                                        @endphp
                                        <a onclick="return confirm('Có chắn không?')"
                                            href="{{ $url }}">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

</body> --}}

</html>
