# Exemple d'API en Laravel sécurisée avec JWT (contexte de la Compagnie Océane)
(TP AP SIO2 SLAM) 
Ce dépot contient une API Laravel utilisant une authentification avec des jeton JWT. Elle est prévue pour être exposée publiquement et consommée dans d'autres applications construites en TP.

## Environnement technique

Ce dépot est configuré pour être ouvert dans un Codespace construit depuis une image spécifique Debian-LAMP-PHP. Le Dockerfile complexe installe les dépendances, outils et services nécessaires au TP et des scripts Bash pour organiser le démarrage des services et les interactions avec la BDD.

## Arborescence du dépôt

Voici l'arborescence du dépôt et le rôle des différents composants. Les fichiers et dossiers à modifier sont en gras :

├── .devcontainer/ # config du codespace
|  ├── devcontainer.json # Configuration du Dev Container pour VS Code
|  └── Dockerfile # Dockerfile pour construire l'image du Dev Container  dans mariadb 
├── .github/ # config pour les alertes de dépendances (sécurité)
├── .vscode/ # config pour XDebug et paramètres de vscode
├── database # scripts pour la BDD
|  ├── scripts # contient 3 scripts bash : 1 pour initialiser la BDD métier (avec ses utilisateurs système), 1 pour sauver la bdd métier du codespace et 1 pour la recharger à partir du .sql présent dans le dépot
|  └── sources-sql # fichiers SQL pour contruire la BDD métier, ses utilisateurs et ses données 
├── site # Dossier racine du serveur web
├── start.sh # Script de lancement pour démarrer le service mariadb et les instances web du site et de phpMyAdmin.
└── stop.sh # Script pour arreter le service mariadb et les instances web du site et de phpMyAdmin.

## Configuration, lancement de l'application et persistance des données

Ce dépôt est configuré pour fonctionner avec les Codespaces de GitHub et les Dev Containers de Visual Studio Code. Suivez les étapes ci-dessous pour lancer les services.

### Serveur php et service mariadb (avec la base métier)

1. **Pour lancer les services** :
   - Dans le terminal, exécutez le script `start.sh` :
     ```bash
     ./start.sh
     ```
   Ce script démarre le serveur PHP intégré sur le port 8000, démarre mariadb et crée la base métier depuis le script renseigné (mettre à jour en fonction du projet).

2. **Ouvrir le service php dans un navigateur** :
   - Accédez à `http://localhost:8000` pour voir la page d'accueil de l'API.

3. **Accèder à la BDD** :
   - En mode commande depuis le client mysql en ligne de commande
   Exemple : 
      ```bash
      mysql -u mediateq-web -p
      ```
   - En client graphique avec l'extension Database dans le codespace (Host:127.0.0.1)

   - avec phpMyAdmin sur le port 8080

4. **initialiser la BDD** :
   - Au premier démarrage, créez la bdd métier avec le fichier sql 
      ```bash
      ./database/scripts/initBDD.sh 
      ```

5. **Sauver et mettre à jour la BDD** :
   - A chaque fois que vous avez fait des modifs significatives dans la BDD métier, lancer le script bash saveBDD pour écraser le fichier sql actuel de la bdd par votre sauvegarde (puis pensez à push sur le distant pour vos collaborateurs)
      ```bash
      ./database/scripts/saveBDD.sh 
      ```
   - Si des modifs ont été faites à la BDD et que vous avez récupéré du dépot distant (pull) une version mise à jour du script de la BDD métier, lancer le script bash reloadBDD pour écraser la bdd actuelle de votre codespace par celle du script récupéré.
      ```bash
      ./database/scripts/reloadBDD.sh 
      ```

> ℹ️ **Infos techniques : Problèmes de droits**
> si les scripts ne s'executent pas, c'est qu'il faut mettre à jour les droits dans le dépot :
>       ``` sudo chmod 777 *.sh ```
>       ``` sudo chmod -R 777 database/scripts/> ```

### Construire le projet Laravel :

Une fois l'environnement préparé, il faut parametrer et mettre à jour le projet Laravel en installant les élémenst qui ne sont pas dans le dépot (installation des dépendances, config bdd, secrets, liens symboliques, caches)

1. Aller dans le dossier site
```bash
cd site
```

2. Mettre à jour les dépendances PHP
```bash
composer update
```

3. Créer le fichier .env de Laravel en copiant le fichier d'exemple fourni par Laravel :
```bash
cp .env.example .env
```

4. Modifier les infos de connexion à la BDD dans le .env

5. Générer la clé d'application Laravel
```bash
php artisan key:generate
```

6. Générer la clé pour les jetons JWT
```bash
php artisan jwt:secret
```

7. Créer le lien symbolique pour le stockage des fichiers
```bash
php artisan storage:link
```

8. Vider les caches Laravel (recommandé après installation ou modif config)
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
```

9. Générer les caches optimisés (recommandé pour la production)
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### Exposer l'API publiquement
Pour exposer publiquement cette API, aller dans l'onglet "Ports" du terminal.
Faire un clic droit sur le service web (qui tourne sur le port 8080). Changer la visibilité du port en public.
Vous pouvez maintenant consommer cette API sans être connecté à votre compte Github. 
> **Attention** : le codespace s'arrete régulierement quand il est inactif

## Documentation de l'API

Cette API est documentée avec [Swagger](https://fr.wikipedia.org/wiki/Swagger_(logiciel)). Cette interface de documentation interactive est stockée dans le dossier public/API-doc du site. Elle est parametrée par le fichier `swagger.yaml` à la racine du dossier.

Pour accéder à la documentation en ligne, il faut ouvrir dans le navigateur la page API-doc/swagger-ui/index.html

> **important** : Pour faire fonctionner la doc, il faut modifier l'url d'accès dans le fichier yaml avec celle de votre codespace en cours d'execution.

## Utilisation de XDebug

Ce Codespace contient XDebug pour le débogage PHP. 

1. **Exemple de déboguage avec Visual Studio Code** :
   - Ouvrez le panneau de débogage en cliquant sur l'icône de débogage dans la barre latérale ou en utilisant le raccourci clavier `Ctrl+Shift+D`.
   - Sélectionnez la configuration "Listen for XDebug" et cliquez sur le bouton de lancement (icône de lecture).
   - Ouvrez un fichier php
   - Ajouter un point d'arrêt.
   - Solicitez dans le navigateur une page qui appelle le traitement
   - Une fois le point d'arrêt atteint, essayez de survoler les variables, d'examiner les variables locales, etc.

[Tuto Grafikart : Xdebug, l'exécution pas à pas ](https://grafikart.fr/tutoriels/xdebug-breakpoint-834)

