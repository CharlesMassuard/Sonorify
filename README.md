# SAE_PHP

## Contributeurs

- LUDMANN Dorian
- MASSUARD Charles
- HAUDEBOURG Baptiste
  
## À propos

Cette application web offre un service streaming de musiques en ligne.  
Vous pouvez écouter vos albums et musiques préférés ou même faire vos propres playlists. Laissez vous tenter par les mieux notés dans l'accueil afin de découvrir de nouveaux talents !  

## Module administrateur

Pour se connecter en tant qu'administrateur, veuillez utiliser les logins suivants:
```txt
Login: admin
Password: admin
```

> *La BD est une BD locale, ce qui implique que chaque utilisateur peut se connecter en tant qu'administrateur, ce qui n'affectera pas les autres utilisateurs*

## Requirements  

L'application a donc besoin de PHP, mais aussi d'un de ses modules: PDO.  
Voici quelque commandes afin d'installer toutes les dépendances nécéssaires au bon fonctionnement de l'application sous Linux.  

Vous pouvez suivre l'installation étape par étape ci-dessous ou alors éxécuter la commande suivante à la racine du projet afin d'automatiser le processus d'installation :
```bash
./requiments.sh
```

Détails des commandes:
Commençons par mettre à jour les applications disponibles sur le apt install à l'aide de la commande suivante:  
```bash
sudo apt-get update && sudo apt-get upgrade
```

Pour installer php:
```bash
sudo apt-get install php
```

Pour installer PDO:
```bash
sudo apt-get install php-sqlite3
```

## Lancement de l'application

Pour lancer l'application, ouvrez un terminal dans le répertoire où ce README se trouve et effectuez la commande suivante:  
```php
    php -S localhost:8080
```

## Technologies

Notre application est codée en PHP et JS. La mise en place d'une SPA a été effectuée afin d'apporter un confort d'écoute à l'utilisateur.  
