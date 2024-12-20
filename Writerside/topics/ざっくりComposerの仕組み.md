# 1. ざっくりComposerの仕組み

<title instance="h">ざっくりComposerの仕組み</title>
Composerには様々な機能があります。その中でも、メインとなるのはパッケージの管理です。  
このハンズオンでは「Composerでパッケージを追加して、オートロードで使えるようになるまで」を扱います。  

本格的にComposerの自作を始める前に、少しだけ内部的な仕組みを解説します。  

@todo 色々書く
* composer.json
* composer.lock
* packagistの役割


開発を進めているプロジェクトに新規パッケージを追加するには、`require`  コマンドを利用します。少し分解すると、次の仕事が行われています。  
なお、ここでの説明内容は「ざっくりと概念を理解する」ことを優先したものにです。詳細な手続きや閭里順序など、本物のComposerの実装とは異なっている部分があります。ご了承ください。

1. `composer.json` にパッケージ情報を追加
2. `composer.lock` に依存パッケージと利用するバージョン情報を追加
3. 列挙されたパッケージと具体的なバージョンに従い、パッケージのダウンロード・配置
4. オートローダーの生成

@todo もうちょい説明が必要

「`composer.lock` を利用したパッケージの取得・配置」と、「オートローダーの生成」は、それぞれ `composer install` と `composer dump-autoload` コマンドの処理に相当するものです。  
実際のところ、本物のComposerにおいても「まず `composer.lock`ファイルを作成してから、インストール処理の起動する」という処理になっています。また、オートローダーの生成についても再利用可能な形で切り出されています。[^1]

[^1]: より厳密に言えば、次の4つの概念からなっています(Composerの内部コードを読む際にも、変数名やクラス名に現れる概念と一致します)。 ① `require` = `composer.json` の作成・更新 ② `update` = `composer.lock` の作成・更新 ③ `download` = パッケージファイルの取得 ④ `install` = パッケージのファイルの(`vendor`への)配置 ④ `dump-autoload` = オートローダーの生成 

そのため、見方を変えると「`require` コマンドは、再利用可能な複数の処理をまとめて連続で呼び出しているもの」と考えることもできます。  
このモデルにならって、今回(@todo 「今回」っていう一人称でよい？)のハンズオンでも責務を区切った小さなコマンドを作成していくことにします。

| ワーク(作成するコマンド)        | 事前条件(コマンドの実行条件)          | 事後条件(コマンド実行によって行われること)                                                 |
|----------------------|--------------------------|----------------------------------------------------------------------------|
| requireコマンドの作成       | 特になし                     | `comopser.json` , `composer.lock` が作成されている                                 |
| installコマンドの作成       | `composer.lock` が作成されている | `vendor` ディレクトリに、パッケージ名に合わせたディレクトリが作成されている<br/>その中にパッケージのコードが配置されている       |
| dump-autoloadコマンドの作成 | `composer.lock` が作成されている | `vendor/autoload.php` が作成されている<br/> `install` されたパッケージからオートロードをできるようになっている |

