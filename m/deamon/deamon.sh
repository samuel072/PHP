#!/bin/bash

pushd /var/www/html/m/deamon
php ./deamon.php >>/tmp/deamon.txt
php ./build_index.php >>/tmp/coreseek.txt
popd
