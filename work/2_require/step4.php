<?php

$help = <<<'HELPTEXT'
【STEP4】
TBD

** STEP3の目標 **
TBD
1. パッケージ情報から、ソースコード本体(アーカイブファイル)を入手するためのURLを取得する
2. 取得したURLからアーカイブファイルをダウンロードして、指定したパスに保存する

TBD

# TODO
TBD
HELPTEXT;

$requirePackageNameList = ['aura/cli', 'psr/log'];

foreach ($requirePackageNameList as $requirePackageName) {
    processRequirePackage($requirePackageName); // この内部で `procedure2_4` が呼ばれます
}


function procedure2_4(
    array   $packageMeta,
    ?string $lockFilePath = null,
): void
{
    $lockFilePath ??= __DIR__ . '/composer.lock';

    if (!file_exists($lockFilePath)) {
        file_put_contents($lockFilePath, json_encode(['packages' => [], 'packages-dev' => []]));
    }

    $rootPackageLock = loadJsonFile($lockFilePath);

    /* === STEP-3 ココから === */
    $packageName = $packageMeta['name'];
    $packageIndex = array_find_key(
        $rootPackageLock['packages'],
        fn($package) => $package['name'] === $packageName,
    );
    if ($packageIndex === null) {
        $packageIndex = count($rootPackageLock['packages']);
    }
    $rootPackageLock['packages'][$packageIndex] = [
        'name' => $packageMeta['name'],
        'version' => $packageMeta['version'],
        'source' => $packageMeta['source'],
        'dist' => $packageMeta['dist'],
        'license' => $packageMeta['license'],
    ];
    $rootPackageLock['content-hash'] = hash('md5', trim(json_encode($rootPackageLock)));

    file_put_contents($lockFilePath, json_encode($rootPackageLock, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    /* === STEP-3 ココまで === */
}
