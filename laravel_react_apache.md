# How to set up virtual hosts for a Laravel API using react js as frontend

The two apps will be in two different repository.

## React Local environment

react/src/login.js

```js
...
axios.defaults.baseURL = process.env.REACT_APP_API || "http://localhost:8000";
axios.defaults.headers.common["Accept"] = "application/json";
axios.defaults.withCredentials = true;
...
```

The REACT_APP_API variable is defined in react/.env
```
REACT_APP_API="https://api.domain.com.au"
```

Create the file react/public/.htaccess
```
Options -MultiViews
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.html [QSA,L]
```

Start the react server
```
npn run start
```

package.json file should include this 
```json
"homepage": "https://domain.com.au",
```

## Laravel Local environment
.env file
```
...
APP_URL=http://localhost:8000
SANCTUM_STATEFUL_DOMAINS=localhost:3000
SESSION_DOMAIN=.localhost
...
```

Start the the laravel server
```
php artisan serve
```

## Laravel production environment

The app is installed under /var/www/api

.env file
```
...
APP_URL=https://api.domain.com
SANCTUM_STATEFUL_DOMAINS=domain.com.au
SESSION_DOMAIN=.domain.com.au
...
```

/etc/apache2/sites-enabled/api-le-ssl.conf
```
<IfModule mod_ssl.c>
<VirtualHost *:443>
        ServerAdmin my_email@gmail.com
        ServerName api.domain.com.au
        DocumentRoot /var/www/api/public

        <Directory /var/www/api/public/>
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        <IfModule mod_dir.c>
            DirectoryIndex index.php index.pl index.cgi index.html index.xhtml index.htm
        </IfModule>


Include /etc/letsencrypt/options-ssl-apache.conf
SSLCertificateFile /etc/letsencrypt/live/api.domain.com.au-0001/fullchain.pem
SSLCertificateKeyFile /etc/letsencrypt/live/api.domain.com.au-0001/privkey.pem
</VirtualHost>
</IfModule>
```

## React production environment

The app is installed under /var/www/frontend/build

I run the npm run build command in my local machine and I upload the build folder

/var/www/frontend/build/

/etc/apache2/sites-enabled/frontend-le-ssl.conf
```
<IfModule mod_ssl.c>
<VirtualHost *:443>
        ServerAdmin my_email@gmail.com
        ServerName domain.com.au
        ServerAlias www.domain.com.au
        DocumentRoot /var/www/frontend/build

        <Directory /var/www/frontend/build/>
            Options +FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        <IfModule mod_dir.c>
            DirectoryIndex index.php index.pl index.cgi index.html index.xhtml index.htm
        </IfModule>


Include /etc/letsencrypt/options-ssl-apache.conf
SSLCertificateFile /etc/letsencrypt/live/domain.com.au-0001/fullchain.pem
SSLCertificateKeyFile /etc/letsencrypt/live/domain.com.au-0001/privkey.pem
</VirtualHost>
</IfModule>
```
