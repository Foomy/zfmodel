<?php


$workspacePath = '/var/www';

$fieldsToSkip = array(
	'id',
	'created',
	'modified',
);

define('CODER_NAME', 'Sascha Schneider');
define('CODER_EMAIL', 'foomy@sirfoomy.de');


/******************************************************************************
 * Warning! Changes on the following options may break zfmodel application.
 */

defined('PROJECT_NAME')
	|| define('PROJECT_NAME', $argv[1]);

defined('PROJECT_PATH')
	|| define('PROJECT_PATH', $workspacePath . '/' . PROJECT_NAME);

defined('MODEL_PATH')
	|| define ('MODEL_PATH', PROJECT_PATH . '/application/models');

defined('DBTOOL_PATH')
	|| define('DBTOOL_PATH', realpath(dirname(__FILE__)));

set_include_path(implode(PATH_SEPARATOR, array(
	get_include_path(),
	DBTOOL_PATH,
	DBTOOL_PATH . '/library/',
	DBTOOL_PATH . '/templates'
)));

defined('TAB')
	|| define('TAB', "\t");

defined('DONE')
	|| define('DONE', "[OK]");

defined('DONE_NEWLINE')
	|| define('DONE_NEWLINE', DONE . PHP_EOL);

defined('ABSTRACT_FILENAME')
	|| define('ABSTRACT_FILENAME', 'Abstract.php');

