<?php

/**
 * @todo	May using Zend_View and view scripts for this templates.
 */

$tplTableRow = array(
	'path' => MODEL_PATH . '/Table/',

	'lines' => array(
		'<?php',

		'',
		'/**',
		' * Table row class for the model of [project].',
		' *',
		' * @author'.TAB.TAB.'zfmodel <zfmodel@sirfoomy.de>',
		' * @author'.TAB.TAB.'[coderName] <[coderEmail]>',
		' *',
		' * @category'.TAB.'model',
		' * @package'.TAB.TAB.'[tableRowClassName]',
		' */',
		'class [tableRowClassName] extends Zend_Db_Table_Row_Abstract',
		'{',
	)
);
