// create the editor
var container = document.getElementById('jsoneditor');
var editor = new jsoneditor.JSONEditor(container);

// set json

$(document).ready(function() {

	editor.set(raw_template);
});


//// get json
//document.getElementById('getJSON').onclick = function () {
//var json = editor.get();
//alert(JSON.stringify(json, null, 2));
//};