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
define( 'DB_NAME', 'idawwordpress' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '(w3ccj;U *> 9y1^M:xU(dh<*b^ndz2$O+6ZBN&c<x}G!sAq m@m#/3Qnk/90?Un' );
define( 'SECURE_AUTH_KEY',  '_^!|9s[_gpG&6l[Epk^D@MlBE7(;`wr+UO!^f$B],vXYn#0 |8[LXkyoB~(.j.*g' );
define( 'LOGGED_IN_KEY',    'H=S~c0R}}ih!EnIEbu9P;rjY8KrN#8N5|oI,$!2p~*r/l<hu][6` t@+WKIT2smR' );
define( 'NONCE_KEY',        'T$JX~N>YFa6gGBJ{B5|:~>0!?T+bcWgys5Vj(jh9?,0,[,[H,:)Zz`x`_iW6%I+T' );
define( 'AUTH_SALT',        '/y (9qP]vn;b2ZR*p#er/ASXo49TvC,e=2.#DZkj20AW/ET$6=-.sU+!QrLl{o7;' );
define( 'SECURE_AUTH_SALT', '0V<0`/4k}B<:c@P(){/Ih0JJ`}9/KxGmWw$$RP`W+0I.1MpJ)/A3=`,!rz-n&M5w' );
define( 'LOGGED_IN_SALT',   'BB_s`QyeId0P$XI6FfUM@j6U*[dnTjF99K=Q/K|ii>Z,,r)DAt;(4B=%hz`M>v<P' );
define( 'NONCE_SALT',       '!~Gbmcu&VsMud1.Zk9DP[y_`Y,3I0m 8<fwln!7Th?lj`Ei#EO0*P:>@ TDuU]=.' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
