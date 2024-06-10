<?php

namespace Acer\XuongOop\Controllsers\Admin;

use Acer\XuongOop\Commons\Controller;
use Acer\XuongOop\Commons\Helper;
use Acer\XuongOop\Models\User;
use Rakit\Validation\Validator;

class UserController extends Controller
{
    private User $user;

    public function  __construct()
    {
        $this->user = new User ();
    }


    public function index()
    {

        // $this ->user ->insert([
        //     'name' => 'nguyen dang hop',
        //     'email' => 'hopndph41769@fpt.edu.vn',
        //     'password'=> password_hash('123456' ,PASSWORD_DEFAULT),
        // ]);
        // die;
        //    Helper ::debug($this ->user->all()); 
        [$user, $totalPage] = $this->user->paginate($_GET['page'] ?? 1);

        // $user =$this ->user ->all();
        // Helper ::debug($this ->user->all()); 
        $this->renderViewAdmin('users.index', [
            'user' => $user,
            'totalPage' => $totalPage

        ]);
        // Helper ::debug( $totalPage);
        // echo __CLASS__.'@'.__FUNCTION__;

    }
    public function  create()
    {
        $this->renderViewAdmin('users.create');
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
            header('location:' . $_ENV['BASE_URL'] . 'admin/users/create');
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

                header('location:' . $_ENV['BASE_URL'] . 'admin/users/create');
                exit;
            }
        }

        $this->user->insert($data);
        $_SESSION['status'] = true;
        $_SESSION['lmg'] = 'them moi thanh cong';
        header('location:' . $_ENV['BASE_URL'] . 'admin/users');
        exit;
    }
    public function  show($id)
    {
        $user = $this->user->finByID($id);
        // Helper ::debug($user);
        $this->renderViewAdmin('users.show', [
            'user' => $user
        ]);
    }
    public function  edit($id)
    {
        $user = $this->user->finByID($id);
        $this->renderViewAdmin('users.edit', [
            'user' => $user
        ]);
    }
    public function  update($id)
    {
        $user = $this->user->finByID($id);

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
            header('location:' . $_ENV['BASE_URL'] . "admin/users/{$user['id']}/edit");
            // header('location:' {asset("admin/users/{$user['id']}/edit")});
            exit;
        } else {
            $data = [
                'name'                  => $_POST['name'],
                'email'                 => $_POST['email'],
                'password'              => empty($_POST['password'])
                    ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'],
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

                header('location:' . $_ENV['BASE_URL'] . "admin/users/{$user['id']}/edit");

                exit;
            }
        }
        $de=$this->user->update($id, $data);
        // Helper::debug(  $de);
        if (
            $flagUloadt
            && $user['avatar']
            && file_exists(PATH_ROOT . $user['avatar'])
        ) {
            unlink(PATH_ROOT . $user['avatar']);
        }

        $_SESSION['status'] = true;
        $_SESSION['lmg'] = 'uploat thanh cong';
        header('location:' . $_ENV['BASE_URL'] . "admin/users/{$user['id']}/edit");
        // header('location:' . $_ENV['BASE_URL'] . 'admin/users/create');
        exit;
    }

    public function  delete($id)
    {
        $user = $this->user->finByID($id);
        $this->user->delete($id);
        if (
            $user['avatar']
            && file_exists(PATH_ROOT . $user['avatar'])
        ) {
            unlink(PATH_ROOT . $user['avatar']);
        }
        header('location:' . $_ENV['BASE_URL'] . 'admin/users');

    }
}
