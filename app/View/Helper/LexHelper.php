<?php
/**
 * J. Mulle, for app, 5/23/14 9:53 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */

// TODO: Jon you were building this helper because the reliance on convetion within this baby is getting unweildy for  your pot-addled mind
// The idea is to manage classes and attributes, and basically any language idiosyncratic to OLT via a single file that both the server and client side
// can reference

App::import('AppHelper', 'View/Helper');

class LexHelper extends AppHelper {
	private $defs = null;
	public $pathDelimiter = DS;


	public function LexHelper() {
		try {
			if ( !defined("OLT_DEFINITIONS") ) {
				throw new InvalidArgumentException("LexHelper expected constant \"OLT_DEFINITIONS\" to be defined; it wasn't. D:");
			}
			if (!file_exists(OLT_DEFINITIONS) ) {  // CakeFolder returns false on bad path
				throw new InvalidArgumentException("Definitions files was not found at \"".OLT_DEFINITIONS."\"");
			}
		} catch (InvalidArgumentException $e) {
			pr($e);
			// see if you can redirect or at least flash?
		}

		$this->defs = json_decode(file_get_contents(OLT_DEFINITIONS));
	}

	public function r($path, $searchArray = null) {
		if (!$searchArray) { $searchArray = $this->des;}
		$path = explode($path, ".");
		$nextPathPart = pop($path);
		if (count($path) === 0 ) {
			if (array_key_exists($nextPathPart, $searchArray) ) {
				return $searchArray[$nextPathPart];
			} else {
				return false;
			}
		} else {
			if (array_key_exists($nextPathPart, $searchArray) ) {
				return $this->r($path, $searchArray[$nextPathPart]);
			} else {
				return false;
			}
		}
	}

}