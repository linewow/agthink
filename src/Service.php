<?php
/**
 * Created by PhpStorm
 * Desc: 功能描述
 * User: AG
 * Date: 2022/10/8 15:01
 */

namespace agthink\auth;

use agthink\auth\command\InitCommand;
use agthink\auth\command\TableCommand;
use think\facade\Console;

class Service extends \think\Service
{
    public function boot()
    {
        $this->commands([
            InitCommand::class,
            TableCommand::class
        ]);
        Console::call('auth:config');
        Console::call('auth:table');
    }
}