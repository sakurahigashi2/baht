#!/bin/bash

DOMAIN=$DOMAIN
MAIL=$MAIL
KEY_PAHT=/etc/letsencrypt/live/$DOMAIN/privkey.pem

CHECK=`ls $KEY_PAHT 2>&1 >/dev/null`

if [ -n "$CHECK" ]; then
    echo "Create new"
    /opt/letsencrypt/certbot-auto --apache -d $DOMAIN --agree-tos -n -m $MAIL
else
    echo "Renewal check"
    /opt/letsencrypt/certbot-auto renew
fi
