<?php

$setter = array(
	'lines' => array(
		'',
		'/**',
		' * @return'.TAB.'[dataType] $[attributeName]',
		' */',
		'public function [setterName]($[attributeName])',
		'{',
		TAB.'$this->{[tableClassName]::[attributeConstant]} = $[attributeName];',
		'}',
	)
);