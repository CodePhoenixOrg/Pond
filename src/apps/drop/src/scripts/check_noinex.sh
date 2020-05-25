#!/bin/sh

echo > ~/Documents/output/check_robots.log;
for i in $(cat ~/Documents/input/noindex.txt|grep CodePhoenixOrg.fr |cut -d'/' -f4-);
do
    echo $i >> ~/Documents/output/check_robots.log;
    curl https://phoenix.photoprintit.lan/render/CodePhoenixOrg-fr/fr_FR_7884/$i --cacert ~/certs/CodePhoenixOrg_root_public.crt|grep robots  >> ~/Documents/output/check_robots.log;
done;

