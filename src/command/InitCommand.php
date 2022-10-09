<?php
/**
 * Created by PhpStorm
 * Desc: 功能描述
 * User: AG
 * Date: 2022/10/9 11:46
 */

namespace agthink\auth\command;

use think\console\Input;
use think\console\Output;

class InitCommand extends \think\console\Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('auth:config')
            ->setDescription('Create a config for the think-auth');
    }

    protected function execute(Input $input, Output $output)
    {
       $configFilePath = app()->getAppPath().'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'auth.php';
        if (is_file($configFilePath)) {
            $output->writeln('Config file is exist');
            return;
        }
        $res = copy(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.php', $configFilePath);
        if (strpos(\think\App::VERSION, '6.0') !== false) {
            $config = file_get_contents($configFilePath);
            $config = str_replace('Tp5', 'Tp6', $config);
            file_put_contents($configFilePath, $config);
        }
        if ($res) {
            $output->writeln('Create config file success:'.$configFilePath);
        } else {
            $output->writeln('Create config file error');
        }
    }
}