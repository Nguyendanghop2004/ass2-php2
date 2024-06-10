<?php

namespace Acer\XuongOop\Models;
use Acer\XuongOop\Commons\Model;

     class  User  extends Model{
        protected string $tableName ='users';
        public function  finByEmail($email)
        {
            return $this->queryBuilder
                ->select('*')
                ->from($this->tableName)
                ->where('email = ?')->setParameter(0, $email)
                ->fetchAssociative();
        }
      
     }
?>