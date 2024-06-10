<?php

namespace Acer\XuongOop\Controllsers\Admin;

use Acer\XuongOop\Commons\Controller;
use Acer\XuongOop\Commons\Helper;
use Acer\XuongOop\Models\Product;
use Rakit\Validation\Validator;

class ProductsController extends Controller
{
    private Product $produt;

    public function  __construct()
    {
        $this->produt = new Product();
    }


    public function index()
    {

        // $this ->produt ->insert([
        //     'name' => 'nguyen dang hop',
        //     'email' => 'hopndph41769@fpt.edu.vn',
        //     'password'=> password_hash('123456' ,PASSWORD_DEFAULT),
        // ]);
        // die;
        //    Helper ::debug($this ->produt->all()); 
        [$produt, $totalPage] = $this->produt->paginate($_GET['page'] ?? 1);

        // $product =$this ->produt ->all();
        // Helper ::debug($this ->produt->all()); 
        $this->renderViewAdmin('products.index', [
            'produts' => $produt,
            'totalPage' => $totalPage

        ]);
        Helper ::debug( $totalPage);
        // echo __CLASS__.'@'.__FUNCTION__;

    }
    public function  create()
    {
        $this->renderViewAdmin('products.create');
    }
    public function  store()
    {

        $validator =  new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required|max:50',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'confirm_password'      => 'required|same:password',
            'avatar'                => 'uploaded_file:0,2M,png,jpeg,jpg',
        ]);
        $validation->validate();
        if ($validation->fails()) {
            // echo "chet";

            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            // Helper ::debug($errors);
            header('location:' . $_ENV['BASE_URL'] . 'admin/products/create');
            exit;
        } else {
            $data = [
                'name'                  => $_POST['name'],
                'email'                 => $_POST['email'],
                'password'              => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ];
            if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {
                $from = $_FILES['avatar']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['avatar']['name'];
                // move_uploaded_file($from, $to);
            }
            if (move_uploaded_file($from, $to)) {
                $data['avatar'] = $to;
            } else {
                $_SESSION['errors']['avatar'] = 'uploat khong thanh cong';

                header('location:' . $_ENV['BASE_URL'] . 'admin/products/create');
                exit;
            }
        }

        $this->produt->insert($data);
        $_SESSION['status'] = true;
        $_SESSION['lmg'] = 'them moi thanh cong';
        header('location:' . $_ENV['BASE_URL'] . 'admin/products');
        exit;
    }
    public function  show($id)
    {
        $product = $this->produt->finByID($id);
        // Helper ::debug($product);
        $this->renderViewAdmin('products.show', [
            'product' => $product
        ]);
    }
    public function  edit($id)
    {
        $product = $this->produt->finByID($id);
        $this->renderViewAdmin('products.edit', [
            'product' => $product
        ]);
    }
    public function  update($id)
    {
        $product = $this->produt->finByID($id);

        $validator =  new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required|max:50',
            'email'                 => 'required|email',
            'password'              => 'min:6',
            'avatar'                => 'uploaded_file:0,2M,png,jpeg,jpg',
        ]);
        $validation->validate();
        if ($validation->fails()) {
            // echo "chet";

            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            // Helper ::debug($errors);
            header('location:' . $_ENV['BASE_URL'] . "admin/products/{$product['id']}/edit");
            // header('location:' {asset("admin/products/{$product['id']}/edit")});
            exit;
        } else {
            $data = [
                'name'                  => $_POST['name'],
                'email'                 => $_POST['email'],
                'password'              => empty($_POST['password'])
                    ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $product['password'],
            ];
            $flagUloadt = false;
            if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {
                $flagUloadt = true;
                $from = $_FILES['avatar']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['avatar']['name'];
                // move_uploaded_file($from, $to);
            }
            if (move_uploaded_file($from, PATH_ROOT . $to)) {
                $data['avatar'] = $to;
            } else {
                $_SESSION['errors']['avatar'] = 'uploat khong thanh cong';

                header('location:' . $_ENV['BASE_URL'] . "admin/products/{$product['id']}/edit");

                exit;
            }
        }
        $de=$this->produt->update($id, $data);
        // Helper::debug(  $de);
        if (
            $flagUloadt
            && $product['avatar']
            && file_exists(PATH_ROOT . $product['avatar'])
        ) {
            unlink(PATH_ROOT . $product['avatar']);
        }

        $_SESSION['status'] = true;
        $_SESSION['lmg'] = 'uploat thanh cong';
        header('location:' . $_ENV['BASE_URL'] . "admin/products/{$product['id']}/edit");
        // header('location:' . $_ENV['BASE_URL'] . 'admin/products/create');
        exit;
    }

    public function  delete($id)
    {
        $product = $this->produt->finByID($id);
        $this->produt->delete($id);
        if (
            $product['avatar']
            && file_exists(PATH_ROOT . $product['avatar'])
        ) {
            unlink(PATH_ROOT . $product['avatar']);
        }
        header('location:' . $_ENV['BASE_URL'] . 'admin/products');

    }
}
