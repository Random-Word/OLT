<?php

App::import('AppHelper', 'View/Helper');

class LabParamsHelper extends AppHelper {
	private $max_depth = 10;
	private $lab_params = null;
	private $slide = null;
	private $rset = null;

//	public function fetch($param, $global = false, $lab_params = false) {
//		if ($global) {
//			return $global && array_key_exists($param, $this->global['data']) ? $this->global['data'][$param] : false;
//		} else {
//			return array_key_exists($param, $this->local) ? $this->local[$param] : false;
//		}
//	}

	public function fetch_from_global_lab_params($param, $conditions= array() ) {
		/**
		 * Jono! Plan here was to provide a path for $param (something "research_subject/data/options/assets/video")
		 * and then potentially filter that with path => value pairs, like "research_subject/data/options/value" => "cats"
		 * but it was something of a whim and you didn't know you needed it yet, so, here it lies
		 */
		$successful = true;
		foreach($conditions as $haystack => $needle) {
			$haystack = explode("/", $haystack);
			$searching = $this->lab_params['global'];
			$found = true;
			if (count($haystack) > $this->max_depth) { break;}
			for ($i=0; $i<count($haystack); $i++) {
				if ( array_key_exists($haystack[$i], $searching) ) {
					$searching = $searching[$haystack[$i]];
				} else {
					$found = false;
					break;
				}
			}
			if (!$found) { break; }
			if ($searching[$haystack[$i]] != $needle) { break; }

		}
	}

	public function get_params($value_only = true) {
		$values = array() ;
		foreach ($this->rset['params'] as $scope) {
			foreach ($scope as $param => $value) {
				if ($value || !$value_only) {
					$values[$param] = $value;
				}
			}
		}
		return $values;
	}

	public function assets_of($scope, $params, $media_types, $ignore_rset = false) {
		$media_types = is_array($media_types) ? $media_types : array($media_types);
		$params = is_array($params) ? $params : array($params);
		$list = array();

		foreach ($params as $i => $param) {
			if (array_key_exists($param, $this->lab_params[$scope]) && array_key_exists($param, $this->rset['params'][$scope]) ) {
				$options = array();
				$choice = $this->rset['params'][$scope][$param];
				if ($choice) {
					array_push($options, $choice);
				} elseif ($ignore_rset) {
					$options = array_keys($this->lab_params[$scope][$param]['data']['options']);
				}
				foreach($options as $option) {
					foreach($media_types as $mt) {
							if (count($this->lab_params[$scope][$param]['data']['options'][$option]['assets'][$mt]) > 0 ) {
								!array_key_exists($param, $list) ? $list[$param] = array() : null;
								!array_key_exists($mt,$list[$param]) ? $list[$param][$mt] = array() : null;
								$list[$param][$mt] = $this->lab_params[$scope][$param]['data']['options'][$option]['assets'][$mt];
							}
					}
				}
			}
		}
		return $list;
	}

	public function bind($lab_params = null, $slide= null, $rset = null) {
		$lab_params ? $this->bind_lab_params($lab_params) : null;
		$slide ? $this->bind_slide($slide) : null;
		$rset ? $this->bind_rset($rset) : null;

		return true;
	}


	public function bind_lab_params($lab_params) {
		$this->lab_params = $lab_params;
		return true;
	}

	public function bind_slide($slide) {
		$this->slide = $slide;
	}

	public function bind_rset($rset) {
		$this->rset = $rset['data'];
		return true;
	}
}