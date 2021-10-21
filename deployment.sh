#!/bin/sh
cd /var/www/html/laravelpoc_build/
git stash
git pull

rsync -avzh /var/www/html/laravelpoc_build/ /var/www/html/laravelpoc/

cd /var/www/html/laravelpoc/
php artisan migrate