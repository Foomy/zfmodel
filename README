Introduction
=============
zfmodel is a PHP-CLI tool, which helps you to create a model for a zend project.

	Usage:
		php zfmodel <name of the Zend project>


Short Manual
============

1.) Create a Zend project with complete folder structure, by using zf-tool or
manually.

2.) Create the database for the project. At this time only MySQL ist supported
by zfmodel.

3.) Then create a PHP-File named <project name>.dbc in the model
folder of the project. This dbc-File must contain an array as followed:

	$dbc = array (
		'dbname' => <name of your mysql database>,
		'user' => <your database username>,
		'pass' => <your database password>,
		'host' => <name or ip of the database host>,
	);

Note:
You may have to change the MODEL_PATH constant in the config.php, if you haven't
used the zf-tool and didn't create the standard folder structure.

4.) Run zfmodel as described by the usage upward.
