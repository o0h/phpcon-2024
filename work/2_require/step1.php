<?php
$help =<<<'HELPTEXT'
今から、requireコマンドを実行します。
今回の実装では、2つのパッケージを追加することにします。
    - aura/cli
    - psr/log
 
 最終的に、 `composer.json` `composer.lock` ファイルを生成するコマンドです。
 
【STEP1】

** STEP1の目標 **
1. パッケージ情報から、ソースコード本体(アーカイブファイル)を入手するためのURLを取得する
2. 取得したURLからアーカイブファイルをダウンロードして、指定したパスに保存する

TBD

# TODO
TBD
HELPTEXT;
const BASE_PACKAGE_ENDPOINT_TEMPLATE = 'https://repo.packagist.org/p2/%s.json';

$requirePackageNameList = ['aura/cli', 'psr/log'];

foreach ($requirePackageNameList as $requirePackageName) {
    processRequirePackage($requirePackageName); // この内部で `procedure2_1` が呼ばれます
}

function procedure2_1 (string $requirePackageName): string
{
    /* === STEP-1 ココから === */
    $packageEndpoint = sprintf(BASE_PACKAGE_ENDPOINT_TEMPLATE, $requirePackageName);
    $packageVersionedMetaListJson = file_get_contents($packageEndpoint);
    return $packageVersionedMetaListJson;
    /* === STEP-2 ココまで === */
}

