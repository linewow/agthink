<?php

namespace agthink\auth;

use agthink\auth\command\InitCommand;
use agthink\auth\command\RouteCommand;
use agthink\auth\command\TableCommand;
use think\facade\Console;

class Service extends \think\Service
{
    public function boot()
    {
        $this->commands([
            RouteCommand::class,
            InitCommand::class,
            TableCommand::class
        ]);
    }
}