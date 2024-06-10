<?php

namespace Acer\XuongOop\Commons;

use eftec\bladeone\BladeOne;

class Controller
{
    protected function renderViewClient($view, $data=[])
    {
        $temlatePath = __DIR__ . '/../Views/Client';
        $compilePath = __DIR__ . '/../Views/Complies';
        $blade = new BladeOne($temlatePath, $compilePath);
        echo $blade->run($view, $data);
    }
    protected function renderViewAdmin($view, $data=[])
    {
        $temlatePath = __DIR__ . '/../Views/Admin';
        $compilePath = __DIR__ . '/../Views/Complies';
        $blade = new BladeOne($temlatePath, $compilePath);
        echo $blade->run($view, $data);
    }
    
}

