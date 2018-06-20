class CurrencyExchangeRate
  require 'net/http'
  require 'uri'
  require 'json'

  def initialize(base_currency='thb', change_currency='jpy')
    @base_currency = base_currency.downcase
    @change_currency = change_currency.downcase
  end

  def exchange_data
    base_api = 'http://api.aoikujira.com/kawase/json/'
    get_api = base_api + @base_currency
    uri = URI.parse(get_api)
    json = Net::HTTP.get(uri)
    result = JSON.parse(json)
  end

  def target_currency_rate
    data = exchange_data
    currency = data[@change_currency]&.to_f || data[@change_currency.upcase]&.to_f
    set_currency = currency.round(2)
  end

  def update_time
    data = exchange_data
    update = data['update']
  end
end

class CurrencyExchangeBatch < CurrencyExchangeRate
  require 'mysql2'

  # DB情報マッピング NOTE:環境変数から取得
  BASE_DB_MAPPINGS = {
    host: ENV['DB_HOST'],
    port: ENV['DB_PORT'],
    username: ENV['DB_USER'],
    password: ENV['DB_PASSWORD'],
    database: ENV['DB_DATABASE']
  }.freeze

  TABLE_NAME = 'wp_currency_rates'

  def self.execute(base_currency='thb', change_currency='jpy')
    @base_currency = base_currency.downcase
    @change_currency = change_currency.downcase
    currency_data = new(@base_currency, @change_currency)
    object = currency_data.access_database
    object.query(currency_data.table_create_query)
    object.query(currency_data.data_register_query(currency_data))
    object.close
  end

  def access_database
    Mysql2::Client.new(
                        host: BASE_DB_MAPPINGS[:host],
                        port: BASE_DB_MAPPINGS[:port],
                        username: BASE_DB_MAPPINGS[:username],
                        password: BASE_DB_MAPPINGS[:password],
                        database: BASE_DB_MAPPINGS[:database]
                      )
  end

  def table_create_query
    create_table = %{
                      CREATE TABLE IF NOT EXISTS `#{TABLE_NAME}` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `base_currency` varchar(5) NOT NULL,
                        `change_currency` varchar(5) NOT NULL,
                        `rate` varchar(10) NOT NULL,
                        `created_at` datetime NOT NULL,
                        `updated_at` datetime NOT NULL,
                        PRIMARY KEY(id),
                        UNIQUE (base_currency,change_currency)
                      )
                    }
  end

  def data_register_query(data)
    data = data
    currency_rate = data.target_currency_rate
    get_date = data.update_time
    insert = %{
                INSERT INTO
                  `#{TABLE_NAME}` (`base_currency`, `change_currency`, `rate`, `created_at`, `updated_at`)
                VALUES
                  ("#{@base_currency}", "#{@change_currency}", "#{currency_rate}", "#{get_date}", NOW())
                ON DUPLICATE KEY UPDATE
                  `base_currency` = "#{@base_currency}",
                  `change_currency` = "#{@change_currency}",
                  `rate` = "#{currency_rate}",
                  `created_at` = "#{get_date}",
                  `updated_at` = NOW()
              }
  end
end
