#!/bin/bash

# 変数定義
PERIOD=2
DIRPATH='/backup'
FILENAME=`date +%y%m%d`
PASSWORD=$MYSQL_ROOT_PASSWORD
OLDFILE=`date --date "$PERIOD days ago" +%y%m%d`

# mysqldump実行
mysqldump --opt --password=$PASSWORD $1 > $DIRPATH/$1_$FILENAME.sql

# パーミッション変更
chmod 700 $DIRPATH/$1_$FILENAME.sql

# 古いバックアップファイルを削除
rm -f $DIRPATH/$1_$OLDFILE.sql
