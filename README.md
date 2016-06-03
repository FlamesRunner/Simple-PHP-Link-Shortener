# Rdirctor Link Shortener

This repository holds the https://rdirct.xyz link shortener code.

It is licensed under the GNU GPLv3 license.

##Installation

You need to first upload the files in this repository to your server.
If you have shell access, this should be trivial:

    cd ~ && wget https://github.com/FlamesRunner/Rdirctor-Link-Shortener/archive/master.zip

Then, unzip the repository.

    unzip master.zip && cd Rdirctor-Link-Shortener-master

Move the contents of interface/* to your webspace.
For example:

    mv interface/* /var/www/html/

However, a .htaccess file is involved thus we need to rename htaccess to .htaccess in the a/ folder.

    cd /var/www/html/a && mv htaccess .htaccess

All that's left is for you to create a database and restore the table included in the repository.

    mysql -umysqlusername -pmysqlpassword yourdatabasename < ~/Rdirctor-Link-Shortener/mysqldata/urldata.sql

Fill the MySQL credentials used for this into /var/www/html/config.php. Inside the configuration file, you will be able to configure the page title, MySQL details, advertising code, etc. 

Happy link shortening!
