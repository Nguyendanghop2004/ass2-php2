@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="row">
    @foreach ($data as $product)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 rounded-0 text-center shadow-none overflow-hidden">
            <a href="#!">
                {{-- <span class="badge badge-primary">NEW</span> --}}
                <a href="{{ url('client/users/product/' . $product['id']) }}"><img class="card-img-top rounded-0"
                    style="max-height:200px" src="{{ asset($product['img_thumbnail']) }}" alt="Card image"></a>
                    
                <div class="card-body">
                    <a href="{{ url('client/users/product/' . $product['id']) }}">
                        <h4 class="text-uppercase mb-3">{{ $product['name'] }}</h4>
                    </a>
                    <p class="h4 text-muted font-weight-light mb-3">Lip Gloss</p>
                    <p class="h4">{{ $product['price_regular'] }}</p>
                    <a href="{{ url('client/users/cart/add') }}?quantity=1&productID={{ $product['id'] }}" 
                    class="btn btn-primary">Thêm vào giỏ hàng</a>
                </div>
            </a>
        </div>
    </div>
    @endforeach
   

    <div class="col-12 text-center mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item page-item active ">
                <a href="#!" class="page-link">1</a>
            </li>
            <li class="page-item">
                <a href="#!" class="page-link">2</a>
            </li>
            <li class="page-item">
                <a href="#!" class="page-link">&raquo;</a>
            </li>
        </ul>
    </div>
   

</div>
@endsection 