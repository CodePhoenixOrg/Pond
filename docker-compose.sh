#!/bin/sh
docker-compose -f "docker-compose.yml" up -d --build
docker exec -t pond_php_1 /bin/sh -c "chmod 775 /usr/local/bin/hop; /usr/local/bin/hop"