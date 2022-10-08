<?php

use agthink\auth\command\AuthCommand;
use think\Console;

Console::addDefaultCommands([
    AuthCommand::class
]);
