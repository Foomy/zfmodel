<?php

/**
 * This class provides an object represation of a string.
 *
 * @author		Sascha Schneider <foomy@sirfoomy.de>
 *
 * @category	library
 * @package		Foo_String
 * @version		0.1
 */
class Foo_String
{
	/*
	 * The value of the represented string.
	 *
	 * @var	string $_string
	 */
	private $_string;

	/**
	 * Initializes the object with an native string.
	 *
	 * @param	string $string
	 */
	public function __construct($string = '')
	{
		if (! empty($string)) {
			$this->setString($string);
		}
	} // Constructor

	/**
	 * Creates a Foo_String object initialized with the
	 * given value.
	 *
	 * @param	string $string
	 */
	public static function create($string)
	{
		$this->_string = $string;
	}

	/**
	 * Returns the property string
	 *
	 * @return	string $string
	 */
	public function getString()
	{
	    return $this->_string;
	}

	/**
	 * Sets the property to the given value.
	 *
	 * @param	string $string
	 */
	public function setString($string)
	{
		$this->_string = (string)$string;
		return $this;
	} // setString()

	/**
	 * Appends the given value to the property.
	 *
	 * @param	string $stringToAppend
	 * @return	Foo_String
	 */
	public function append($stringToAppend)
	{
		$this->_string = $this->_string . $stringToAppend;
		return $this;
	} // append()

	/**
	 * Prepends the given value to the property.
	 *
	 * @param	string $stringToPrepend
	 * @return	Foo_String
	 */
	public function prepend($stringToPrepend)
	{
		$this->_string = $stringToPrepend . $this->_string;
		return $this;
	} // prepend()

	/**
	 * Cuts the property to the given length.
	 *
	 * @param	int $maxCharacters
	 * @param	bool $obeyWordBoundaries
	 * @return	Foo_String
	 */
	public function shorten($maxCharacters, $obeyWordBoundaries = true)
	{
		throw new Foo_MethodNotImplementedException();
		return $this;
	} // shorten()

	/**
	 * Trims non printable characters from begin and end of the given
	 * string. If no string was given as parameter it operates on the
	 * property an
	 *
	 * @return	Foo_String
	 */
	public function trim()
	{
		$string = $this->_string;

		do {
			$trimmed = trim($string); // trim normal whitespace characters
			$trimmed = trim($trimmed, chr(0xC2).chr(0xA0)); // ASCII 160 &nbsp; character (http://php.net/manual/de/function.trim.php)
		}
		while (strlen($trimmed) == strlen($string));

		$this->_string = $trimmed;
		return $this;
	} // trim()


	public function underscoreToCamelcase()
	{
		$stringParts = explode('_', $this->_string);
		$string = '';

		foreach ($stringParts as $part) {
			$string .= ucfirst($part);
		}

		$this->_string = $string;
		return $this;
	}

	/**
	 * Clones the instance of this object.
	 *
	 * @return	Foo_String
	 */
	public function __clone()
	{
		return new Foo_String($this->_string);
	}// __clone()

	/**
	 * Returns the native Value of Foo_String.
	 *
	 * @return	string
	 */
	public function __toString()
	{
		return $this->getString();
	} // __toString()
}
