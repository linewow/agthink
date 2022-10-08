<?php
/**
 * Created by PhpStorm
 * Desc: 功能描述
 * User: AG
 * Date: 2022/10/8 15:01
 */

namespace agthink\auth;

use agthink\auth\command\AuthCommand;

class Service extends \think\Service
{
    public function boot()
    {
        $this->commands(AuthCommand::class);
    }
}