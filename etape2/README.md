mkdir etape2
cd etape2
mkdir config src sql

# Copier fichiers test.php et create.sql fournis
cp ../archives_tp3/test.php src/
cp ../archives_tp3/create.sql sql/

# Créer réseau Docker
docker network create monreseau2

# Lancer DATA (MariaDB)
docker container run -d --name data --network monreseau2 -v $(pwd)/sql:/docker-entrypoint-initdb.d -e MARIADB_RANDOM_ROOT_PASSWORD=yes mariadb:11.1

# Lancer SCRIPT (PHP-FPM) avec extension mysqli via Dockerfile
echo -e "FROM php:8.2-fpm\nRUN docker-php-ext-install mysqli" > Dockerfile
docker image build -t php-mysqli .
docker container run -d --name script --network monreseau2 -v $(pwd)/src:/app php-mysqli

# Lancer HTTP (Nginx)
docker container run -d --name http --network monreseau2 -p 8080:80 -v $(pwd)/config/default.conf:/etc/nginx/conf.d/default.conf -v $(pwd)/src:/app nginx:1.29

**Constat :** En naviguant sur http://localhost:8080/test.php, les requêtes CRUD sur MariaDB fonctionnent correctement.
