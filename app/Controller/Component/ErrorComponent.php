<?php
/**
 * Created by PhpStorm.
 * User: J.Mulle, this.impetus@gmail.com
 * Date: 1/2/14
 * Time: 4:38 PM
 */
App::uses( 'Component', 'Controller' );

class ErrorComponent extends Component {
	private $e_strings = array(
		"notFound"        => array( 'plist'  => array( 'controller' ),
		                            'string' => "The requested %%controller%% wasn't found."
		),
		"missingArgument" => array( 'plist'  => array( "arguments", "action", "controller" ),
		                            "string" => "The request, '%%controller%%->%%action%%', was missing the following arguments: %%arguments%%" ),
		"ajaxOnly"        => array( "plist" => false, "string" => "The page you have requested does not exist" )

	);

	function ErrorComponent() {
	}

	public function e($key, $params = array()) {
		if ( array_key_exists( $key, $this->e_strings ) ) {
			$params = array_combine( $this->e_strings[ $key ][ 'plist' ], $params );
			if ( $params ) {
				$error_str = $this->e_strings[ $key ][ 'string' ];
				foreach ( $params as $var => $val ) {
					$var       = "%%$var%%";
					$error_str = str_replace( $var, $val, $error_str );
				}

				return $error_str;
			}
			else {
				throw new InvalidArgumentException( count( $params ) . " parameters provided, but " .
				                                    count( $this->e_strings[ $key ][ 'plist' ] ) .
				                                    " are required for key $key" );
			}
		}
		else {
			throw new InvalidArgumentException( "Ironically enough, the error string you've requested doesn't exist. Way to fail, guy." );
		}
	}
}