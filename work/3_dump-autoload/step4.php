<?php
$help = <<<'HELPTEXT'
Autoloaderの作成
HELPTEXT;

processDumpAutoload(__DIR__ . '/vendor'); // この内部で `procedure3_1` が呼ばれます

function procedure3_4(
    string $vendorDirPath,
    string $psr4ClassMapPath,
    string $eagerLoadFilesPath,
    string $psr4ClassLoaderPath,
): void
{
    $autoloaderScript = <<<CODE
<?php
/* === STEP-4 ココから === */
require_once '{$psr4ClassLoaderPath}';

\$eagerLoadFiles = require '{$eagerLoadFilesPath}';
foreach (\$eagerLoadFiles as \$file) {
    require_once \$file;
}

\$psr4ClassLoader = new Psr4ClassLoader('{$psr4ClassMapPath}');
spl_autoload_register([\$psr4ClassLoader, 'loadClass']);
/* === STEP-4 ココまで === */
CODE;

    file_put_contents("{$vendorDirPath}/autoload.php", $autoloaderScript);
}

