.PHONY: default help init up down sh ps logs php-lint

default: init sh

help: ## 今表示している内容を表示します
	@cat README.md
	echo "\n## コマンド一覧"
## obtained from https://qiita.com/po3rin/items/7875ef9db5ca994ff762
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

init: ## ローカル開発に必要なサービスのセットアップを行います
	docker compose build
	docker compose run --rm -e XDEBUG_MODE=off app composer install --no-interaction

sh: ## 起動中のappサービスに入ってシェルを実行します
	@docker compose run --rm -it -w /opt app bash
