<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via
 * web, è anche possibile copiare questo file in «wp-config.php» e
 * riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni MySQL
 * * Prefisso Tabella
 * * Chiavi Segrete
 * * ABSPATH
 *
 * È possibile trovare ultetriori informazioni visitando la pagina del Codex:
 *
 * @link https://codex.wordpress.org/it:Modificare_wp-config.php
 *
 * È possibile ottenere le impostazioni per MySQL dal proprio fornitore di hosting.
 *
 * @package WordPress
 */

// ** Impostazioni MySQL - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define('DB_NAME', 'scc');

/** Nome utente del database MySQL */
define('DB_USER', 'root');

/** Password del database MySQL */
define('DB_PASSWORD', 'root');

/** Hostname MySQL  */
define('DB_HOST', 'localhost');

/** Charset del Database da utilizzare nella creazione delle tabelle. */
define('DB_CHARSET', 'utf8');

/** Il tipo di Collazione del Database. Da non modificare se non si ha idea di cosa sia. */
define('DB_COLLATE', '');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Ciò forzerà tutti gli utenti ad effettuare nuovamente il login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'mYFJ+C.pq2S]9352A> y2t|Vkjf@Ml9_-JcBHxNa>-:<0q-u:v1Q@voZ|vaFp+/R');
define('SECURE_AUTH_KEY',  '/TYj~zLcbnqviq_x1suez{To=AHScfoig4k!`X&qe3Tm4]%X=ve3.RSGaG$*u22]');
define('LOGGED_IN_KEY',    'C|LYF4mmzQZ8034`:R:9MvkaXJ%tLPP-|MlxjGor+G.Yy/9Zi$n[@RncR3L-gRB_');
define('NONCE_KEY',        'b|J@VSa=%my|u*G:Ytrw7j4}Z5km-w9T~k}ai)1(+&t1hxpPV#57}V1&:y9s+vzn');
define('AUTH_SALT',        'sA+Q>UO9{9}Lt3}@ghzD`xx$S?SZ`tj;G+gaCLFj1LZn=%5osslB$LE/JO|nmFzt');
define('SECURE_AUTH_SALT', 'fa`@sZU~0WJPGmb[n!nY:b-t]$!53V0BU>QMNezN`[v=v^nks[n([T^]wco$y+&-');
define('LOGGED_IN_SALT',   '+G+<x%wY$6xf?=tsQSwLk Q3,_rEi9Bj0.Z,{,([Zrx52j1rRsRKqq4r8hKDQ%K8');
define('NONCE_SALT',       'LOxt/0uKm^fSs;,H[c.xOn_sY8s(qhC&g3yr> FT|SH:*3*ja_&<4[Z]6so`D>jZ');

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix  = 'scc_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi
 * durante lo sviluppo.
 * È fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 */
define('WP_DEBUG', true);

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Imposta le variabili di WordPress ed include i file. */
require_once(ABSPATH . 'wp-settings.php');
