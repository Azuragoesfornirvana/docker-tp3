mkdir etape1
cd etape1
mkdir config src

# Créer index.php
echo "<?php phpinfo(); ?>" > src/index.php

# Modifier default.conf pour PHP-FPM
# Décommenter et remplacer les lignes 30 à 36 par :
# location ~ \.php$ {
# root /app;
# fastcgi_pass script:9000;
# fastcgi_index index.php;
# fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
# include fastcgi_params;
# }

# Créer réseau Docker
docker network create monreseau1

# Lancer SCRIPT (PHP-FPM)
docker container run -d --name script --network monreseau1 -v $(pwd)/src:/app php:8.2-fpm

# Lancer HTTP (Nginx)
docker container run -d --name http --network monreseau1 -p 8080:80 -v $(pwd)/config/default.conf:/etc/nginx/conf.d/default.conf -v $(pwd)/src:/app nginx:1.29

**Constat :** Les containers HTTP et SCRIPT communiquent via le réseau monreseau1. En naviguant sur http://localhost:8080, phpinfo() s’affiche correctement.
