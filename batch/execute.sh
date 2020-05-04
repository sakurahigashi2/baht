#!/bin/bash

# 通貨レート更新
ruby /usr/local/batch/currency_exchange/exe/runner.rb  "UpdateCurrencyExchangeRateData.execute"
