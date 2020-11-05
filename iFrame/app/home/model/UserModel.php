<?php

namespace home\model;

use core\Model;

/**
 *     UserModel
 */
class UserModel extends Model
{
    function __construct()
    {
        parent::__construct('user');
    }
}