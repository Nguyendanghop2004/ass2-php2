<?php

namespace Acer\XuongOop\Controllsers\Client;

use Acer\XuongOop\Commons\Controller;
use Acer\XuongOop\Commons\Helper;
// use Acer\XuongOop\Commons\Helper;
use Acer\XuongOop\Models\User;

class LoginControllser extends Controller
{
    private User $user;
    public function  __construct()
    {
        $this->user = new User();
    }
    public function  showFormLogin()
    {
        auth_check();
        $this->renderViewClient('users.login');
    }
    public function  handleLogin()
    {
        auth_check();
        try {
            $user = $this->user->finByEmail($_POST['email']);
            if (empty($user)) {
                throw new \Exception("khong ton tai email" . $_POST['email']);
            }
            // header('location' .url('admin/'));
            $flag = password_verify($_POST['password'], $user['password']);
            if ($flag) {
                $_SESSION['user'] = $user;
                unset($_SESSION['cart']);
                // Helper ::debug($user);
                if ($user['type'] == 'admin') {
                    header('location:' . url('admin/'));
                    exit;
                }
                header('location:' . url('client/'));

                exit;
            }
            throw new \Exception('mat khau khong dung');
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
            header('location:' . url('admin/users/login'));
            exit;
        }
    }
    public function  logout()
    {
        unset($_SESSION['cart-' . $_SESSION['user']['id']]);
        unset($_SESSION['user']);
        header('location:' . url());
        exit;
    }
}
