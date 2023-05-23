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
REACT_APP_API="https://api.tapstar.com.au"
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
