<?php

namespace Acer\XuongOop\Controllsers\Client;

use Acer\XuongOop\Commons\Controller;
use Acer\XuongOop\Commons\Helper;
use Acer\XuongOop\Models\Product;
use Acer\XuongOop\Models\Users;

class HomeController extends Controller
{
    private Product $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function  index()
    {

        $name = 'hop';
        $products = $this->product->all();
        //    Helper ::debug( $poroducts);
        $this->renderViewClient('home', [
            'name' => $name,
            'products' => $products
        ]);
    }
}
