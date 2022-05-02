# **RaisiX**
```
Site web de Streaming films et séries gratuit.
```

## **Pre-requis**
> - [Apache 2.4.39](https://httpd.apache.org/download.cgi)
> - [PHP 7.4.0](https://www.php.net/downloads.php)
> - [MySQL 5.7.26](https://www.mysql.com/fr/downloads/)

—————————————————

```DIFF
+ 🔄｜Mise à jour : lun. 02 mai. 2022 16:00
```
—————————————————

🔨｜ ***En cours***\
`Slider page d'accueil`
> -「✔️」｜📽️｜Films a l'affiche\
> -「❌」｜❤️｜Films favoris\
> -「🔄」｜🎟️｜Films à venir\
> -「🔄」｜🎟️｜6 Derniers Films ajouté

—————————————————

🍿| ***A venir***
> -「🔄」｜  ｜Page Gestion Films                     [en cours]\
> -「🔄」｜  ｜Page Gestion des demande de Films      [en cours]\
> -「🔄」｜  ｜Finir l’afffichage des slider\
> -「🔄」｜🖥｜Créer la page avec tous les films avec des filtres (catégoris, date de sortie, qualité)\
> -「🔄」｜📣｜Post discord film publier\
> -「🔄」｜🎟️｜Slider de films 16 derniers films sortie\
> -「🔄」｜🤸｜Affichage des acteurs\
> -「🔄」｜👀｜Affichage des Films en Front\
> -「🔄」｜🛠️｜Optimisation du backOffice\
> -「🔄」｜📊｜Tracking user (Film view, catégorie)\
> -「❌」｜🛠️｜Création d'un script pour le choix des qualités de film [.m3u8] (php)\
> -「❌」｜📲｜Connection avec 2FA (Google Authentificator)\
> -「❌」｜  ｜Gestion Commentaire\
> -「❌」｜  ｜Gestion Catégorie\
> -「❌」｜  ｜Mise en place de [Web Sockets] pour les notification

—————————————————
###  **Version** - *0.2.0*
`｜: : : ADD : : :｜`
```DIFF
+「✔️」｜Ajout bouton Discord
+「✔️」｜Ajout bouton download RaisiX app
+「✔️」｜Création git raisix app
+「✔️」｜Page coming soon
+「✔️」｜Bouton Discord
+「✔️」｜Bouton download RaisiX app
+「✔️」｜Liste acteur dans la page detail
+「✔️」｜Webhook Discord : Ajout d'un film dans la bibliothèque
```
`｜: : : FIX : : :｜`
```FIX
-「✔️」｜⚡｜Optimisation du chargement page home  [~2s to ~600ms]
-「✔️」｜🕵｜Mise en place de QOS sur apache       [FireWall] (DDOS)
-「✔️」｜⚠｜error angular [TypeError: g is not a function]
-「✔️」｜Erreur de connexion lié au domaine du cookies (raisix / raisix.fr)
-「🔄」｜Tous les liens sans page redirige vers coming soon
-「✔️」｜Design lecteur video Netflix
```
—————————————————
###  **Version** - *0.1.6*
`｜: : : ADD : : :｜`
```DIFF
+「✔️」｜👨‍👦‍👦｜Gestion multi users connecté
+「✔️」｜💾｜Téléchargement des images en local lors de l'ajout d'un film
+「✔️」｜🔐｜Ajout d'un captcha lors de la connection
-「🔄」｜✏️｜Page Gestion Films                [en cours] [Antoine 😎]
-「🔄」｜✏️｜Page Gestion des demande de Films [en cours] [Antoine 😎]
```
`｜: : : FIX : : :｜`
```FIX
-「✔️」｜*️⃣️｜Vérification des caracteres du mot de passe (JS)
-「✔️」｜  ｜Marge Slider sur la page d'accueil
-「✔️」｜⚙｜Load Js
-「✔️」｜↩️｜Redirection après inscription
-「✔️」｜📱｜Responsive page inscription
-「✔️」｜📱｜Nouveau design listes des films
-「✔️」｜🔔｜Nouveau design de notification
```
—————————————————
###  **Version** - *0.1.5*
`｜: : : ADD : : :｜`
```DIFF
+「🌎」｜Create domain name raisix.fr
+「🔒」｜Active SSL/TLS Secure
+「⏩」｜Active Protocol http/2
+「✔️」｜Page Movie Detail
```
`｜: : : FIX : : :｜`
```FIX
-「✔️」｜  ｜Slider Home
-「✔️」｜  ｜Name in Pages
-「✔️」｜⚙｜Load Js
-「✔️」｜📱｜Design / Responsive
-「✔️」｜⚙｜Angularjs Function commune
-「✔️」｜⚙｜Call jQuery Function
-「✔️」｜⚙｜UpDate jQuery version to 3.6
-「✔️」｜⚙｜UpDate Waypoints
-「✔️」｜↩️｜url_redirect
```
—————————————————
### **Version** - *0.1.4*
`｜: : : ADD : : :｜`
```DIFF
+「✔️」｜💾｜Enregistrer les infos des films en bdd
+「✔️」｜🗃️｜Selection du dossier du film avec qualité disponible
+「✔️」｜Slider sur la page d'accueil fonctionnel
```
`｜: : : FIX : : :｜`
```FIX
-「✔️」｜Design tempale
-「✔️」｜Traduction tempale
```
—————————————————
### **Version** - *0.1.3*
`｜: : : ADD : : :｜`
```DIFF
+「✔️」｜Ajout de film via The Movie Database (TMDB)
+「✔️」｜Affichage des films sur la page d'accueil
+「✔️」｜Notification lors ajout d'un film
```
`｜: : : FIX : : :｜`
```FIX
-「✔️」｜Se souvenir de moi lors de la connexion
-「✔️」｜Redirection après la reconnexion
```
—————————————————
### **Version** - *0.1.2*
```DIFF
+「✔️」｜Se souvenir de moi lors de la connexion
+「✔️」｜Template Dashboard simplifié 
+「✔️」｜Page de confirmation mail
+「✔️」｜Page accès Dashboard
```
—————————————————
### **Version** - *0.1.1*
```DIFF
+「✔️」｜Création du module de connexion
+「✔️」｜Gestion du compte user
```
—————————————————
### **Version** - *0.1.0*
```DIFF
+「✔️」｜Template front simplifié
```
—————————————————
### **Version** - *0.0.2*
```DIFF
+「✔️」｜Choix du nom du projet 
+「✔️」｜Création du logo version 1
```
—————————————————
### **Version** - *0.0.1*
```DIFF
+「✔️」｜Choix du design
```