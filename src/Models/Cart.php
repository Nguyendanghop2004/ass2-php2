<?php

namespace Acer\XuongOop\Models;

use Acer\XuongOop\Commons\Model;

class  Cart  extends Model
{
    protected string $tableName = 'carts';
    public function  finByUserID($userID){
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('user_id = ?')->setParameter(0, $userID)
            ->fetchAssociative();
        
    }
}