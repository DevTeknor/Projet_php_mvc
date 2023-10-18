Projet PHP POO, structure MVC, utilisation de Twig avec Composer
###################################################################

Lancement du site :
/1. init.sql pour initialiser la DB (mysql)
/2. A la racine du projet : php -S localhost:8000 server.php
/3. Point d'entrée du site --> http://localhost:8000/login
/4. Identifiants de connexion (pour tester les 3 rôles) : Leag/mdpLeag (Admin), Imas/mdpImas (Modérateur), Mada/mdpMada (Visiteur)

###################################################################

Notes :

Se trouvent, à de nombreux endroits dans mon code, des commentaires pour des choix ou des explications spécifiques.

Au niveau de l'architecture/arborescence, j'aurais pû faire plus simple en incluant par exemple les ajouts d'utilisateurs/missions dans les mêmes fichiers que les affichages... J'y ai pensé plus tard, mais étant limité en temps, je me suis dis que bien ce soit plus compliqué, j'allais rester comme c'est actuellement. Au moins, ca montre que j'ai compris !

Je n'ai finalement pas inclu de dossier datas, n'ayant pas tout compris et voulant prioriser le fait d'avoir une application complète et fonctionnelle. Structure MVC (Model, View, Controller) -> de ce coté tout est présent.

J'ai utilisé un logiciel de génération de palettes de couleurs pour le site, sont donc normaux les codes couleurs #xxxxxx.
Les images (et globalement les liens link pour css, et toutes les images), pour moi mais ainsi que pour tous les collègues avec qui j'ai pu échanger, ne veulent pas s'afficher malgré d'importants efforts de recherche.

Le CSS est globalement simple vu que ce n'était pas le coeur du projet, mais j'ai quand même fait un minimum.

Liste des fonctionnalités :

- Utilisation de Twig, complexe en 2/3 jours + le reste mais ça me semble correct.

- Différents profils (stockés dans la DB) pour la connexion et les fonctionnalités disponibles en fonction des rôles.
  --> déconnexion possible pour éviter que quelqu'un puisse faire "revenir en arrière" (sur un profil admin par exemple). Si qqun tente --> error.

- -Inscription d'un utilisateur et connexion automatique.

- $_ SESSION pour sauvegarder le nom tout au long de la navigation + $_ POST pour récupérer les données des forms, en plus du $ SERVER pour le routeur.

- En fonction du rôle, pas le même header, et donc pas le même menu et les mêmes possiblités.

- Connexion à la DB et CRUD sur toutes mes tables (sans le Update, mais delete + create suffira pour l'exemple, je me suis plutôt penché sur la structure, twig et les fonctionnalités de base).

- Beaucoup de données automatiquement définies lors de la création de missions, users (fonctions date() et lastInsertId() de pdo entre autre).
