jtxvideo
========

Ce dépôt contient le code source du site Internet destiné à faire office de moteur de recherche pour les vidéos du JTX.

##Utilisation

Pour naviguer sur le site, installez les fichiers source sur votre serveur et importez la base de données `jtxvideo.sql`. Vous ne verrez pas les images ni les vidéos, elles sont pour l'instant codées en dur.

##Fonctionnalités

- [x] Gestion des utilisateurs.
- [x] Base de données de vidéos avec métadonnées.
- [x] Moteur de recherche sur les vidéos avec recherche par :
  - [x] mots contenus dans le titre ;
  - [x] tags.
- [x] Filtrage des résulats par :
  - [x] promotion ;
  - [x] année ;
  - [x] JTX ;
  - [x] catégorie.
- [x] Ajout de vidéos dans la base de données :
  - [x] affichage de la structure du serveur pour choisir la vidéo ;
  - [ ] mise à jour des données des vidéos par les admins.
- [ ] Autocomplétion
- [ ] Gestion des admins.
  
##Comment ça marche

###Pages du site
Le site ne comporte qu'une seule page, `index.php`. Le contenu de cette page est généré dynamiquement en fonction des différents paramètres passés en `GET`. Seule la racine du serveur est accessible par le client, les sous-dossiers sont protégés.

###Structure de `index.php`
1. Démarrage de la session sur le serveur et sécurisation de `POST` et `GET`.
2. Actions relatives à la gestion des utilisateurs, activées si l'URL contient un `todo=` rempli par un formulaire.
3. Vérification de l'existence de la page demandée et attribution du titre.
4. Génération de l'en-tête HTML avec le CSS qui va bien.
5. Génération de la barre de navigation (deux versions en fonction de la page demandée).
6. Appel du script PHP de génération du contenu en fonction de la page demandée.
7. Génération des pieds de page.
8. 

###Dossiers
* `contenu` contient les scripts PH appelés à l'étape 5. de la section précedente.
* `css` contient [Bootstrap](http://getbootstrap.com/) et `perso.css`, fichier où est rassemblé tout le CSS supplémentaire.
* `fonts` contient les polices du site, dossier généré par Bootstrap.
* `js` contient le Javascript de Bootstrap et `code.js` où est rassemblé tout le code jQuery supplémentaire (et chargé sur toutes les pages).
* `media` contient les images nécéssaires aux pages du site en général (ne contient pas les posters des vidéos).
* `navbar` contient les scripts PHP de génération des barres de navigation.
* `utilities` contient tous les fonctions PHP utiles à la génération des pages, ansi qu'à l'interaction avec la base de données :
  * `connexion` contient les fichiers relatifs à la gestion des utilisateurs ;
  * `database` s'occupe de la base de données, on a notamment dedans tous les fichiers de classes PHP avec lesquelles sont gérées les résultats des requêtes ;
  * `display` contient `display.php`, avec toutes les fonctions qui génèrent du code HTML pour l'affichage des éléments dans les pages du site ;
  * `search` contient le code du moteur de recherche, à base d'expressiosn régulières et de requêtes SQL bricolées ;
  * le dossier contient aussi la liste des pages existantes sous format XML et des fichiers PHP pour la gestion des pages.
