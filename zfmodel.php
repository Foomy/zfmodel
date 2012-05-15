<?php

/**
 * @todo	Use Zend_View for templates.
 */

if ($argc <= 1) {
	echo 'zfmodel is a PHP-CLI tool, which helps you to create a model for a zend project.' . PHP_EOL;
	echo PHP_EOL . 'Usage:' . PHP_EOL;
	echo "\tphp dptool <Name des Zendprojekts>" . PHP_EOL;
	exit();
}

require_once 'config.php';
require_once 'Foo/String.php';
require_once 'Db/Mysql/Factory.php';
require_once 'Db/Analyser.php';

include_once 'tableAbstract.php';
include_once 'tableRowAbstract.php';
include_once 'table.php';
include_once 'tableRow.php';
include_once 'getter.php';
include_once 'setter.php';
include_once 'fieldConstant.php';



// Connect to the databse;
$db = null;
$dbc = array();
$dbcFile = MODEL_PATH . '/' . PROJECT_NAME . '.dbc';

if (file_exists($dbcFile)) {
	include $dbcFile;

	$db = Db_Mysql_Factory::create($dbc);

	if (null === $db) {
		exit();
	}

	/*
	 * Create abstract classes
	 * <projectdir>/application/models/Table/Abstract.php
	 * <projectdir>/application/models/Table/Row/Abstract.php
	 */
	$dir = MODEL_PATH . '/Table';
	if (!is_dir($dir)) {
		echo 'creating: ' . $dir;
		mkdir($dir);
		echo '   ' . DONE_NEWLINE;
	}

	echo 'Creating abstract table class...';
	if (isset($tplTableAbstract) && is_array($tplTableAbstract)) {
		if (array_key_exists('lines', $tplTableAbstract) && is_array($tplTableAbstract['lines'])) {
			$fileHandle = fopen($dir . '/' . ABSTRACT_FILENAME, 'w');

			foreach ($tplTableAbstract['lines'] as $line) {
				fputs($fileHandle, $line . PHP_EOL);
			}

			fclose($fileHandle);
		}
	}
	echo '   ' . DONE_NEWLINE;

	$dir = MODEL_PATH . '/Table/Row';
	if (!is_dir($dir)) {
		echo 'Creating: ' . $dir;
		mkdir($dir);
		echo '   ' . DONE_NEWLINE;
	}

	echo 'Creating abstract table row class...';
	if (isset($tplTableRowAbstract) && is_array($tplTableRowAbstract)) {
		if (array_key_exists('lines', $tplTableRowAbstract) && is_array($tplTableRowAbstract['lines'])) {
			$fileHandle = fopen($dir . '/' . ABSTRACT_FILENAME, 'w');

			foreach ($tplTableRowAbstract['lines'] as $line) {
				fputs($fileHandle, $line . PHP_EOL);
			}

			fclose($fileHandle);
		}
	}
	echo '   ' . DONE_NEWLINE;

	/*
	 * Analyse database and create a row and a table for each database table;
	 */
	echo 'Analyzing database structure...';
	$analyser = new Db_Analyser($db);
	$analyser->analyse();
	$tables = $analyser->getAllTables();

	echo '   ' . DONE_NEWLINE . PHP_EOL;

	$string = new Foo_String();
	foreach ($tables as $tableName => $tableStruct) {
		$camelCasedTableName = $string->setString($tableName)->underscoreToCamelcase();
		$dir = MODEL_PATH . '/' . $camelCasedTableName;

		if (!is_dir($dir)) {
			echo 'Creating: ' . $dir;
			mkdir($dir);
			echo '   ' . DONE_NEWLINE;
		}

		echo 'Creating model for table ' . $tableName;
		$tableClassName = 'Model_' . $camelCasedTableName . '_Table';
		$tableRowClassName = 'Model_' . $camelCasedTableName;

		// Creating  table classes
		if (isset($tplTable) && is_array($tplTable)) {
			if (array_key_exists('lines', $tplTable) && (!empty($tplTable['lines']))) {
				$fileHandle = fopen($dir . '/Table.php', 'w');

				foreach ($tplTable['lines'] as $line) {
					if (false !== strpos($line, '[tableClassName]')) {
						$line = str_replace('[tableClassName]', $tableClassName, $line);
					}

					if (false !== strpos($line, '[tableRowClassName]')) {
						$line = str_replace('[tableRowClassName]', $tableRowClassName, $line);
					}

					if (false !== strpos($line, '[tableName]')) {
						$line = str_replace('[tableName]', $tableName, $line);
					}

					if (false !== strpos($line, '[fieldConstants]')) {
						$line = str_replace('[fieldConstants]', getFieldConstants($fieldConstant, $tableStruct), $line);
					}

					$line = substitutePlaceholders($line);
					fputs($fileHandle, $line . PHP_EOL);
				}

				fclose($fileHandle);
			}
		}

		// Creating table row classes
		if (isset($tplTableRow) && is_array($tplTableRow)) {
			if (array_key_exists('lines', $tplTableRow) && (!empty($tplTableRow['lines']))) {
				$fileHandle = fopen(MODEL_PATH . '/' . $camelCasedTableName . '.php', 'w');

				foreach ($tplTableRow['lines'] as $line) {
					if (false !== strpos($line, '[tableRowClassName]')) {
						$line = str_replace('[tableRowClassName]', $tableRowClassName, $line);
					}

					$line = substitutePlaceholders($line);
					fputs($fileHandle, $line . PHP_EOL);
				}

				$drawGetters = false;
				if (isset($getter) && is_array($getter)) {
					if (array_key_exists('lines', $getter) && (!empty($getter['lines']))) {
						$drawGetters = true;
					}
				}

				$drawSetters = false;
				if (isset($setter) && is_array($setter)) {
					if (array_key_exists('lines', $setter) && (!empty($setter['lines']))) {
						$drawSetters = true;
					}
				}

				// Create getters
				if ($drawGetters) {
					echo PHP_EOL;
					foreach ($tableStruct as $fieldName => $fieldDefinition) {
						if (in_array($fieldName, $fieldsToSkip)) {
							continue;
						}

						echo TAB . 'getter for field ' . $fieldName . '   ' . DONE_NEWLINE;;

						$getterName = 'get' . $string->setString($fieldName)->underscoreToCamelcase();;
						$attributeName = lcfirst($string->setString($fieldName)->underscoreToCamelcase());
						$attributeConstant = strtoupper($fieldName);
						$dataType = determineDataType($fieldDefinition['Type']);

						foreach ($getter['lines'] as $line) {
							if (false !== strpos($line, '[dataType]')) {
								$line = str_replace('[dataType]', $dataType, $line);
							}

							if (false !== strpos($line, '[attributeName]')) {
								$line = str_replace('[attributeName]', $attributeName, $line);
							}

							if (false !== strpos($line, '[getterName]')) {
								$line = str_replace('[getterName]', $getterName, $line);
							}

							if (false !== strpos($line, '[tableClassName]')) {
								$line = str_replace('[tableClassName]', $tableClassName, $line);
							}

							if (false !== strpos($line, '[attributeConstant]')) {
								$line = str_replace('[attributeConstant]', $attributeConstant, $line);
							}

							fputs($fileHandle, TAB . $line . PHP_EOL);
						}
					}
				}

				// Create setters
				if ($drawSetters) {
					echo PHP_EOL;
					foreach ($tableStruct as $fieldName => $fieldDefinition) {
						if (in_array($fieldName, $fieldsToSkip)) {
							continue;
						}

						echo TAB . 'setter for field ' . $fieldName . '   ' . DONE_NEWLINE;;

						$setterName = 'set' . $string->setString($fieldName)->underscoreToCamelcase();
						$attributeName = lcfirst($string->setString($fieldName)->underscoreToCamelcase());
						$dataType = determineDataType($fieldDefinition['Type']);

						foreach ($setter['lines'] as $line) {
							if (false !== strpos($line, '[dataType]')) {
								$line = str_replace('[dataType]', $dataType, $line);
							}

							if (false !== strpos($line, '[attributeName]')) {
								$line = str_replace('[attributeName]', $attributeName, $line);
							}

							if (false !== strpos($line, '[setterName]')) {
								$line = str_replace('[setterName]', $setterName, $line);
							}

							if (false !== strpos($line, '[tableClassName]')) {
								$line = str_replace('[tableClassName]', $tableClassName, $line);
							}

							if (false !== strpos($line, '[attributeConstant]')) {
								$line = str_replace('[attributeConstant]', $attributeConstant, $line);
							}

							fputs($fileHandle, TAB . $line . PHP_EOL);
						}
					}
				}

				fputs($fileHandle, '}' . PHP_EOL);
				fclose($fileHandle);
			}
		}

		echo PHP_EOL;
	}
}
else {
	echo 'Error: File »' . $dbcFile . '« not found.' . PHP_EOL;
	echo 'Please create it in the model folder of the designated Zend project.';
}



function getFieldConstants($fieldConstant, $tableStruct)
{
	$exceptions = array(
		'id',
		'created',
		'modified'
	);

	$constLines = array();

	foreach ($tableStruct as $fieldname => $fieldDefiniton) {
		if (! in_array($fieldname, $exceptions)) {
			$constantName = 'T_' . strtoupper($fieldname);

			$line = str_replace('[constantName]', $constantName, $fieldConstant['line']);
			$line = str_replace('[constantValue]', $fieldname, $line);

			$constLines[] = $line;
		}
	}

	return implode(PHP_EOL, $constLines);
}

function substitutePlaceholders($line)
{
	if (false !== strpos($line, '[project]')) {
		$line = str_replace('[project]', PROJECT_NAME, $line);
	}

	if (false !== strpos($line, '[coderName]')) {
		$line = str_replace('[coderName]', CODER_NAME, $line);
	}

	if (false !== strpos($line, '[coderEmail]')) {
		$line = str_replace('[coderEmail]', CODER_EMAIL, $line);
	}

	return $line;
}

function determineDataType($type) {
	if (false !== strpos($type, 'int')) {
		return 'int';
	}

	if ((false !== strpos($type, 'char'))
		|| (false !== strpos($type, 'date'))
	) {
		return 'string';
	}
}