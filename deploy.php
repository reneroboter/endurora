<?php

namespace Deployer;

use Deployer\Task\GroupTask;

require 'recipe/composer.php';
require 'contrib/rsync.php';
$config = require 'config.php';

host($config['host'])
    ->set('remote_user', $config['remote_user'])
    ->set('deploy_path', $config['deploy_path'])
    ->set('config_file', $config['config_file'])
    ->set('rsync_src', $config['rsync_src'])
    ->set('rsync_dest', '{{release_path}}');

/** @var GroupTask $deployPrepareTask */
$deployPrepareTask = task('deploy:prepare');

$tasks = [];
foreach ($deployPrepareTask->getGroup() as $key => $value) {
    $tasks[$key] = 'deploy:update_code' === $value ? 'rsync' : $value;
}

task('deploy:prepare', $tasks);

after('deploy:failed', 'deploy:unlock');
