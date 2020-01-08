FROM nginx:1.17

COPY config/nginx/nginx.conf /etc/nginx/nginx.conf

COPY vhost.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www
