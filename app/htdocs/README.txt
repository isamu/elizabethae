## Quick Installation

To start demo application.

Add apache.conf

-----------------------------------------------------
<VirtualHost *:80>
ServerName your.test.domain.example.com

DocumentRoot "/your/elizabethae/dir/app/htdocs"

<Directory "/your/elizabethae/dir/app/htdocs">
RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !favicon.ico$
        RewriteRule ^(.*)$ index.php [QSA,L]
</Directory>
</VirtualHost>

-----------------------------------------------------

$ chmod 666 /your/elizabethae/dir/app/data/*

browse your sample site http://your.test.domain.example.com/

