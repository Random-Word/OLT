<?php
/**
 * J. Mulle, for app, 7/12/14 11:20 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */ ?>
<div id="user-panel">
		<ul>
			<li><?php echo $this->Html->link("Home", ___cakeUrl("users","home"));?></li>
			<li><?php echo $this->Html->link("Log Out", ___cakeUrl("users","logout"));?></li>
		</ul>
	</div>