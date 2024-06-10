<?php

namespace Acer\XuongOop\Models;

use Acer\XuongOop\Commons\Model;

class  CartDetail  extends Model
{
    protected string $tableName = 'cart_details';
  
public function  finByproductID($cartID,$productID){
    return $this->queryBuilder
        ->select('*')
        ->from($this->tableName)
        ->where('cart_id = ?')->setParameter(0, $cartID)
        ->where('product_id = ?')->setParameter(1, $productID)
        ->fetchAssociative();
    
}
public function  deletecartDetail($cartID)  {
    return $this->queryBuilder
    ->delete($this->tableName)
    ->where('cart_id = ? ')->setParameter(0, $cartID)
    ->executeQuery();
}

}