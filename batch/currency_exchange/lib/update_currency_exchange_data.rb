require_relative './get_currency_exchange_rate'
require_relative './database_info'

class UpdateCurrencyExchangeRateData

  extend DatabaseInfo
  extend GetCurrencyExchangeRate

  class << self

    def execute(base_currency='thb', change_currency='jpy')
      currency_data = currency_data(base_currency, change_currency)
      db_object = access_to_database
      db_object.query(table_create_query)
      db_object.query(data_register_query(
        currency_data[:base_currency_code],
        currency_data[:change_currency_code],
        currency_data[:rate],
      ))
      db_object.close
    end

    private

    def table_create_query
      %{
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

    def data_register_query(base_currency, change_currency, currency_rate)
      %{
        INSERT INTO
          `#{TABLE_NAME}` (`base_currency`, `change_currency`, `rate`, `created_at`, `updated_at`)
        VALUES
          ("#{base_currency}", "#{change_currency}", "#{currency_rate}", NOW(), NOW())
        ON DUPLICATE KEY UPDATE
          `base_currency` = "#{base_currency}",
          `change_currency` = "#{change_currency}",
          `rate` = "#{currency_rate}",
          `created_at` = NOW(),
          `updated_at` = NOW()
      }
    end

  end

end
