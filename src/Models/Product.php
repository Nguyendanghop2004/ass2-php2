<?php

namespace Acer\XuongOop\Models;

use Acer\XuongOop\Commons\Model;

class  Product  extends Model
{
    protected string $tableName = 'Products';
    public function  showDS($id)  {
        return $this->queryBuilder
        ->select('p.id','p.name','p.img_thumbnail','p.price_regular','p.price_sale','category_id ',
        'c.name as c_nam', 'c.id as c_id' )
        ->from($this->tableName,'p')
        ->join('p','categories','c','p.category_id=c.id' )
        ->where('category_id = ?')->setParameter(0, $id)
        ->fetchAllAssociative();
    }
}
