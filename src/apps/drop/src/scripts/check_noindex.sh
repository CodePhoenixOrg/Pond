#!/bin/sh

echo > ~/Documents/output/check_robots.log;
for i in $(cat ~/Documents/input/noindex.txt|grep pond.loc |cut -d'/' -f4-);
do
    echo $i >> ~/Documents/output/check_robots.log;
    curl https://pond.loc/$i --cacert ~/certs/rootCA.crt|grep robots  >> ~/Documents/output/check_robots.log;
done;

