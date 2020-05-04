module GetCurrencyExchangeRate

  require 'open-uri'
  require 'nokogiri'

  def currency_data(base_currency_code, change_currency_code)
    {
      base_currency_code: base_currency_code,
      change_currency_code: change_currency_code,
      rate: scraiping_exchange_data(base_currency_code, change_currency_code),
    }
  end

  private

  def scraiping_exchange_data(base_currency_code, change_currency_code)
    fetch_url = "https://info.finance.yahoo.co.jp/fx/convert/?s=#{base_currency_code.upcase}&t=#{change_currency_code.upcase}"
    doc = Nokogiri::HTML(open(fetch_url))
    doc.xpath("//td[@class='price noLine']").text
  end

end
