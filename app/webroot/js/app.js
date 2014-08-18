$(document).foundation().ready(function() {
	var layout = $('body').data('layout');
	if (layout == 'lab') {
		OLT.init('lab');
	} else {
		OLT.init('default');
	}
});