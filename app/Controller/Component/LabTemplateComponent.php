<?php
/**
 * Created by PhpStorm.
 * User: J.Mulle, this.impetus@gmail.com
 * Date: 3/25/14
 * Time: 7:30 PM
 */
App::uses( 'Component', 'Controller' );
class LabTemplateComponent extends Component {
	private $structure;

	public function LabTemplate($content) {
		$this->structure = json_decode( $content, true );
	}

	public function key_exists($key, $search_arrays = false, $start_path = false, $greedy = false) {
		$remaining_path = $this->structure;
		if ( $start_path ) {
			$start_path = is_array( $start_path ) ? $start_path : explode( "/", $start_path );

			for ( $i = 0; $i < count( $start_path ) - 1; $i++ ) {
				if ( array_key_exists( $start_path[ $i ], $remaining_path ) ) {
					$remaining_path = $remaining_path[ $start_path[ $i ] ];
				}
				else {
					throw new NotFoundException( "The provided path does not exist in this template." );
				}
			}
		}

		return $this->recursive_key_search( $key, $remaining_path, $start_path, $search_arrays, $greedy );
	}

	public function pr() {
		pr( $this->structure );

		return true;
	}

	private function recursive_key_search($key, $search_array, $path, $search_arrays, $greedy) {
		$found = $greedy ? array() : false;
		foreach ( $search_array as $index => $value ) {
			if ( $found === false || is_array( $found ) ) {
				if ( is_array( $value ) ) {
					if ( !is_int( $index ) || $search_arrays ) {
						if ( array_key_exists( $key, $value ) ) {
							if ( $greedy ) {
								$found++;
							}
							else {
								return implode( DS, $path ) . DS;
							}
						}
					}
					else {
						$found = $key == $value;
					}
				}
				elseif ( $greedy ) {
					$found = implode( DS, $path );
				}
				else {
					return true;
				}
			}
		}

		return $found;
	}
}
