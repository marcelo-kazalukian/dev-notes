# How to install Nginx, PHP-Fast CGI and Laravel in Windows

## Install Nginx

Download Nginx from [here](http://nginx.org/en/download.html)

Choose a location to extract the files (e.g., C:\nginx)

Click on the Start button, Type cmd, right-click on the Command Prompt result and select Run as administrator.

cd C:\nginx

start nginx

Open your web browser and navigate to http://localhost.

You have to see the "Welcome to Nginx" page.

### Managing Nginx

Here are some basic commands you can use to manage Nginx:
```
To stop Nginx, use the command `nginx -s stop`.
To quit Nginx gracefully, use `nginx -s quit`.
To reload the Nginx configuration file, use `nginx -s reload`.
To reopen the Nginx log files, use `nginx -s reopen`.
```
Remember to run these commands from the directory where Nginx is installed.

## Install PHP

Download PHP Non Thread Safe for Windows from [here](https://windows.php.net/download)

Choose a location to extract the files (e.g., C:\php)

Check the php.ini and modify it according to your needs.

