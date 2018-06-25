FROM wordpress:4.9.6-apache

RUN unlink /etc/localtime;ln -s /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

RUN echo "export TERM=xterm LANG=en_US.UTF-8" >> ~/.bashrc \
    && apt-get update && apt-get -y install git vim \
    && rm -rf "/opt/letsencrypt" \
    && git clone https://github.com/letsencrypt/letsencrypt /opt/letsencrypt \
    && cd /opt/letsencrypt \
    && ./letsencrypt-auto --version

COPY letsencrypt.sh /usr/local/bin/

RUN chmod 775 /usr/local/bin/letsencrypt.sh
