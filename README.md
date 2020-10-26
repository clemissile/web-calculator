
# Web App Calculatrice

Ce projet est une calculatrice qui permet d'effectuer les quatre opérations de base : l'addition, la soustraction, la multiplication et la division, tout en respectant la priorité des opérations.

Cette application fonctionne avec les frameworks Symfony 4 pour le backend et VueJs pour le frontend. Le style très simple utilise SCSS, sans framework particulier.

Le backend Symfony implémentant une API REST permettant les trois requêtes suivantes :
* GET       /api/history : récupère le contenu du fichier texte
* POST      /api/history : stocke le résultat du calcul, la date et l'heure dans le fichier texte
* DELETE    /api/history : supprime le fichier texte

On stocke les résultats des opérations dans un fichier texte au clic de l'utilisateur. Ce dernier est stocké dans le cache de Symfony. Les calculs sont gérés par le frontend, seul le résultat est envoyé au backend pour stockage. Les deux communiquent via des requêtes HTTP.

## Fonctionnalités

* Calcul d'additions, de soustractions, de multiplications et de divisions
* Gestion de calculs avec des chiffres négatifs (bouton +/-)
* Gestion de pourcentage (bouton %) : 37 deviendra 0.37
* Remise à zéro du calcul en cours
* Enregistrement du calcul au clic sur le bouton Enregistrer
* Mise à jour automatique de l'historique de calcul
* Gestion des messages de succès/erreur via des snackbars
* Possibilité de supprimer l'historique de calcul complet


## Installer et lancer le projet

Récupérer le projet à l'aide de Git

```sh
$ git clone https://github.com/clemissile/web-calculator.git
```

Installer composer et les dépendances de node

```sh
$ cd web-calculator
$ composer install
$ npm install
```

Compiler les fichiers js et css

```sh
$ ./node_modules/.bin/encore dev 
```

Lancer le serveur Symfony

```sh
$ php bin/console server:run
```
L'application est disponible à l'URL suivante : [http://localhost:8000](http://localhost:8000)
