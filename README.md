# Laravel Sanctum Sample

## 概要

Laravel Sanctumのサンプルプログラムです。
artisanコマンドでtokenを作成し、
APIからtoken認証ができることを確認できます。

## 使用ソフトウェア

- PHP 7.4
- PostgreSQL 13
- Nginx 1.18
- node 15.11.0
- Laravel 8

## 使用方法（例）

### 準備
```shell script
cd /path/to/laravel-sanctum-sample
# Docker起動
docker-compose up -d
# Laravel準備
docker-compose exec -u 1000 app bash
cd laravel-app
composer install
# 暗号化Keyを生成
php artisan key:generate
# Permission設定
chmod -R  777 storage
# DB接続情報を編集（docker-compose.yml参照）
cp .env.example .env
vi .env
php artisan migrate
exit
# node準備
docker-compose exec -u 1000 node bash
cd /var/www/html/laravel-app
npm install
npm run dev
```

### ユーザ作成
http://localhost:8080/registerにアクセスしてユーザを作成します。

### Token作成
```shell
docker-compose exec -u 1000 app bash
cd laravel-app
php artisan token:create {user_id}
# （出力例）1|WruSLTN5RaQTdXQ5lEq21bzg5OKO3HEiQJPc3rnH
```

### APIでToken認証
#### リクエスト例
ヘッダのAuthorizationにtokenを指定します。（先頭にBearerと記述するのを忘れずに。）
```http request
GET http://localhost:8080/api/user
Accept: application/json
Authorization:Bearer 6W8N0rKQNF4kVt7fGWriPYpUGSz8jXvPfHq6EqmS
```

#### レスポンス例
リクエストに含まれるユーザを特定できるものはTokenだけですが、
ユーザ情報を取得できることが確認できます。
```text
HTTP/1.1 200 OK
Server: nginx/1.18.0
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/7.4.12
Cache-Control: no-cache, private
Date: Sun, 07 Mar 2021 05:26:09 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *

{
  "id": 1,
  "name": "test",
  "email": "test@example.com",
  "email_verified_at": null,
  "created_at": "2021-03-07T05:05:15.000000Z",
  "updated_at": "2021-03-07T05:05:15.000000Z"
}
```
