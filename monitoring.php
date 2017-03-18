<?php

require __DIR__ . '/vendor/autoload.php';
require 'vendor/autoload.php';

# https://apps.twitter.com/から必要な情報を取得して記載する
$consumer_key = '*******************';
$consumer_secret = '*******************';
$access_token = '*******************';
$access_token_secret = '*******************';

$connection = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
$users_params = ['screen_name' => 'Twitterのスクリーンネーム'];
$users = $connection->get('users/show', $users_params);

$mackerel_api_key = '*******************';

$client = new \Mackerel\Client([
    'mackerel_api_key' => $mackerel_api_key,
]);

$time = time();

$metrics = [
    [
        'name' => 'サービスメトリック名.followers_count',
        'time' => $time,
        'value' => (int)$users->followers_count,
    ], [
        'name' => 'サービスメトリック名.friends_count',
        'time' => $time,
        'value' => (int)$users->friends_count,
    ]
];

$result = $client->postServiceMetrics('サービス名', $metrics);
