<?php
/* === STEP-4 ココから === */
require_once '/opt/work/3_dump-autoload/vendor/autoload.php';

$eagerLoadFiles = require '/opt/work/3_dump-autoload/vendor/autoload_files.php';
foreach ($eagerLoadFiles as $file) {
    require_once $file;
}

$psr4ClassLoader = new Psr4ClassLoader('/opt/work/3_dump-autoload/vendor/autoload_classmap_psr4.php');
spl_autoload_register([$psr4ClassLoader, 'loadClass']);
/* === STEP-4 ココまで === */