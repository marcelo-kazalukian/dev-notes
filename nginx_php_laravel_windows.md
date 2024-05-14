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
To check status tasklist /fi "imagename eq nginx.exe" (One of the processes is the master process and another is the worker process)
```
Remember to run these commands from the directory where Nginx is installed.

## Install PHP

Download PHP Non Thread Safe for Windows from [here](https://windows.php.net/download)

Choose a location to extract the files (e.g., C:\php)

Check the php.ini and modify it according to your needs.

### Update the nginx conf file

Create a backup of c:\nginx\conf\nginx file

Open the file and uncomment the everything inside: location ~ \.php$ {} and change it for this:

```
location ~ \.php$ {
    fastcgi_pass   127.0.0.1:9000;
    fastcgi_index  index.php;
    fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
    include        fastcgi_params;
}
```

Be sure the port value in: fastcgi_pass 127.0.0.1:9000; is the same that you used in the start-php-fcgi-nginx.bat

Double-click on the start-php-fcgi-nginx.bat and check the localhost in your browser. You have to see the "Welcome to Nginx" page.

## Keep Nginx after restart windows

We need to use nssm to install nginx and php as a service in Windows

Download NSSM from: https://nssm.cc/download Copy the nssm.exe from the win32 or win64 folder depending on your system in c:\nssm and add this folder to the PATH windows variable

Open cmd as admin, navigate to C:\nssm

Type in this command without the quotes “nssm install nginx”

Path = C:\nginx\nginx.exe

Startup directory = C:\nginx

Install the service

To Make sure you run the service as the admin account: 

Open run and type in services.msc

Search for the nginx service we just installed

Double-click and go to the Log On tab

Select ‘This account:’ and fill in your account details and then press ok.

Right-click on the nginx service and restart

## Keep PHP running after restart Windows

We need to use nssm to install nginx and php as a service in Windows

Download NSSM from: https://nssm.cc/download Copy the nssm.exe from the win32 or win64 folder depending on your system in c:\nssm and add this folder to the PATH windows variable

Open cmd as admin, navigate to C:\nssm

Type in this command without the quotes “nssm install php”

Path = C:\php\php-cgi.exe

Startup directory = C:\php

Arguments = -b 127.0.0.1:9000

Install the service

## Restart the server

Open the Windows task manager, click on the services tabs, find nginx, right-click and select restart.

## Setup Nginx conf file

Everything should be working fine at this point. Then you have to modify the c:\nginx\conf\nginx file according to your needs.

This is my setup for Laravel based on the [documentation] (https://laravel.com/docs/11.x/deployment#nginx)

```
server {
        listen       80;
	listen [::]:80;
        server_name  localhost;
	root c:\www\myapp;

        add_header X-Frame-Options "SAMEORIGIN";
	add_header X-Content-Type-Options "nosniff";
				
	index index.php;
		
	charset utf-8;

        location / {            		
            try_files $uri $uri/ /index.php?$query_string;
        }

        location = /favicon.ico { access_log off; log_not_found off; }
	location = /robots.txt  { access_log off; log_not_found off; }
		
        error_page 404 /index.php;
       
        location ~ \.php$ {
			fastcgi_pass   127.0.0.1:9000;			
			fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
			include        fastcgi_params;
			fastcgi_hide_header X-Powered-By;
		}
        
        location ~ /\.(?!well-known).* {
            deny  all;
        }
    }
```

## References

https://www.nginx.com/resources/wiki/start/topics/examples/phpfastcgionwindows/

https://nginx.org/en/docs/windows.html

https://github.com/Urmuz/Easy-Nginx-PHP

https://laravel.com/docs/11.x/deployment

https://dev.to/ilhamsabir/windows-10-nginx-php-2oef








