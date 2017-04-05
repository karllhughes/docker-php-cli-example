#!/usr/bin/env bash
echo -e $PRIVATE_SSH_KEY >> $HOME/.ssh/id_rsa
ssh -t -oStrictHostKeyChecking=no $USER@$HOST "cd docker-php-cli-example ; sh docker/deploy.sh"
