<?php

namespace agthink\auth\command;

use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\facade\Console;

class RouteCommand extends \think\console\Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('auth:route')
            ->setDescription('Generate Routing File');
    }

    protected function execute(Input $input, Output $output)
    {
        $route_path  = app()->config->get('auth.default_route');
        if(empty($route_path)){
            $output->writeln('Please run php think auth:config or modify Configuration Item');
            return;
        }
        $targetPath = app()->getAppPath().DIRECTORY_SEPARATOR.$route_path;
        if (!file_exists($targetPath)) {
            $output->writeln('Please check whether the routing configuration file exists');
            return;
        }
        $content = file_get_contents(__DIR__.'/../route.php');
        file_put_contents($targetPath , PHP_EOL.$content , FILE_APPEND);

        $output->writeln('Publish Successfully');
    }
}