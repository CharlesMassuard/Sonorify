# Sonorify
Ecoutez vos albums et musiques préférés, créez vos propres playlists et laissez vous tenter par les mieux notés dans l'accueil afin de découvrir de nouveaux talents, grâce à Sonorify !

![grandLogo](https://github.com/CharlesMassuard/Sonorify/assets/118757823/a6213d8d-e320-4b8f-8998-62b61c8c4cec)

<br><br>

## Host expiré

L'hébergement des musiques contenues dans l'application a expiré. Ainsi, les musiques présentes ne peuvent plus être lues. 
L'application peut toujours être utilisée, seulement la lecture n'est plus possible.

## Technologies

Sonorify est codée en PHP et JS. La mise en place d'une SPA a été effectuée afin d'apporter un confort d'écoute à l'utilisateur.  

## Installation 

L'application n'est pour le moment pas hebergée. Afin de l'utiliser, téléchargez les fichiers sources grâce à la *Release* de *GitHub*.

### Requirements  

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

## Module administrateur

Pour se connecter en tant qu'administrateur, veuillez utiliser les logins suivants:
```txt
Login: admin
Password: admin
```

> *La BD est une BD locale, ce qui implique que chaque utilisateur peut se connecter en tant qu'administrateur, ce qui n'affectera pas les autres utilisateurs*
<br>

-----

*Ce projet a été réalisé dans le cadre d'une SAÉ lors de la deuxième année de BUT Informatique.*

*MASSUARD Charles, LUDMANN Dorian, HAUDEBOURG Baptiste*
