<nav class="navbar navbar-expand-lg navbar-white">
    <a class="navbar-brand order-1" href="index.html">
        <img class="img-fluid" width="100px" src="{{ asset('assets/client/images/logo.png') }}"
            alt="Reader | Hugo Personal Blog Template">
    </a>
    <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    danh muc <i class="ti-angle-down ml-1"></i>
                </a>
             
                    <div class="dropdown-menu">
                        @foreach ($categories as $item)
                        <tr>
                            <td>
                                <a class="dropdown-item" href="{{url('client/users/product/categories/'). $item['id'] }}">{{ $item['name'] }}</a>
                            </td>
                        </tr>
                        @endforeach

                    </div>
               


            <li class="nav-item">
                <a class="nav-link" href="shop.html">Shop</a>
            </li>

            <li>

                @if (isset($_SESSION['user']))
                    <a class="btn btn-primary" href="{{ url('client/users/logout') }}">logout</a>
                @endif
            </li>
            <li>
                @if (!isset($_SESSION['user']))
                    <a class="btn btn-primary" href="{{ url('client/users/login') }}">login</a>
                @endif
            </li>



        </ul>
    </div>


</nav>
