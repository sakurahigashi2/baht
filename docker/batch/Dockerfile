FROM centos:7

# システム時刻を東京に変更
RUN unlink /etc/localtime;ln -s /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

# 必須パッケージインストール
RUN yum -y update
RUN yum -y install git bzip2 gcc make openssh-server iputils iproute which openssl-devel readline-devel zlib-devel sqlite-devel postgresql-devel mysql-devel

# 環境変数設定
ENV RBENV_ROOT /usr/local/rbenv
ENV RUBY_V 2.6.5
ENV PATH $RBENV_ROOT/bin:$PATH
ENV PATH $RBENV_ROOT/shims:$PATH

# rbenv経由でrubyのインストール
RUN git clone https://github.com/sstephenson/rbenv.git $RBENV_ROOT
RUN eval "$(rbenv init -)"
RUN git clone git://github.com/sstephenson/ruby-build.git $RBENV_ROOT/plugins/ruby-build && \
    cd $RBENV_ROOT/plugins/ruby-build && ./install.sh && rm -f ./install.sh && cd ~
RUN rbenv install $RUBY_V && \
    rbenv rehash && \
    rbenv global $RUBY_V

# gemのインストール
WORKDIR /usr/local/batch
COPY ./Gemfile .
COPY ./Gemfile.lock .
RUN gem install bundler -v 2.1.4
RUN bundle install

CMD ["/sbin/init"]
