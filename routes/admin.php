<?php

// $router->get('/admin', function () {
//     echo "Ahihi";
// });

// CRUD bao gồm: Danh sách, thêm, sửa, xem, xóa
// User:
//      GET     -> USER/INDEX   ->  INDEX         -> Danh sách
//      GET     -> USER/CREATE  ->  CREATE       -> HIỂN THỊ FORM THÊM MỚI
//      POST    -> USER/STORE   ->  STORE         -> LƯU DỮ LIỆU TỪ FORM THÊM MỚI VÀO DB
//      GET     -> USER/ID      ->  SHOW(ID)     -> XEM CHI TIẾT
//      GET     -> USER/ID/EDIT ->     EDIT(ID)             -> HIỂN THỊ FORM CẬP NHẬT
//      PUT     -> USER/ID      -> -> LƯU DỮ LIỆU TỪ FORM CẬP NHẬT VÀO DB
//      DELETE  -> USER/ID      -> -> XÓA BẢN GHI TRONG DB

// use Acer\XuongOop\Controlsers\Admin\UserController;



// $router->mount('/admin', function () use ($router) {

//     // CRUD USER
//     $router->mount('/users', function () use ($router) {
//         $router->get('/',           UserController::class . '@index');
//         $router->get('/create',     UserController::class . '@create');
//         $router->post('/store',     UserController::class . '@store');
//         $router->get('/{id}',       UserController::class . '@show');
//         $router->get('/{id}/edit',  UserController::class . '@edit');
//         $router->put('/{id}',       UserController::class . '@update');
//         $router->delete('/{id}',    UserController::class . '@delete');
//     });
// });
// $router ->get ('/admin' ,       UserController ::class .'@index');

// use Acer\XuongOop\Controlsers\Admin\UserController;

// $router ->get ('/admin/users/',  UserController :: class .'@index');

use Acer\XuongOop\Controllsers\Admin\DashboardController;
use Acer\XuongOop\Controllsers\Admin\UserController;
use Acer\XuongOop\Controllsers\Admin\ProductsController;

$router->mount('/admin', function () use ($router) {

    $router->get('/',               DashboardController::class . '@dashboard');
    $router->mount('/products', function () use ($router) {
        $router->get('/',              ProductsController::class . '@index');
        $router->get('/create',               UserController::class . '@create');
        $router->post('/store',               UserController::class . '@store');
        $router->get('/{id}/show',            UserController::class . '@show');
        $router->get('/{id}/edit',            UserController::class . '@edit');
        $router->post('/{id}/update',         UserController::class . '@update');
        $router->get('/{id}/delete',          UserController::class . '@delete');
    });
    // CRUD USER
    $router->mount('/users', function () use ($router) {
        $router->get('/',                     UserController::class . '@index');
        $router->get('/create',               UserController::class . '@create');
        $router->post('/store',               UserController::class . '@store');
        $router->get('/{id}/show',            UserController::class . '@show');
        $router->get('/{id}/edit',            UserController::class . '@edit');
        $router->post('/{id}/update',         UserController::class . '@update');
        $router->get('/{id}/delete',          UserController::class . '@delete');
    });
});
