FROM php:8.3-fpm

#Declare variables
ARG user=alex
ARG work_dir=/var/www


#Root project folder
WORKDIR $work_dir


#Server packages
RUN apt-get update && apt-get install -y \ 
    libpng-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    vim \
    git \
    curl \
    zip \
    unzip \
    supervisor \
    sqlite3 \
    sudo

RUN apt-get clean && rm -rf /var/lib/apt/lists/*


#PHP specific packages
RUN docker-php-ext-install \
    pdo_mysql \
    exif \
    bcmath \
    gd \
    mbstring \
    zip

# RUN pecl install redis

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer


#Install node
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash - && apt-get install -y nodejs


#Copy local folders to the root project folder
COPY . $work_dir


#Install npm packages
#RUN npm install
#RUN npm install alpinejs


#Amend .ini file values and copy / create to .ini file
RUN sed -E -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 20M/' /usr/local/etc/php/php.ini-production
RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/php.ini-production

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini


#Create a new user and add relevant groups
RUN useradd -ms /bin/bash $user
RUN usermod -a -G www-data,root $user

RUN chown -R $user:$user $work_dir


#Shell in to container with user
USER $user



##Build and run image
# docker compose build
# docker exec -it houze_app bash
# npm run dev