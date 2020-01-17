<?php

namespace Deployer;

require 'recipe/common.php';

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

// Project name
set('application', 'PHP CI');

// Project repository
set('repository', 'git@github.com:rafaeldemeirateixeira/ci.git');

// Stage default
set('default_stage', 'prod');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', []);

option('vendors', null, InputOption::VALUE_OPTIONAL, 'Composer install.');

// Hosts
host('production')
    ->hostname('deploy@criare.ml')
    ->port(22)
    ->stage('prod')
    ->set('keep_releases', 6)
    ->set('branch', 'master')
    ->set('deploy_path', '/var/www/phpocr');

task('vendors', function () {
    if (!commandExist('unzip')) {
        writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
    }

    if (input()->hasOption('vendors')) {
        $vendors = input()->getOption('vendors');
        if ($vendors == 'install') {
            run('cd {{release_path}} && {{bin/composer}} {{composer_options}}');
        }
    }
});

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'vendors',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
])->desc('Deploy your project');

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
after('deploy', 'success');
