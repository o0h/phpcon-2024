<?php
$help =<<<'HELPTEXT'
【STEP3】
パッケージのアーカイブファイルをダウンロードします。
このステップでは、次の2つの要件を満たすのが目標です。
関数 `procedure1_3` を実装していきます。

** STEP3の目標 **
1. パッケージ情報から、ソースコード本体(アーカイブファイル)を入手するためのURLを取得する
2. 取得したURLからアーカイブファイルをダウンロードして、指定したパスに保存する

procedure1_3()は、引数に個別のパッケージ情報をとり、アーカイブファイルの保存先パスを返すよう実装する

****

** 実装のヒント **
`$package['dist']['url']` には、パッケージのアーカイブファイルのURLが格納されています。  
ここにGETリクエストを送ることで、ZIP形式のアーカイブファイルを取得できます。  
ただし、GitHubAPIを利用するためには、リクエストヘッダーを適切にセットする必要があります。
    1. BearerトークンをAuthorizationフィールドにセットする
    2. 何かしらのUser-Agentをセットする
この条件を満たしてリクエストを送るため、`downloadWithGitHubAuth` という関数を用意してあります。利用してください。気になった方は、ぜひ中身も覗いてみてください！
==== !!注意!! ====
リクエスト処理を自作する場合は、リクエスト先がGitHubAPIであることを必ず確認してください。  
確認を怠った場合、意図しないサーバーにGitHubトークンが渡ってしまう危険性があります。
====

DLしたファイルは、 `/tmp/work1/` 以下に保存してください。ファイル名は、パッケージ名＋拡張子とします。
(例) `monolog/monolog` の場合、 `/tmp/work1/monolog.zip` というパスに保存する
==== ノート ====
`/tmp/work1/` ディレクトリは、 work/1_install/main.phpの実行時の初期処理内で
「ファイルやサブディレクトリを持たない(空である)」「書き込み可能」にしているので、意識する必要はありません
====
パッケージ名には `/` が含まれるため、適宜ディレクトリを作成する必要があります。  
( 「ベンダー名/パッケージ名」の形式です。)
同一ベンダーの複数のプロジェクトが存在する可能性もあるので、ディレクトリ作成時には留意してください。

****

** Appendix **

ディレクトリの作成や存在確認には、次の関数が利用できます。
1. https://www.php.net/file_exists
2. https://www.php.net/is_dir
3. https://www.php.net/mkdir


例として、ファイルの書き出しには次の関数やクラスが利用できます。

1. https://www.php.net/manual/ja/function.file-put-contents.php
2．https://www.php.net/manual/ja/function.fwrite.php
3. https://www.php.net/manual/ja/class.splfileobject.php

HELPTEXT;
// STEP2で実装した「パッケージごとの逐次処理」を実行させるため、step2.phpを読み込みます
require __DIR__ . '/step2.php';

function procedure1_3(array $package): string
{
    /* === STEP-3 ココから === */


    return ''; // 型宣言を満たすための仮置きのreturn。 @TODO 実装が完了したら削除してくだし
    /* === STEP-3 ココまで === */

}

