<?php

namespace Acer\XuongOop\Controllsers\Admin;

use Acer\XuongOop\Commons\Controller;


class DashboardController extends Controller
{
    public function   dashboard()  {
        $this->renderViewAdmin('dashboard');
    }
}