# [@BotDuCul](https://twitter.com/BotDuCul)

Un bot Twitter qui énumère tous les mots de la langue française suivi de "du cul".

## Installation

Pour installer un BotDuCul, il vous faut :
* Une base de données MySQL
* Un serveur PHP
* Un accès développeur à l'API de Twitter

Suivez ces 5 étapes du cul :
1. Importez le fichier lexique.sql dans votre système de base de données et remplissez les variables dans un fichier dbinfo.php (`$dbhost`, `$dbname`, `$dblogin`, `$dbpassword`)
2. Créez une deuxième table de données pour stocker l'avancement du bot dans la première base et remplissez les variables dans le fichier dbinfo.php (`$dbAppName`, `$dbAppLogin`, `$dbAppPassword`)
3. Créez une application Twitter avec le compte du bot et remplissez les variables d'API dans le fichier twitterCredentials.php (`$oauthToken`, `$oauthTokenSecret`, `$consumerKey`, `$consumerSecret`)
4. Récupérez les librairies [TwitterAPIExchange.php](https://github.com/J7mbo/twitter-api-php) et [SafeTweet.php](https://github.com/WhiteFangs/SafeTweet) et mettez les dans le dossier parent du fichier BotDuCul.php
5. Lancez le fichier BotDuCul.php depuis votre serveur PHP et appréciez votre BotDuCul !

## Données

Les données Twitter des tweets du @BotDuCul sont disponibles dans leur repository dédié: [BotDuCul_tweets_data](https://github.com/WhiteFangs/BotDuCul_tweets_data)

## F.A.Q. du cul

### Qu'est ce que c'est ?

[@BotDuCul](https://twitter.com/BotDuCul) est un bot Twitter français qui tweete tous les mots (et expressions) de la langue française suivi de "du cul". Il poste toutes les demi-heures et suit plus ou moins l'ordre alphabétique.

### Qui a fait ça ?

Le créateur c'est moi, Bilgé Kimyonok, vous pouvez en savoir plus sur moi ou me contacter via mon [site](http://louphole.com/loup) ou mon compte Twitter [@White_fangs](https://twitter.com/White_fangs).

### Quand ?

J'ai créé le programme (l'ADN) du @BotDuCul le samedi 24 février 2018 aux alentours de midi. Il a commencé à tweeter à 13h. (Bon à savoir si vous voulez lui souhaiter son anniversaire !)

### Pourquoi ?

Parce que... du cul ?

J'avais déjà à mon actif une quinzaine de bots Twitter ([la liste](https://twitter.com/White_fangs/lists/white-fangs-twitter-bots)), certains intéressants, d'autres carrément absurdes et j'ai décidé d'en faire un de plus. L'idée originelle m'est venu à force d'entendre une collègue de bureau utiliser cette expression avec une multitude de mots variés. Je me suis aussi inspiré de bots Twitter classiques qui utilisent le même procédé d'énumération : [@everyword](https://twitter.com/everyword) ou encore [@CyberEveryword](https://twitter.com/CyberEveryword) par exemple (il y en a des dizaines d'autres du genre).

### Comment ?

Pour créer le bot, j'ai suivi ces étapes :

1. Récupérer une base de données de mots (et expressions) de la langue française : j'ai utilisé la base de données [Lexique 3](http://lexique.org/) au format SQL que j'utilisais déjà pour d'autres programmes

2. Écrire le programme PHP qui va récupérer le mot dans la base de données, y ajouter "du cul" puis le tweeter : j'ai réutilisé le script de la plupart de mes bots en PHP (le langage de mon serveur)

3. Créer une application avec un accès à [l'API de Twitter](https://developer.twitter.com/) : jusqu'en mai 2018, c'était l'affaire de quelques minutes avec le compte Twitter du bot, mais désormais il faut faire une demande pour un compte de développeur

4. Utiliser les identifiants de l'application créée dans le programme : il suffit de les renseigner au bon endroit pour que le programme tweete avec l'identité du bot

5. Installer le programme sur un serveur et mettre en place une tâche planifiée : j'ai téléchargé mon script PHP sur mon serveur et planifié une tâche à l'aide de [Cron-job.org](https://cron-job.org/en/) pour qu'il soit lancé toutes les demi-heures !

### Pourquoi y a-t-il aussi des expressions et des mots qui ne sont pas dans le dictionnaire ?

La base de données de termes qu'utilise le bot, [Lexique 3](http://lexique.org/), est constituée à partir d'un corpus de textes et de sous-titres de films. Ce n'est donc pas un dictionnaire à proprement parler, il y a notamment beaucoup d'expressions toutes faites qui ont leur entrée mais aussi de nombreux mots actuels, des abréviations et des mots du langage parlé qu'on ne trouve pas forcément dans le dico. Pour en savoir plus sur Lexique 3, lisez le [manuel détaillé](http://lexique.org/outils/Manuel_Lexique.htm).

### Pourquoi les mots du bot ne sont pas exactement dans l'ordre alphabétique ?

Initialement, j'ai créé le bot en une demi-heure sur un coin de table sans imaginer un seul instant qu'il aurait autant de popularité. Et donc, il était imparfait. Pour sélectionner les mots qu'il tweete, étant donné que Lexique 3 liste tous les mots dans toutes leurs déclinaisons (genre, nombre, conjugaisons), j'ai décidé de ne prendre que les lemmes. Un lemme est en gros la forme de base d'un mot, donc sans genre, sans nombre, ni conjugaison, tel qu'il apparaitrait dans le dictionnaire.

Or, les termes de ma base de données sont triés dans l'ordre alphabétique du *terme* et non du *lemme*, et mon programme ne refait pas le tri. Par exemple, l'entrée du terme "croustilla" (passé simple du verbe "croustiller") vient avant "croustillance" dans la base de données, car ça suit l'ordre alphabétique, du coup le lemme "croustiller" sera posté avant "croustillance" (lemme). 

Le temps que je me rende compte du problème, le bot avait déjà fait quelques erreurs d'ordre et le modifier risquait de créer des doublons et des retours en arrière. Par conséquent, je l'ai laissé tel quel et ces défauts d'ordre alphabétique font partie des imperfections du bot avec lesquels il devra vivre.

### Et les mots avec des accents ?

Même problème ! Dans le tri "alphabétique" de la base de données, les accents sont considérés comme des lettres qui viennent après le Z. Par conséquent, ils se retrouvent en fin de liste et chamboulent l'ordre établi !

J'ai néanmoins modifié manuellement l'ordre de la base pour que, à minima, les mots qui commencent par des lettres accentuées viennent juste après les mots de cette même lettre non accentuée. Sinon on aurait eu les "à propos" et tout autres termes qui commencent par des lettres accentuées après les mots en Z, c'aurait été facheux.

### Quand est-ce que le bot arrivera au mot ... ?

Je ne sais pas ! Et honnêtement je préfère garder la surprise. Mais il est possible d'estimer ça à la louche en se disant que le bot change de lettre à peu près tous les 2 mois (certaines lettres sont plus fournies que d'autres) et qu'il est supposé terminer sa mission en octobre 2020.

Bien sûr, il est possible à partir de la base de données de déterminer exactement quand sera tweeté tel mot, mais est-ce que ce n'est pas un peu divulgâcher la surprise et le plaisir ?

### Est-ce que tu peux ajouter le mot ... ?

Non, ça serait un peu de la triche sinon.

### Mais t'as déjà triché pour [la coupe du monde](https://twitter.com/BotDuCul/status/1018540705696944128)...

Oui, mais comme j'ai créé les règles du jeu, je fais ce que je veux.

### Est-ce que c'est drôle ?

Je ne sais pas. Personnellement, il y a quelques tweets qui m'ont fait bien rire mais je ressens une sorte de distanciation par rapport à l'humour potentiel du bot en tant que créateur de celui-ci. Je laisse les autres en juger (et d'après eux ça a l'air plutôt drôle).

### Est-ce que je peux envoyer un DM au bot ?

Oui, les DM du @BotDuCul sont ouverts. Je les lis en général, mais ni moi ni le bot n'y répondent. Je lis aussi les mentions et citations de temps en temps (il y en a beaucoup trop pour que je puisse vraiment tous les lire).

### Est-ce que je peux lire quelque part les retweets avec citations ?

Oui, une fois que le bot a terminé une lettre, je récupère tous les retweets avec mentions de ses tweets et je les ajoute au [Dictionnaire Collaboratif du Cul](http://louphole.com/projets/dictionnaire-du-cul/) ! On peut y lire toutes les propositions de sens trouvées par la communauté aux tweets du cul.

### Comment puis-je trouver le tweet du cul pour le mot ... ?

Tu peux utiliser le [Dictionnaire Collaboratif du Cul](http://louphole.com/projets/dictionnaire-du-cul/) si la lettre du mot est répertoriée. Sinon, tu peux faire une recherche sur Twitter avec entre guillemets le mot + du cul.

### Est-ce que le @BotDuCul existe sur d'autres plateformes ?

Oui, il existe sur [Mastodon](https://botsin.space/@botducul), même si je ne suis pas à l'origine de sa migration. Il existe aussi sur un forum Discord. C'est tout à ma connaissance, mais je veux bien découvrir d'autres de ces clones ailleurs !

### Y a-t-il des bots similaires au @BotDuCul ?

Il y en a, mais il y en a tellement que je ne saurai pas par où commencer pour les mentionner. Il y a des dizaines de bots "every" en anglais, dont quelques uns qui sont encore actifs : [@CyberEveryword](https://twitter.com/CyberEveryword), [@EverySheriff](https://twitter.com/everysheriff), [@EveryColorbot](https://twitter.com/everycolorbot), [@everypunk](https://twitter.com/everypunk), [@dsruptEveryword](https://twitter.com/DsruptEveryWord)...

### Et en français ?

Avant le @BotDuCul, il n'y en avait pas tellement sur le concept de l'énumération (à part peut-être [@queerDeLettres](https://twitter.com/queerdelettres)). Mais depuis, le bot en a inspiré pas mal : [@Bot_TesMorts](https://twitter.com/Bot_TesMorts), [@BotDuCoeur](https://twitter.com/BotDuCoeur), [@Botsupervnr](https://twitter.com/botsupervnr), [@BotTaMere](https://twitter.com/BotTaMere), [@Bot_20cm](https://twitter.com/Bot_20cm) et d'autres à venir !

### Est-ce que je peux faire un bot sur le même concept d'énumération ?

Oui, bien sûr. Fais toi plaisir !

### Est-ce que je peux migrer le @BotDuCul vers une autre plateforme ?

Sur le principe oui, mais je préfère être tenu au courant parce que je suis un peu comme son papa et ça serait comme voir son enfant s'en aller ailleurs avec inconnu !

### Comment se passe ta vie depuis la célébrité du @BotDuCul ?

Rien n'a fondamentalement changé mis à part les messages que je reçois de personnes qui me remercient pour la tranche de rire ponctuelle que le bot leur apporte. J'ai aussi eu pas mal de nouvelles visites sur mon [site perso](http://louphole.com) et des nouveaux followers sur mon compte Twitter ainsi que sur mes autres bots.

### Comment le @BotDuCul est devenu aussi connu ?

Je ne sais pas vraiment. Quelques personnes de mon entourage sur Twitter avec pas mal de followers l'ont partagé dans ses débuts et puis ça a décollé en quelques semaines avec d'autres gros comptes !

### Où puis-je trouver tes autres bots ?

J'ai une liste Twitter qui les répertorie : [ici](https://twitter.com/White_fangs/lists/white-fangs-twitter-bots).

### Et où puis-je trouver d'autres bots à suivre ?

J'ai créé une liste de bots Twitter français ([ici](https://twitter.com/White_fangs/lists/bots-fran-ais/members)) et sinon il y a plein de listes ailleurs, je recommande celle du site [Botwiki](https://botwiki.org/bots/) qui les répertorie par catégories.

### Est-ce que les archives du bot sont disponibles ?

Pas encore, mais je les rendrait publiques et téléchargeables une fois que le bot aura terminé sa mission !

### Pourquoi le mot ... n'a pas été tweeté ?

Il y a trois possibilités pour qu'un mot n'ait pas eu son tweet du cul : 
1. Il n'apparaît pas dans la base de données Lexique 3
2. Il n'a pas encore été tweeté à cause des problèmes d'ordre alphabétique (si la lettre est encore en cours)
3. Il a été filtré par mon système [SafeTweet](https://github.com/WhiteFangs/SafeTweet) qui prévient le bot de tweeter des mots offensants

### T'en occuper encore 2 ans est un sacré pari sur le long terme. Tu n'en auras pas marre avant ?

Il n'y a pas grand chose à faire pour s'en occuper à vrai dire, il tourne tout seul. J'ai aussi mes autres bots depuis plusieurs années maintenant et je continue à m'en occuper sans me lasser donc je ne me fais pas trop de soucis pour celui-ci.

## Licence

Le code source de @BotDuCul est publié sous licence MIT.
La base de données [Lexique](http://lexique.org) est sous [licence publique générale](http://lexique.org/public/license_lexique.htm) (inspirée de GNUv2).

© Bilgé Kimyonok - 2018
