/**
 * @author Matthias Steinbauer <matthias.steinbauer@jku.at>
 */
var MATTON = MATTON || {};

/**
 * This is called by the framework after widget was successfully loaded
 */ 
function matton_startup() {
	console.log('Matton Startup called');
	console.log('Matton Startup completed');
	$('#mattonVideoPreview').click(function() {
		$('#mattonVideoPreview').hide();
		$('#mattonVideoBackground').hide();
		$('#mattonVideoFrame').show();
	});
};

/**
 * This is called by the framework right before the widget will be unloaded from DOM
 */ 
function matton_teardown() {
};

