<?php

// $router->get('/', function () {
//     echo "Trang chủ";
//             giới thiệu 
//              sản phẩm 
//              chi tiết sản phẩm
//              liên hệ
// });
//phương thức http method :
// để định nghĩa được, điều đầu tiên làm là phải tạo controller trước
// get để lấy giữ liệu
// póst taoj moi
// put 

// use Acer\XuongOop\Controllsers\Client\AboutController;
// use Acer\XuongOop\Controllsers\Client\ContactController;
// use Acer\XuongOop\Controllsers\Client\HomeController;
// use Acer\XuongOop\Controllsers\Client\ProductController;

// $router -> get('/',         HomeController::class. '@index');
// $router -> get('/about',    AboutController::class.'@index');


// $router -> get('/contact',    ContactController::class.'@index');
// $router -> post('/contact/store',   ContactController::class.'@store');

// $router -> post('/product',   ProductController::class.'@index');
// $router -> post('/product/{id}',   ProductController::class.'@detail');
// $router ->get ('/',function () {
//     echo 'trang chu';

// });

use Acer\XuongOop\Controllsers\Client\AboutController;
use Acer\XuongOop\Controllsers\Client\CartControllser;
use Acer\XuongOop\Controllsers\Client\ContactController;
use Acer\XuongOop\Controllsers\Client\DashboardController;
use Acer\XuongOop\Controllsers\Client\HomeController;
use Acer\XuongOop\Controllsers\Client\LoginControllser;
use Acer\XuongOop\Controllsers\Client\ProductController;

$router->before('GET|POST', '/admin/*.*', function () {
    if (!isset($_SESSION['user'])) {
        header('location: ' . url('login'));
        exit();
    }
});
$router->get('/',               DashboardController::class . '@dashboard');
$router->mount('/client', function () use ($router) {

    $router->get('/',    DashboardController::class . 'dashboard');
    $router->mount('/users', function () use ($router) {


        // $router->get('/',           HomeController::class . '@index');
        $router->get('/about',      AboutController::class . '@index');

        $router->get('/contact', ContactController::class . '@index');
        $router->post('/contact/store', ContactController::class . '@store');

        $router->get('/product/categories/{id}', ProductController::class . '@index');
        $router->get('/product/{id}', ProductController::class . '@detail');

        $router->get('/login',          LoginControllser::class . '@showFormLogin');
        $router->post('/handle-login',   LoginControllser::class . '@handleLogin');
        $router->get('/logout',          LoginControllser::class . '@logout');

        $router->get('cart/add',          CartControllser::class . '@add');
        $router->get('cart/quantytiInc',          CartControllser::class . '@quantytiInc');
        $router->get('cart/quantytiDec',          CartControllser::class . '@quantytiDec');
        $router->get('cart/add',          CartControllser::class . '@add');
        $router->get('cart/detail',          CartControllser::class . '@detail');
    });
});
