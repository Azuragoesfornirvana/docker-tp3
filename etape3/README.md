mkdir etape3
cd etape3

# docker-compose.yml
echo "version: '3.9'
services:
  data:
    image: mariadb:11.1
    environment:
      - MARIADB_RANDOM_ROOT_PASSWORD=yes
    volumes:
      - ./sql:/docker-entrypoint-initdb.d
    networks:
      - monreseau
  script:
    build: .
    volumes:
      - ./src:/app
    networks:
      - monreseau
  http:
    image: nginx:1.29
    ports:
      - '8080:80'
    volumes:
      - ./config/default.conf:/etc/nginx/conf.d/default.conf
      - ./src:/app
    networks:
      - monreseau
networks:
  monreseau:" > docker-compose.yml

# Construire et lancer
docker-compose up -d

**Constat :** En naviguant sur http://localhost:8080/test.php, tout fonctionne exactement comme à l’étape 2, mais avec Docker Compose.