# How to set up virtual hosts for a API laravel using react js as frontend

The two apps will be in two different repository.

React Local environment

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

