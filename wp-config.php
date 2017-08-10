<?php
// Report simple running errors
error_reporting(E_ERROR);
/**
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'harasmoradanovacombrsite');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'harasmoradansite');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'f0S#z8');

/** nome do host do MySQL */
define('DB_HOST', 'mysql.task.com.br');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&|:#k}i,+=80^yTN+,-+@7PsBdx 16uw,1&aZ|;-OQ`-,l4oTS5;09:hp#B$C^D%');
define('SECURE_AUTH_KEY',  '`p*c92cy}2>qi7ux(F]$(Y*ag#h}K+MIw28,ElY3-:+*e770/,RN24cB}Q.]H;rD');
define('LOGGED_IN_KEY',    '!XLMg ;u*i`^pcaIG}d:3K4Zb^,CL]B$_D&kcJuKQ~oGh<b]E5)A9=VH+--:OY;2');
define('NONCE_KEY',        'a-AS,#WSJe~>mvQI%{-B h->So3G<vUh=Alh9U-aR?B$;DgJDGvCNs8;!>Y#W=`0');
define('AUTH_SALT',        '~.zXyO>~+u<`@l7<.(2X[V?P-T+X=&,s7^[Dr AW<5t>lZn9jMR-z~g?lVh![;z[');
define('SECURE_AUTH_SALT', 'p8j@Py)1=jt~9C`O-$l)fK9*I9eEO&gFZ=NBI++,d+B&uWoBN5>`Fcp7V>X;|xo7');
define('LOGGED_IN_SALT',   '+Y[z)CYp=E1||s_9szk5BAIxRq_>L)N^cH6C~o5jN0(U+u4.{Weol=52xjp,yi0c');
define('NONCE_SALT',       '9Pq{P)r<g+I(O|ko+Le|.@]m+@v(`ang8X]`VF~II =$=:c?:<vK%~K>z:w98m~0');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_HMN_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
@ini_set( 'log_errors', 'off' );
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 'off' );

define('FS_METHOD','direct');

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
