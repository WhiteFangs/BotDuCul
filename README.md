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

## Licence

Le code source de @BotDuCul est publié sous licence MIT.
La base de données [Lexique](http://lexique.org) est sous [licence publique générale](http://lexique.org/public/license_lexique.htm) (inspirée de GNUv2).

© Bilgé Kimyonok - 2018