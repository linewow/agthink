<?php
namespace agthink\auth\command;

use think\console\command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

/**
 * Created by PhpStorm
 * Desc: 功能描述
 * User: AG
 * Date: 2022/10/8 14:51
 */
class AuthCommand extends command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('auth:create')
            ->setDescription('the test command');
    }

    protected function execute(Input $input, Output $output)
    {
        // 指令输出
        $output->writeln('test');
    }
}