<?php

$getter = array(
	'lines' => array(
		'',
		'/**',
		' * @return'.TAB.'[dataType] $[attributeName]',
		' */',
		'public function [getterName]()',
		'{',
		TAB.'return $this->{[tableClassName]::[attributeConstant]};',
		'}',
	)
);