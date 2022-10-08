<?php

namespace agthink\auth\facade;

use think\Facade;

class Auth extends Facade
{
   protected static function getFacadeClass()
   {
       return 'agthink\auth\Auth';
   }
}