<?php
/**
 * J. Mulle, for app, 5/2/14 6:29 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus


 * @name html5v
 * @desc
 * @arg (array) $id_parts
 * @arg (string) $path
 * @arg (mixed) $data
 * @arg (array) $controls
 *
 * @creates html5v_controls
 * @arg(array) vsel_elements
 * @arg  (array) $controls[buttons]
 * @arg (array) $controls[style]
 * @arg (bool) $controls[wrap]
 */

$video_parts = array_merge($id_parts, array("video"));
$video_id = AppController::str_to_selector( $video_parts );
?>

<div class="<?php echo OLT_HTML5V;?>">
	<div class="player-skin">
		<div class="flex-video">
			<video id="<?php echo $video_id; ?>" class="<?php echo OLT_HTML5V_PLAYER;?>" <?php echo AppController::data_attr($data);?>>
				<source src="<?php echo $path; ?>" type="video/mp4">
			</video>
		</div>
	</div>
		<?php echo $this->Element( "lab_ui/html5v_controls", array("html5v_id_parts" =>$video_parts,
		                                                           "style"          => $controls["style"],
		                                                           "buttons"        => $controls["buttons"],
		                                                     )
		);?>
</div>