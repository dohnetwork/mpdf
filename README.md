# mpdf
Apache2 with php5 on Ubuntu 14.04 LTS
This is docker images of Ubuntu 14.04 LTS with apache2 and php5/composer

To access site contents from utside the container you should map /var/www/html

Includes composer for easy download of php libraries

For php7 please se the Ubuntu 16.04 LTS and php7 container nimmis/apache-php7

Examples
plain, accessable on port 8080 docker run -d -p 8080:80 dohnetwork/apache-php5
with external contents in /home/dohnetwork/html docker run -d -p 8080:80 -v /kong/html:/var/www/html 
The docker container is started with the -d flag so it will run inte the background. To run commands or edit settings inside the container run `docker exec -ti /bin/bash'
