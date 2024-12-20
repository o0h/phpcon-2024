<?php
$help =<<<'HELPTEXT'
【STEP2】
TBD

** STEP3の目標 **
TBD
1. パッケージ情報から、ソースコード本体(アーカイブファイル)を入手するためのURLを取得する
2. 取得したURLからアーカイブファイルをダウンロードして、指定したパスに保存する

TBD

** NOTE **
versionの有効な形式
- 0.2.5
- v2.0.4 (prefix "v")
- 1.0.0-dev (suffix)
- 3.0.0-patch (suffix)
- 3.0.0-RC2 (suffix with number)
suffixが alpha, beta, rc, dev のいずれかの場合は、「安定版(stable)」ではないため利用不可とみなす
それ以外のsuffixは利用可。

# TODO
TBD
HELPTEXT;

$requirePackageNameList = ['aura/cli', 'psr/log'];

foreach ($requirePackageNameList as $requirePackageName) {
    processRequirePackage($requirePackageName); // この内部で `procedure2_2` が呼ばれます
}

function procedure2_2(string $packageVersionedMetaList): array
{
    /* === STEP-2 ココから === */
    $packageVersionedMetaList = json_decode($packageVersionedMetaList, true);
    $packageVersionedMetaPackages = current($packageVersionedMetaList['packages']);

    $packageData = [];
    foreach ($packageVersionedMetaPackages as $packageVersionedMetaPackage) {
        $packageData = array_merge($packageData, $packageVersionedMetaPackage);
        $versionNormalized = $packageVersionedMetaPackage['version'];
        if (str_contains($versionNormalized, '-')) {
            $suffix = explode('-', $versionNormalized)[1];
            if (preg_match('#('.implode('|', ['dev', 'alpha', 'beta', 'rc']).')#i', $suffix)) {
                continue;
            }
        }
        break;
    }

    return $packageData;
    /* === STEP-2 ココまで === */
}

