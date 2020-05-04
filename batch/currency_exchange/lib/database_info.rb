module DatabaseInfo

  require 'mysql2'

  TABLE_NAME = 'wp_currency_rates'

  # DB情報マッピング NOTE:環境変数から取得
  BASE_DB_MAPPINGS = {
    host: ENV['DB_HOST'],
    port: ENV['DB_PORT'],
    username: ENV['DB_USER'],
    password: ENV['DB_PASSWORD'],
    database: ENV['DB_DATABASE']
  }.freeze

  def access_to_database
    Mysql2::Client.new(
                        host: BASE_DB_MAPPINGS[:host],
                        port: BASE_DB_MAPPINGS[:port],
                        username: BASE_DB_MAPPINGS[:username],
                        password: BASE_DB_MAPPINGS[:password],
                        database: BASE_DB_MAPPINGS[:database]
                      )
  end

end
