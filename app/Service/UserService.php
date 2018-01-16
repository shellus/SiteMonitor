<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2018/1/16
 * Time: 14:44
 */

namespace App\Service;


use App\User;

class UserService
{
    /**
     * @param array $attributes
     * @return User
     */
    static public function createUser(array $attributes = []){
        \DB::beginTransaction();
        $user = User::create($attributes);
        $user->data()->create();
        \DB::commit();
        return $user;
    }
}