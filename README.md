# TP Docker - Organisation des étapes

## Objectif
Ce TP consiste à apprendre à utiliser Docker pour créer des containers, organiser des services et automatiser leur déploiement avec Docker Compose.

## Structure du projet
- `etape0` : Préparation (nettoyage, initialisation)
- `etape1` : Premier container (sans Docker Compose)
- `etape2` : Application + Base de données (sans Docker Compose)
- `etape3` : Utilisation de Docker Compose

## Instructions rapides
### Étape 0
Voir `etape0/README.md`.

### Étape 1
```bash
cd etape1
docker build -t etape1-image .
docker run -d -p 8080:80 etape1-image
