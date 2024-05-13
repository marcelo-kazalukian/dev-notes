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

## Connect and start PHP-FastCGI and Nginx

### Create a .bat to start PHP FastCGI and nginx together

NGINX can interface with PHP on Windows via a FastCGI daemon, which ships with PHP: php-cgi.exe. You need to run php-cgi.exe -b 127.0.0.1:<port> and use fastcgi_pass 127.0.0.1:<port> in the NGINX configuration file. After being launched, php-cgi.exe will keep listening for connections in a command prompt window. To hide that window, use the tiny utility RunHiddenConsole

Download the RunHiddenConsole utility from [here](https://redmine.lighttpd.net/attachments/660/RunHiddenConsole.zip)

Create somewhere (e.g. in c:\nginx\) a batch file start-php-fcgi-nginx.bat similar to this one:

```
@ECHO OFF
ECHO Starting PHP FastCGI...
set PATH=C:\PHP;%PATH%
c:\bin\RunHiddenConsole.exe C:\PHP\php-cgi.exe -b 127.0.0.1:9000

ECHO Starting NGINX
start nginx.exe

popd
EXIT /b
```

The line: set PATH=C:\PHP;%PATH% could be removed if you set c:\php in the PATH windows environment variable (which is highly recommended).

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






