<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'francoishq444');


/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'francoishq444');


/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'yGFVGKafvuYH1');


/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'francoishq444.mysql.db');


/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');


/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'F93a[,^$WdXh[x|11Bd`MmGBTT;,<<cxfI/:oAtkUNYTsX)/|<a~]*w6Mw^Vz&|?');
define('SECURE_AUTH_KEY', '=*YeobfII-J)OXog( 0gdiwrRTnr,O&?mh|ALMV(_n^i-MaWi|(2Gp$L~=uGw^}z');
define('LOGGED_IN_KEY', 'W~R<&5Qc%.)+Pls]2lCJ#eG[:;.q*CH,7zCRI)%L?`R>7>tt^iI_K,+%v,|fGO=u');
define('NONCE_KEY', '(-7DC@q7-t~BNO!=3<Aas!qKEUHi6#lmAfA%.<jAOlV4Gz}PP/Z`xFj<9WFV%Wdi');
define('AUTH_SALT', '1JGOt^RnN=V?JeFYL=ywT6nE=Z[8P/F`c01C,yv9)l2XCih@s-VQb{xplk|v:UF2');
define('SECURE_AUTH_SALT', 'lRQn]Ur;q#GyPk.{+EG2rkyG_boa,z0ea{-LkY8 L#kCE196Y16~Ed{&6q&j%W,/');
define('LOGGED_IN_SALT', 'Bcj6B48Az4X?OUMD0hFrW&PX943JU3!I(t!_Auwv+g:P* ]?}MKOd!.YfOWlP. V');
define('NONCE_SALT', '4;F3(>S?-)A~KoV[u9`2runwk@]b%6fEPR,K[T3^%#&@&),]tB&Ec<&7nIn*!C!`');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wpcvfj_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if (! defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
