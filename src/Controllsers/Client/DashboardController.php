<?php

namespace Acer\XuongOop\Controllsers\Client;

use Acer\XuongOop\Commons\Controller;
use Acer\XuongOop\Commons\Helper;
use Acer\XuongOop\Models\Categorie;
use Acer\XuongOop\Models\Product;
use Acer\XuongOop\Models\Users;

class DashboardController extends Controller
{
    private Product $product;
    private Categorie $categorie;
    public function __construct()
    {
        $this->product = new Product();
        $this->categorie =new Categorie();
    }
    public function  dashboard()
    {

        $name = 'hop';
        $products = $this->product->all();
        // $categories = $this->product->showDS();
        $categorie=$this->categorie->all();
        
        $this->renderViewClient('dashboard', [
            'name' => $name,
            'products' => $products,
            'categories' => $categorie
        ]);

        $categorie=$this->categorie->all();
    }
    
}
