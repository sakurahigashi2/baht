# Bahtについて
Bahtはメディア用WordPress環境構築一式が用意されています。
## 初回構築手順
Dockerを利用して、コマンド一つでWordPressの構築が完了します。
構築手順は以下の通りです。
## サーバーの設定
### Dockerのインストール
インストール方法は[公式サイト](https://docs.docker.com/install/linux/docker-ce/debian/)を参照。
### Docker-composeのインストール
以下のコマンドでインストール。
```
sudo curl -L https://github.com/docker/compose/releases/download/1.21.2/docker-compose-$(uname -s)-$(uname -m) -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```
詳しくは[公式サイト](https://docs.docker.com/compose/install/)を参照。
## アプリの設定
### 環境設定ファイルの用意
config配下にmysql.envとwordpress.envを配置。
##### mysql.env
```
MYSQL_ROOT_PASSWORD=ルートパスワード
```
#### wordpress.env
```
WORDPRESS_DB_NAME=データベース名
WORDPRESS_DB_USER=ルートユーザー推奨
WORDPRESS_DB_PASSWORD=ルートパスワード
WORDPRESS_DB_HOST=mysql(mysqlのままにする)
```
wp-config.phpに設定した環境変数が反映。
## 起動
### コンテナ起動
dockerディレクトリまで移動してdocker-composeコマンドを実行。
```
docker-compose up
```
### ブラウザからアクセス
<http://localhost:8888>

## 備考
2回目以降の起動時にDBコンテナが起動せず、エラーになってしまう場合には  
**db/data/tc.log**を削除してから起動する。
