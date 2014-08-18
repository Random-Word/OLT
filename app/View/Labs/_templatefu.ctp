<?php
//db($template);
$task_types = array();
$rows = array();
$GLOBALS["lab_schema"] = array(
	"lab_title"  => array( "nodes"    => array( "min" => 1, "max" => 1 ),
	                       "elements" => false, // for arrays proper, ie. enumerable elements w/o kw indeces
	                       "children" => array(
		                       "required" => false,
		                       "optional" => array(
			                       "lab_subtitle" => array( "nodes"    => array( "min" => -1, "max" => "1" ),
			                                                "elements" => false,
			                                                "children" => array( "required" => false,
			                                                                     "optional" => false )
			                       )
		                       )
	                       )
	),
	"lab_params" => array( "nodes"    => array( "min" => -1, "max" => 1 ),
	                       "elements" => false,
	                       "children" => array(
		                       "required" => array(
			                       'param_name'    => array( "nodes"             => array( "min" => 1, "max" => 1 ),
			                                                 "elements"          => false,
			                                                 "required_children" => false,
			                                                 "optional_children" => false ),
			                       'param_options' => array( "nodes"    => array( "min" => 2, "max" => -1 ),
			                                                 "elements" => false,
			                                                 "children" => array(
				                                                 "required" => array(
					                                                 "opt_value"  => array( "node"     => array( "min" => 1,
					                                                                                             "max" => 1 ),
					                                                                        "elements" => false,
					                                                                        "children" => false
					                                                 ),
					                                                 "opt_assets" => array( "node"     => array( "min" => 1,
					                                                                                             "max" => 1 ),
					                                                                        "elements" => false,
					                                                                        "children" => array(
						                                                                        "required" => array(
							                                                                        "video_assets" => array( "node"     => array( "min" => -1,
							                                                                                                                      "max" => -1 ),
							                                                                                                 "elements" => false,
							                                                                                                 "children" => array(
								                                                                                                 "required" => array(
									                                                                                                 "file_base_name" => array( "node"     => array( "min" => 1,
									                                                                                                                                                 "max" => 1 ),
									                                                                                                                            "elements" => false,
									                                                                                                                            "children" => false ),
									                                                                                                 "file_formats"   => array( "node"     => array( "min" => 1,
									                                                                                                                                                 "max" => 1 ),
									                                                                                                                            "elements" => false,
									                                                                                                                            "children" => array(
										                                                                                                                            "required" => array(
											                                                                                                                            // should prolly do flv as well...?
											                                                                                                                            "mp4" => array( "node"     => array( "min" => 1,
											                                                                                                                                                                 "max" => 1 ),
											                                                                                                                                            "elements" => false,
											                                                                                                                                            "children" => false ),
											                                                                                                                            "ogg" => array( "node"     => array( "min" => 1,
											                                                                                                                                                                 "max" => 1 ),
											                                                                                                                                            "elements" => false,
											                                                                                                                                            "children" => false ),
										                                                                                                                            ),
										                                                                                                                            "optional" => false
									                                                                                                                            )
									                                                                                                 )
								                                                                                                 ),
								                                                                                                 "optional" => false
								                                                                                                 // this is probably not true, resolution, tags, etc. might get included
							                                                                                                 )
							                                                                        ),
							                                                                        "audio_assets" => array( "node"     => array( "min" => -1,
							                                                                                                                      "max" => -1 ),
							                                                                                                 "elements" => false,
							                                                                                                 "children" => array(
								                                                                                                 "required" => array(
									                                                                                                 "file_base_name" => array( "node"     => array( "min" => 1,
									                                                                                                                                                 "max" => 1 ),
									                                                                                                                            "elements" => false,
									                                                                                                                            "children" => false ),
									                                                                                                 "file_formats"   => array( "node"     => array( "min" => 1,
									                                                                                                                                                 "max" => 1 ),
									                                                                                                                            "elements" => false,
									                                                                                                                            "children" => array(
										                                                                                                                            "required" => array(
											                                                                                                                            "mp3" => array( "node"     => array( "min" => 1,
											                                                                                                                                                                 "max" => 1 ),
											                                                                                                                                            "elements" => false,
											                                                                                                                                            "children" => false ),
											                                                                                                                            "wav" => array( "node"     => array( "min" => 1,
											                                                                                                                                                                 "max" => 1 ),
											                                                                                                                                            "elements" => false,
											                                                                                                                                            "children" => false ),
											                                                                                                                            "ogg" => array( "node"     => array( "min" => 1,
											                                                                                                                                                                 "max" => 1 ),
											                                                                                                                                            "elements" => false,
											                                                                                                                                            "children" => false ),
										                                                                                                                            ),
										                                                                                                                            "optional" => false
										                                                                                                                            // this is probably not true, resolution, tags, etc. might get included
									                                                                                                                            )
									                                                                                                 )
								                                                                                                 ),
								                                                                                                 "optional" => false
							                                                                                                 )
							                                                                        ),
							                                                                        "image_assets" => array( "node"     => array( "min" => -1,
							                                                                                                                      "max" => -1 ),
							                                                                                                 "elements" => false,
							                                                                                                 "children" => array(
								                                                                                                 "required" => array(
									                                                                                                 "file_base_name" => array( "node"     => array( "min" => 1,
									                                                                                                                                                 "max" => 1 ),
									                                                                                                                            "elements" => false,
									                                                                                                                            "children" => false ),
									                                                                                                 "file_formats"   => array( "node"     => array( "min" => 1,
									                                                                                                                                                 "max" => 1 ),
									                                                                                                                            "elements" => false,
									                                                                                                                            "children" => array(
										                                                                                                                            "required" => array(
											                                                                                                                            // should prolly do bmp, pdf, eps, et al.
											                                                                                                                            "jpg" => array( "node"     => array( "min" => 1,
											                                                                                                                                                                 "max" => 1 ),
											                                                                                                                                            "elements" => false,
											                                                                                                                                            "children" => false ),
											                                                                                                                            "png" => array( "node"     => array( "min" => 1,
											                                                                                                                                                                 "max" => 1 ),
											                                                                                                                                            "elements" => false,
											                                                                                                                                            "children" => false ),
											                                                                                                                            "gif" => array( "node"     => array( "min" => 1,
											                                                                                                                                                                 "max" => 1 ),
											                                                                                                                                            "elements" => false,
											                                                                                                                                            "children" => false ),
										                                                                                                                            ),
										                                                                                                                            "optional" => false
										                                                                                                                            // this is probably not true, resolution, tags, etc. might get included
									                                                                                                                            )
									                                                                                                 )
								                                                                                                 ),
								                                                                                                 "optional" => false
							                                                                                                 )
							                                                                        )
						                                                                        ),
						                                                                        "optional" => false
					                                                                        )
					                                                 )
				                                                 ),
				                                                 "optional" => false
			                                                 )
			                       )
		                       ),
		                       "optional" => array(
			                       'task_type' => array( "nodes"    => array( "min" => -1, "max" => 1 ),
			                                             "elements" => false,
			                                             "children" => false )
		                       )
	                       )
	),
	"slides"     => array( "fuck you" )
);

function key_string($indent_val, $key) {
	$str = '';
	for ( $i = 0; $i < $indent_val; $i++ ) {
		$str .= "<div class=\"indented indent-0\">&nbsp;</div>";
	}

	return $str . $key . ":";
}

function val_string($val, $is_object) {
	if ( is_array( $val ) ) {
		$l_delim = $is_object ? "{" : "[";
		$r_delim = $is_object ? "}" : "]";
		if ( empty( $val ) ) {
			$val_str = "<div class=\"array-key-count empty\">" . $l_delim . "0" . $r_delim . "</div>";
		}
		else {
			$val_str = "<div class=\"array-key-count\">" . $l_delim . count( $val ) . $r_delim . "</div>";
		}
	}
	else {
		if ( $val === null ) {
			$val_str = "<em>null</em>";
		}
		elseif ( $val === false ) {
			$val_str = "<span class=\"bool\">false</span>";
		}
		elseif ( $val === true ) {
			$val_str = "<span class=\"bool\">true</span>";
		}
		else {
			$val_str = $val;
		}
	}

	return $val_str;
}

function printTemplateKeys($content, $indent, &$rows_array) {
	foreach ( $content as $key => $val ) {
		$val_is_array  = is_array( $val ) && !empty( $val ) ? true : false;
		$rows_array[ ] = array( key_string( $indent, $key ),
		                        val_string( $val, is_int( $key ) ),
		                        array_key_exists($key, $GLOBALS["lab_schema"]) );

		if ( $val_is_array ) {
			$indent++;
			printTemplateKeys( $val, $indent, $rows_array );
			$indent--;
	// todo: write a function to traverse the schema and get node information
		}
	}
}

printTemplateKeys( $template, 0, $rows );
?>
<div class="row">
	<div id="template-nav" class="small-12 columns">
		<ul class="button-group">
			<li><a href="#" class="small secondary button">Revert</a></li>
			<li><a href="#" class="small secondary button">Save</a></li>
			<li><a href="#" class="small secondary button">Duplicate</a></li>
			<li><a href="#" data-dropdown="export-options" class="small secondary button">Export to..</a><br />
				<ul id="export-options" data-dropdown-content class="f-dropdown">
					<li><a href="#">CSV</a></li>
					<li><a href="#">JSON</a></li>
					<li><a href="#">XML</a></li>
					<li><a href="#">Bulleted Text</a></li>
				</ul>
			</li>
	</div>
</div>
<?php
foreach ( $rows as $i => $row ) {
	?>
	<div id="template-row_<?php echo $i;?>" class="row template-row <?php echo $i % 2 == 0 ? "alt-row" : ''; ?>" data-equalizer>
		<div class="template-margin small-1 columns text-right <?php echo $i % 2 == 0 ? "alt-row" : ''; ?>"
		     data-equalizer-watch>
			<a href="#" data-dropdown="template-row_<?php echo $i;?>_tools" class="dropdown left"><?php AppController::icon("thumbnails", 0, false, false);?></a>
			<ul id="template-row_<?php echo $i;?>_tools" data-dropdown-content class="f-dropdown">
				<li><a href="#" class="tiny button"><?php AppController::icon( "arrow-up", 0, false, false ); ?></a>
				</li>
				<li><a href="#" class="tiny button"><?php AppController::icon( "arrow-down", 0, false, false ); ?></a>
				</li>
				<li><a href="#" class="tiny button"><?php AppController::icon( "plus", 0, false, false ); ?></a></li>
				<li><a href="#" class="tiny button"><?php AppController::icon( "minus", 0, false, false ); ?></a></li>
			</ul>
			<div class="template-element"><?php echo $i; ?></div>
		</div>
		<div class="template-content small-11 columns data-equalizer-watch">
			<div class="template-element key <?php echo $row[2] ? "static" : "editable";?>"><?php echo $row[ 0 ]; ?></div>
			<div class="template-element val"><?php echo $row[ 1 ]; ?></div>
		</div>

	</div>
<?php } ?>
</div>


