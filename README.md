# mackerel-plugin-twitter
twitterアカウントをmackerelで可視化する

# インストール

```
$ git clone https://github.com/soudai/mackerel-plugin-twitter.git

$ cd mackerel-plugin-twitter
$ composer install

※bash: composer: コマンドが見つかりません が出た場合
$ php -r "readfile('https://getcomposer.org/installer');" | php
$ mv composer.phar /usr/local/bin/composer
$ /usr/local/bin/composer install

※composer install 成功時のメッセージ例
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 6 installs, 0 updates, 0 removals
  - Installing mpyw/twistoauth (3.5.2): Downloading (100%)         
  - Installing guzzlehttp/promises (v1.3.1): Loading from cache
  - Installing psr/http-message (1.0.1): Loading from cache
  - Installing guzzlehttp/psr7 (1.4.1): Downloading (100%)         
  - Installing guzzlehttp/guzzle (6.2.2): Loading from cache
  - Installing ariarijp/mackerel-client (dev-master fc370fc): Cloning fc370fc9f9 from cache
Package mpyw/twistoauth is abandoned, you should avoid using it. Use mpyw/cowitter instead.
Writing lock file
Generating autoload files
```

# 必要事項の設定
`$ vim monitoring.php`

下記の項目を適宜変更
- *******************を書き換え
  - $consumer_key
  - $consumer_secret
  - $access_token
  - $access_token_secret
  - $mackerel_api_key
- Twitterのスクリーンネーム
- サービスメトリック名
- サービス名

# mackerel-agentのインストール
https://mackerel.io/my/instruction-agent

# crontabの設定
`$ crontab -e`

下記を末尾に追加
```
*/1 * * * * /usr/bin/php /インストールパス/mackerel-plugin-twitter/monitoring.php
```

`$ sudo /etc/init.d/mackerel-agent restart`

管理画面のサービスメトリック名にグラフが描画されれば成功
