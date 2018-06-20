FROM mariadb:10.3.7

RUN unlink /etc/localtime;ln -s /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

COPY mysql_bk.sh /usr/local/bin/
RUN chmod 775 /usr/local/bin/mysql_bk.sh
