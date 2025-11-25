# Étape 0 - Préparation

## 1. Nettoyer l'environnement Docker
Stopper et supprimer tous les containers existants :
```bash
docker stop $(docker ps -aq)
docker rm $(docker ps -aq)
