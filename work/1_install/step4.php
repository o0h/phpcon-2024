<?php

$help = <<<'HELPTEXT'
【STEP4】
ダウンロードされたアーカイブファイルを、 `vendor` ディレクトリに配置していきましょう。

// TBD
// このステップでは、次のnつの要件を満たすのが目標です。
// 関数 `procedure1_4` を実装していきます。

** STEP4の目標 **
1. TBD

procedure1_4()は、TBD
****

** 実装のヒント **
TBD
****

** Appendix **

TBD

HELPTEXT;

$archivePaths = glob('/tmp/work1/*/*.zip');
foreach ($archivePaths as $archivePath) {
    /* === STEP-4 ココから === */
    $zip = new ZipArchive();
    if ($zip->open($archivePath) !== true) {
        throw new RuntimeException('アーカイブファイルのオープンに失敗しました');
    }
    $packageName = substr($archivePath , strlen('/tmp/work1/'), -4);
    $zip->extractTo('/tmp/work1/');

    $installTo = __DIR__ . '/vendor/' . $packageName;
    if (!is_dir(dirname($installTo))) {
        mkdir(dirname($installTo), 0777, true);
    }
    mv(
        '/tmp/work1/' . $zip->getNameIndex(0),
        $installTo .'/'
    );
    $zip->close();
    /* === STEP-4 ココまで === */
}
