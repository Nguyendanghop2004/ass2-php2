<?php


namespace Acer\XuongOop\Controllsers\Client;


use Acer\XuongOop\Commons\Controller;
use Acer\XuongOop\Commons\Helper;
use Acer\XuongOop\Models\Product;

class ProductController extends Controller
{
    private Product $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function  index($id)
    {
       $data=$this->product->showDS($id);
    //    Helper::debug($data);
    $this->renderViewClient('users.categorieProduct',[
        'data'=>$data
    ]);
    }
    public function  detail($id)
    {
        $product = $this->product->finByID($id);
        $this->renderViewClient('users.product-detal', [
            'products' => $product
        ]);
    }
}
