#!/bin/sh
cd /var/www/html/laravelpoc_build/
git stash
git pull --no-edit

rsync -avzh /var/www/html/laravelpoc_build/ /var/www/html/laravelpoc/

cd /var/www/html/laravelpoc/
php artisan migrate
echo "Deployment Done.."
