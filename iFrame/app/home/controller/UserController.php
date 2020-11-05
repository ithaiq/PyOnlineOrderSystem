<?php

namespace home\controller;

use core\Controller;
use home\model\UserModel;

/**
 * yong
 */
class UserController extends Controller
{
    public function index()
    {
        $model = new UserModel();
        if ($model->save(['name' => 'hello', 'password' => 'test'])) {
            $model->free();    //释放连接
            echo "Success";
        } else {
            $model->free();    //释放连接
            echo 'Failed';
        }
    }
}