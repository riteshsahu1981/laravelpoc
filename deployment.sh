#!/bin/sh
cd /var/www/html/laravelpoc_build/
git stash
git pull --no-edit
chmod -R 755 /home/ubuntu/laravelpoc_build/
rsync -avzh /home/ubuntu/laravelpoc_build/ /var/www/html/laravelpoc/

chmod -R 755 /var/www/html/laravelpoc/
cd /var/www/html/laravelpoc/
php artisan migrate
echo "Deployment Done.."
