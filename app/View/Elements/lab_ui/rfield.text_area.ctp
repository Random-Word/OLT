<?php
/**
  * J. Mulle, for app, 5/21/14 9:07 PM
  * www.introspectacle.net
  * Email: this.impetus@gmail.com
  * Twitter: @thisimpetus
  * About.me: about.me/thisimpetus
  *
  * @name rfield.text_area
  * @desc
  * @opt (string) $id
  * @opt (mixed) $wrap
  * @opt (array) $data
  *
  */

// first, prepare all components

// if save path is an array instead of a string, fix that
if (is_array($path) ) {
	$path = implode(DS, $path);
}

$data_attributes = AppController::data_attr($data);

// wrap in a Foundation row if requested
if ($wrap) {
	if (is_bool($wrap) ) { $wrap = 12;}?>
<div class="row">
	<div class="small-<?php echo $wrap; echo $wrap < 12 ? " small-centered" :null;?> columns"> <?php
}

// then create the element ?>
	<div id="<?php AppController::str_to_selector(array($id, "wrapper"));?>">
	<textarea id="<?php echo $id;?>" class="olt-rfield olt-param" <?php echo $data_attributes;?> placeholder="<?php if (!empty($placeholder)) {echo $placeholder;}?>"></textarea>
	</div>
<?php
	if ($wrap) {?>
	</div>
</div>
<?php } ?>