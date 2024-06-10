<?php


namespace Acer\XuongOop\Controllsers\Client;


use Acer\XuongOop\Commons\Controller;
use Acer\XuongOop\Commons\Helper;
use Acer\XuongOop\Models\Cart;
use Acer\XuongOop\Models\CartDetail;
use Acer\XuongOop\Models\Product;

class CartControllser extends Controller
{
    private Product $product;
    private Cart $cart;
    private CartDetail $cartDetail;
    public function __construct()
    {
        $this->product = new Product();
        $this->cart = new Cart();
        $this->cartDetail = new CartDetail();
    }
    public function  add() //them 
    {
        //lấy thông tin sản phẩm thêm id 
        $product = $this->product->finByID($_GET['productID']);
        // khởi tạo SESSION CART  
        // check có đang đăng nhập hay không

        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }
        if (!isset($_SESSION[$key][$product['id']])) {

            $_SESSION[$key][$product['id']] = $product + ['quantity' => $_GET['quantity'] ?? 1];
        } else {
            $_SESSION[$key][$product['id']]['quantity'] += $_GET['quantity'];
        }
        // nếu mà đăng nhập thì phải lưu vào CSDL 
        // $product = $this->product->finByID($_GET['productID']);
        // Helper::debug($_SESSION);
        // Khởi tạo SESSION cart
        if (isset($_SESSION['user'])) {
            $conn = $this->cart->getConnection();
            // $conn->beginTransaction();
        //     try {
        //         $cart = $this->cart->finByUserID($_SESSION['user']['id']);
        //         if (empty($cart)) {
        //             $this->cart->insert([
        //                 'user_id' => $_SESSION['user']['id']
        //             ]);
        //         }


        //         $cartID = $cart['id'] ??  $conn->lastInsertId();
        //         $_SESSION['cart_id'] = $cartID;
        //         $this->cartDetail->deletecartDetail($cartID);
        //         foreach ($_SESSION[$key] as $productID => $item) {
        //             // $cartItem = $this->cartDetail->finByproductID($cartID, $productID);

        //             // if (empty($cartID)) {
        //             $this->cartDetail->insert([
        //                 'cart_id' => $cartID,
        //                 'product_id' => $productID,
        //                 'quantity' => $item['quantity']
        //             ]);
        //             //     } else {
        //             //         $this->cartDetail->update($cartItem['id'], [
        //             //             'quantity' => $item['quantity']
        //             //         ]);
        //             //     }
        //         }
        //         $conn->commit();
        //         // Helper::debug( $conn);
        //     } catch (\Throwable $th) {
        //         //throw $th;
        //         $conn->rollBack();
        //     }
        // }
        try {
         
            $cart = $this->cart->finByUserID($_SESSION['user']['id']);

            if (empty($cart)) {
                $this->cart->insert([
                    'user_id' => $_SESSION['user']['id']

                ]);
            }

            $cartID = $cart['id'] ?? $conn->lastInsertId();

            $_SESSION['cart_id'] = $cartID;

            $this->cartDetail->deletecartDetail($cartID);

            foreach ($_SESSION[$key] as $productID => $item) {
                $this->cartDetail->insert([
                    'cart_id' => $cartID,
                    'product_id' => $productID,
                    'quantity' => $item['quantity']
                ]);
            }

            // $conn->commit();
        } catch (\Throwable $th) {
            // echo $th->getMessage();die;
            //throw $th;
            // $conn->rollBack();
        }
    }

    header('Location: ' . url('client/users/cart/detail'));
    exit;

        // Helper::debug($_SESSION[$key] );
    }
    public function  quantytiInc($id) //them so luong
    {
    }
    public function  quantytiDec($id) //xoa item or xoa trang
    {
    }
    public function detail() //xoa item or xoa trang
    {
        $this->renderViewClient('users.cart');
    }
}
