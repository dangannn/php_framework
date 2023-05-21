<?php
namespace Models\Users;
use Models\ActiveRecordEntity;


class User extends ActiveRecordEntity{
    protected $nickname;
//    private $email;
//    private $isConfirmed;
//    private $role;
//    private $passwordHash;
//    private $authToken;
//    private $createdAt;

    public function getNickname(){
       return $this->nickname;
    }



    public static function getTableName(): string
    {
        return 'users';
    }

}
