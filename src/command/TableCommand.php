<?php
namespace agthink\auth\command;

use think\console\Input;
use think\console\Output;
use think\facade\Console;
use think\helper\Str;
use think\migration\Creator;

class TableCommand extends \think\console\Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('auth:table')
            ->setDescription('Create a migration for the think-auth');
    }

    protected function execute(Input $input, Output $output)
    {
        if (!app()->has('migration.creator')) {
            $this->output->error('Install think-migration first please');
            return;
        }
        $this->createMigration();
        $this->createSeeder();
    }

    public function createMigration(){
        $pathDir = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR;
        $settingPath = app()->getAppPath().'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'auth.php';
        $setting = app()->config->get('auth');
        if(!file_exists($settingPath)){
            $setting = require __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config.php';
        }
        $databasePath = app()->getAppPath().'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR;
        $table_name = [
            'menu'            => '20221001000001',
            'permission_menu' => '20221001000002',
            'permission'      => '20221001000003',
            'role_menu'       => '20221001000004',
            'role_permission' => '20221001000005',
            'role_user'       => '20221001000006',
            'role'            => '20221001000007',
            'user'            => '20221001000008',
        ];
        foreach ($setting['tables'] as $key => $table) {
            $contents = file_get_contents($pathDir.$key.'.stub');
            $className = Str::studly("create_{$table}_table");
            $path = $databasePath.$table_name[$key]."_create_{$table}_table.php";
            if(!file_exists($path)) {
                $contents = strtr($contents, [
                    '{{class}}' => $className,
                    '{{table}}' => $table,
                ]);
                file_put_contents($path, $contents);
            }
        }
        console::call('migrate:run');
        $this->output->info('Migration created successfully!');
    }

    public function createSeeder(){
        $databasePath = app()->getAppPath().'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'seeds'.DIRECTORY_SEPARATOR.'InitAuthData.php';
        if(!file_exists($databasePath)){
            $path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'seeds'.DIRECTORY_SEPARATOR.'init.stub';
            $contents = file_get_contents($path);
            file_put_contents($databasePath, $contents);
            console::call('seed:run');
        }
        $this->output->info('Default Seeder created successfully!');
    }
}