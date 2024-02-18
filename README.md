https://github.com/jordanlavenant/SAE-WEB-PHP

## SAE 4.01 DÉVELOPPEMENT WEB : Musics 2024

Le projet consiste à réaliser une application web en PHP utilisant la bibliothèque PDO pour afficher et gérer les données d'une base de données SQLite contenant des informations sur des albums de musique et des artistes.


### Liste des membres du groupe

* Anna LALLIER
* Jordan LAVENANT
* Colin PILET


### Versions
* Version initiale : v1.0 le 18/02/2024

### Prérequis

#### 1. PHP
#### 1.1 Télécharger php 
Rendez-vous sur le ``https://www.php.net/downloads.php`` et téléchargez une version stable de php, selon votre système d'exploitation.
#### 1.2 Ajouter php dans vos variables d'environnements

**Windows**

* Ouvrez le menu démarrer, puis tapez et ouvrez : ``Modifier les variables d'environnements systèmes``.
* Ouvrez ensuite l'onglet ``Variables d'environnements``
* Dirigez-vous vers l'onglet ``Variables système``, puis double-cliquez sur la ligne ``Path``.
* Cliquez sur ``Ajouter`` et collez le chemin de téléchargement du dossier php (cf. étape 1.1). Veillez à ajouter le dossier racine qui comporte le nom ``php-X.X.X-Win32-vs16-x64``.
* Cliquez ensuite sur ``Ok``, jusqu'à avoir fermé toutes les fenêtres, en ayant bien vérifié le chemin rentré.
* Enfin, ouvrez un terminal en tapant ``cmd`` dans le menu démarrer, puis tapez : ``php --version``

**Linux**

``sudo apt-get install php``

#### 2. Driver PDO

Récupérez le fichier ``php.ini`` situé dans le dossier ``config/`` du projet, et déplacez-le dans le dossier ``php-X.X.X-Win32-vs16-x64`` que vous avez téléchargé préalablement. Si le fichier ``php.ini`` existe déjà, remplacez-le. 

Ce fichier permet l'intialisation des extensions associés à PHP ; il contient une pré-configuration, nécessaire au bon fonctionnement de notre application web.
  
### Lancement de l'application

Clonez le dépôt depuis votre machine locale

    git clone 

Accédez au répertoire du projet

    cd SAE-WEB-PHP
    
Depuis le dossier `SAE-WEB-PHP`, entrez la commande

    php -S localhost:8080

Ouvrez votre navigateur web et accédez à l'adresse suivante :

    http://localhost:8080


### Documentations

Vous trouvez dans le dossier `Documentations`: 

* **Le Modèle Conceptuel de Données (MCD):** Diagramme représentant les entités et les relations de la base de données
* **Le Diagramme des classes:** Diagramme UML représentant les classes du code
* **Plusieurs diagrammes d'activités:** Diagrammes représentant le déroulement d'une fonctionnalité

### Bonus implémentés

* **Inscription / Login Utilisateur:**
    * Permettre aux utilisateurs de créer un compte et de se connecter
    * Gérer les sessions utilisateurs
* **Playlists par utilisateur:**
    * Permettre aux utilisateurs de créer des playlists
    * Ajouter des albums aux playlists
    * Supprimer des albums des playlists
* **Système de notation des albums:**
    * Permettre aux utilisateurs de noter les albums
    * Afficher la note moyenne des albums
* **Favoris par utilisateur:**
    * Permettre aux utilisateurs d'ajouter des albums à leurs favoris
    * Supprimer des albums des favoris
* **Thèmes par utilisateur:**
    * Permettre aux utilisateurs de choisir un thème pour l'application
    * Sauvegarder le thème choisi pour la prochaine connexion
* **Mise en ligne du site:**
    * À des fins d'expérimentation, nous avons aussi mis le site en ligne à l'adresse suivante : [Visual Studio Music](http://vonpilaaf.fr). Nous vous recommandons cependant de tester le site en local pour une meilleure expérience utilisateur.
