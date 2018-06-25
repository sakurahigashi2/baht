#!/bin/bash

# 通貨レート更新
ruby /usr/local/batch/currency_exchange/runner.rb  "CurrencyExchangeBatch.execute"
