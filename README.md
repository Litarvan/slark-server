![Slark logo](https://github.com/Litarvan/slark-server/blob/master/logo.png?raw=true)

# Slark server

Server for the Slark update framework. See the [client here](https://github.com/Litarvan/slark)

# Requirements

 * PHP 5.6.4 or greater
 * Ext: php_crypt
 * (OPTIONAL) Apache mod_rewrite

# Setting up

Download the latest release [here](https://github.Co/Litarvan/slark-server/releases).
Unzip it in any folder of your webroot.

Go on it using your browser, and follow the instruction

## Apache

You need to enable AllowOverride, for that, in your apache config (/etc/apache2/apache2.conf or /etc/httpd/conf/httpd.conf), between `<Directory /var/www/>` (/var/www is your document root, it can be /var/www/html, or /srv/http, etc...) and `</Directory>`, change `AllowOverride None` to `AllowOverride All` in /etc/apache2/apache2.conf
Otherwise the config (includes your password) could be read by everyone !

Mod rewrite is optional

## Nginx

Use the following config

```nginx
server {
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    include /etc/nginx/conf.d/phpVERSION-fpm.conf;
}
```

(Don't forget to replace VERSION by your PHP version)

# Testing

```bash
php -S localhost:8000
```
