/**
 * This is the Helsinki JavaScript file that contains all our code
 * @author Matthias Steinbauer <matthias.steinbauer@jku.at>
 */
var PLOIERLOAD = PLOIERLOAD || {};

/**
 * This is called by the framework after widget was successfully loaded
 */ 
function ploierload_startup() {
	document.location = 'http://splace-magazine.at/apps/ploier/ploier.html';
};

/**
 * This is called by the framework right before the widget will be unloaded from DOM
 */ 
function ploierload_teardown() {
	console.log('Ploierload teardown');
};

