/**
 * Centerfold is an embedded video from vimeo
 */
function frank_startup() {
	var appDiv = $('#splaceApp');
	appDiv.addClass('videoBackground');
	var videoFrame = $('#splaceApp iframe');
	var aw = appDiv.outerWidth();
	var ah = appDiv.outerHeight();
	var vw = videoFrame.width();
	var vh = videoFrame.height();
	var horizFactor = vw / aw;
	console.log('Scaling video frame from ' + vw + 'x' + vh + ' to ' + aw + 'x' + ah);
	vw = aw;
	vh = Math.round(vh / horizFactor);
	console.log('Applying new video size ' + vw + 'x' + vh);
	videoFrame.width(vw);
	videoFrame.height(vh);
	var minAh = 730;
	if(ah < minAh) {
		ah = minAh;
	}
	var tmargin = Math.round((ah - vh) / 2);
	videoFrame.css('margin-top', tmargin);
};
function frank_startup() {};
