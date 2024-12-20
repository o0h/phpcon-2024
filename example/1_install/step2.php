<?php
$help =<<<'HELPTEXT'
【STEP2】
パッケージごとの処理を行っていくための土台を作ります。  
ここでは、先ほどSTEP1で作った内容がそのまま引き継がれているので、ローカル変数`$lockData` を利用できます。

** STEP2の目標 **

****


`$lockData` の中には、 `packages` `packages-dev` というフィールドがあります。
それぞれパッケージの情報が格納された添字配列になっています。
JSON風のシンタックスで表すと、次のようなイメージです。
(構造のイメージ)
```
{
    "packages": [
        {@package_a},
        {@package_b},
        {@package_c}
    ],
    "packages-dev": [
        {@package_d},
        {@package_e},
        {@package_f}
    ]
}
```

パッケージごとの処理を行うコードを書くのがこのステップ後のゴールです。
この全てのパッケージに対して、`processPackage()` 関数を呼び出す形にしてください。

(出来上がるコードのイメージ)
```
foreach ( /** ココで $lockDataから `packages` を1個ずつ取り出す */  as $package) {
    processInstallPackage($package);
}
foreach ( /** ココで $lockDataから `packages-dev` を1個ずつ取り出す */  as $package) {
    processInstallPackage($package);
}
```

ここでは、パッケージ名をechoする処理を備えた `processPackage()` 関数が定義されています。
STEP3以降で、この関数の中身を実装していくことになります。
** 実装のヒント **

HELPTEXT;
assert(isset($lockData));

/* === STEP-2 ココから === */
// foreach ( ・・・

foreach (['packages', 'packages-dev'] as $key) {
    foreach ($lockData[$key] as $package) {
        processInstallPackage($package);
    }
}
