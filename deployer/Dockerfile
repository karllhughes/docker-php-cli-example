FROM alpine:latest

# Install openssh
RUN apk update && apk add openssh

# Prep for the ssh key
RUN mkdir -p "$HOME/.ssh"
RUN touch $HOME/.ssh/id_rsa
RUN chmod 600 $HOME/.ssh/id_rsa

# Add the shell script
COPY execute.sh execute.sh

CMD sh execute.sh
