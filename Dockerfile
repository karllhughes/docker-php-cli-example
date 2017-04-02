FROM php:cli

# Install mysql and cron
RUN apt-get update && apt-get install -y \
    libpq-dev \
    cron \
    mysql-client
RUN docker-php-ext-install pdo pdo_mysql

# Add crontab file in the cron directory
ADD crontab /etc/cron.d/cron

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/cron

ADD ./ /app

WORKDIR /app

CMD ["php", "artisan"]