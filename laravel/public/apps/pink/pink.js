function pink_startup() {
	counter = 0;
	
	//get screenWidth to calculate markerBar attributes dependent on window size:
	var screenWidth = $(window).width(); 
	//range represents the distance between East and West
	//range == activity value maximum
	range = screenWidth * 0.7;
	
	setTimeout(createTitle, 0);
	setTimeout(removeTitle, 5000);
	//set activity value dependent on range (set markerBar in the the middle between East and West):
	activityValue = range * 0.5;
	
	//adjust title position:
	function createTitle(){
		document.getElementById('title').style.left = range * 0.7 + 'px';
	}
	
	function removeTitle() {
		document.getElementById('title').style.opacity = '0';
		wrapper.style.visibility = 'visible';
		
	}
	setTimeout(launch_event_loop, 3000);
	function launch_event_loop() {
		setInterval(event_loop, 1200);
	}
	
	/*
	Problem of former version:
	whole startup() was invalid due to syntax error (getting the title element)!
	*/
	
}



function event_loop(){
	
	//getting statement containers:
	stmt_topLeft = document.getElementById("stmtCont_topLeft");
	stmt_topCenter = document.getElementById("stmtCont_topCenter");
	stmt_topRight = document.getElementById("stmtCont_topRight");
	 
	stmt_botLeft = document.getElementById("stmtCont_bottLeft");
	stmt_botCenter = document.getElementById("stmtCont_bottCenter");
	stmt_botRight = document.getElementById("stmtCont_bottRight");
	
	//getting markerBar:
	var markerBar = document.getElementById('markerBar');
	
	if(activityValue == (range * 1))
	{
		//final west state	
		changeBackground_west();
		stmt_topCenter.innerHTML = "Get some more pink...</br> and give it a rest!</br> :)";		
		
		stmt_topLeft.style.opacity = '0';
		stmt_topCenter.style.opacity = '1';
		stmt_topRight.style.opacity = '0';
		stmt_botLeft.style.opacity = '0';
		stmt_botCenter.style.opacity = '0';
		stmt_botRight.style.opacity = '0';
		activityValue -= 1;
	}
	else if(activityValue - 1 >= 0)
		activityValue -= 1;
		else
		activityValue = 0;
			
	//UPDATE MARKERBAR POSITION:
	markerBarX = range-activityValue;
	var markerBar = document.getElementById('markerBar');
	markerBar.setAttribute("x", markerBarX);
	
	
	//UPDATE MARKERBAR COLOR:
	//BakerMillerPink: (255, 145, 175)
	//Channel Red always stays at 255.
	//y=k*x+d:
	//http://www.onlinemathe.de/forum/Steigung-einer-Geraden-mit-zwei-gegeben-Punkten-Differenzenquotient
	/*
	Problem in former version:
	var fillValue = "rgb(255," + markerBarG + "," + markerBarB + ")";
	markerBarG was not integer value and didn't respect the css syntax!
	*/
	
	//COMPUTING THE FUNCTIONS for Green and Red values dependent on the range
	//initializing the points that determine the function:
	//value for middle position between East and West:
	var middle = range * 0.5;
	//Point East (color value == Maximum (255)) - for both color channels:
	var Ex = 0;
	var Ey = 255;
	//Point West (color value == Minimum (0) - for both color channels:
	var Wx = range;
	var Wy = 0;
	//Point middle position for Green:
	var midGx = middle;
	var midGy = 145;
	//Point middle position for Blue:
	var midBx = middle;
	var midBy = 175;
	
	//computing gradients:
	//y=k*x+d
	var kG_east = (Ey-midGy) / (0-middle);
	var kG_west = (midGy-Wy) / (midGx-Wx);
	var kB_east = (Ey-midBy) / (0-middle);
	var kB_west = (midBy-Wy) / (midBx-Wx);
	
	//computing distances:
	//y=k*x+d
	//midGy = kG_east*midGx + dG_east
	var dG_east = midGy - (kG_east*midGx);
	var dG_west = midGy - (kG_west*midGx);
	var dB_east = midBy - (kB_east*midBx);
	var dB_west = midBy - (kB_west*midBx);
	
	//apply functions dependent on postion relative to middle position of range:
	if(activityValue <= middle) {
		//apply East functions:
		markerBarG = (kG_east * activityValue) + dG_east;
		markerBarB = (kB_east * activityValue) + dB_east;
		}
		else {
			//apply West functions:
			markerBarG = (kG_west * activityValue) + dG_west;
			markerBarB = (kB_west * activityValue) + dB_west;
		}	
	// console.log(markerBarG);
	// console.log(markerBarB);
	
	//assigning the color to markerBar:
	var markerBar = document.getElementById('markerBar');
	var fillValue = "rgb(255," + Math.round(markerBarG) + "," + Math.round(markerBarB) + ")";
	markerBar.style.fill = fillValue;
	
	
	
	if(activityValue > (range * 0.8)){
		$(document).ready(function()
		{
			stmt_topLeft.innerHTML = "For us</br>problems are solved through technology.</br>-Thomas Raab";	
			
			stmt_topLeft.style.opacity = '1';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '0';
			stmt_botLeft.style.opacity = '0';
			stmt_botCenter.style.opacity = '0';
			stmt_botRight.style.opacity = '0';
			
			var snd = new Audio("blop.mp3");
			// buffers automatically when created
		});
	}
	else if(activityValue > (range * 0.7)){
		$(document).ready(function()
		{	
		
			stmt_botRight.innerHTML = "I would like to “remove”</br>the person who says something to me.</br>-Thomas Raab";	
				
			stmt_topLeft.style.opacity = '0';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '0';
			stmt_botLeft.style.opacity = '0';
			stmt_botCenter.style.opacity = '0';
			stmt_botRight.style.opacity = '1';
			
			var snd = new Audio("applause.mp3");
			// buffers automatically when created
		
		});
	}
	else if(activityValue > (range * 0.6)){
		$(document).ready(function()
		{	
			stmt_topRight.innerHTML = "Humanity is acquiring all the right technology</br>for all the wrong reasons.<br>-R. Buckminster Fuller</br>";	
			
			stmt_topLeft.style.opacity = '0';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '1';
			stmt_botLeft.style.opacity = '0';
			stmt_botCenter.style.opacity = '0';
			stmt_botRight.style.opacity = '0';
			
		
		});
	}
	else if(activityValue > (range * 0.5)){
		$(document).ready(function()
		{
			stmt_botCenter.innerHTML = "It has become appallingly obvious</br>that our technology has exceeded our humanity.<br>-Albert Einstein</br>";
			
			stmt_topLeft.style.opacity = '0';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '0';
			stmt_botLeft.style.opacity = '0';
			stmt_botCenter.style.opacity = '1';
			stmt_botRight.style.opacity = '0';

			
			/*
		
			markerBar.style.fill = "rgb(255,0,0)";
			*/
		});
	}
	else if(activityValue > (range * 0.4)){
			stmt_topLeft.style.opacity = '0';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '0';
			stmt_botLeft.style.opacity = '0';
			stmt_botCenter.style.opacity = '0';
			stmt_botRight.style.opacity = '0';
	}
	else if(activityValue > (range * 0.3)){
		$(document).ready(function()
		{
			stmt_topRight.innerHTML = "The point will come</br>at which there are no more technological fixes.</br>-Thomas Raab";
			
			stmt_topLeft.style.opacity = '0';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '1';
			stmt_botLeft.style.opacity = '0';
			stmt_botCenter.style.opacity = '0';
			stmt_botRight.style.opacity = '0';
			 
		});
	}	
	else if(activityValue > (range * 0.2)){
		$(document).ready(function()
		{
	
			stmt_botLeft.innerHTML = "Everything has beauty,</br>but not everyone sees it.<br>-Confucius</br>";
			
			stmt_topLeft.style.opacity = '0';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '0';
			stmt_botLeft.style.opacity = '1';
			stmt_botCenter.style.opacity = '0';
			stmt_botRight.style.opacity = '0';
		
		});
	}	
	else if(activityValue > (range * 0.1)){
		$(document).ready(function()
		{	
		
			stmt_topLeft.innerHTML = "Those who are free of resentful thoughts</br>surely find peace.<br>-Buddha</br>";	
			
			stmt_topLeft.style.opacity = '1';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '0';
			stmt_botLeft.style.opacity = '0';
			stmt_botCenter.style.opacity = '0';
			stmt_botRight.style.opacity = '0';

		});
	}	
	else if(activityValue > 0){
		$(document).ready(function()
		{	
		
			stmt_topRight.innerHTML = "Technological progress has merely provided us</br>with more efficient means for going backwards.</br>-Aldous Huxley, Ends and Means";
			
			stmt_topLeft.style.opacity = '0';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '1';
			stmt_botLeft.style.opacity = '0';
			stmt_botCenter.style.opacity = '0';
			stmt_botRight.style.opacity = '0';

		});
	}
	else {
		$(document).ready(function()
		{
			stmt_botCenter.innerHTML = "Congratulations<br>Today, you found peace and patience</br>to let things go and the world grow.</br>";
	
			stmt_topLeft.style.opacity = '0';
			stmt_topCenter.style.opacity = '0';
			stmt_topRight.style.opacity = '0';
			stmt_botLeft.style.opacity = '0';
			stmt_botCenter.style.opacity = '1';
			stmt_botRight.style.opacity = '0';
			
			changeBackground_east();
			
		});
		//why does return not work?
		return;
	}
}

//Backgroundchanges:
function changeBackground_west() {
	$('#backgroundWrapper').css('background', '#FF91AF');	
}

function changeBackground_east() {
	$('#backgroundWrapper').css('background', '#ffffff');	
}

function increase_activity(){
	if(activityValue + (range * 0.025) < range)
		activityValue += (range * 0.025);
	else
		activityValue = range;
}

function dummy_teardown() {
	console.log('Nothing to do here, move along');
}

//Object Controlls:

$(document).ready(function()
{
	/*
	//rules for objects of class "gen":
	$('.gen').click(function() {
		e.stopPropagation();
		alert('test');
	});
	*/
});

/*
$(document).ready explaination:
$(document).ready(function(){
    $("button").click(function(){
        $("p").slideToggle();
    });
}); 
*/

$(document).ready(function()
{
	$('#wrapper').click(function(e) {
		//alert(e.pageX + ' , ' + e.pageY);
		/* var newImg = document.createElement("img");
		newImg.width = '35';
		newImg.height = '35';
		newImg.setAttribute('id', "newImg");
		newImg.setAttribute('src', "anim/objE_rotation_tapped.gif"); */
		var snd = new Audio("sound/blop.mp3");
			snd.play();
		
		increase_activity();
		var animationArray = ["objA_ slide_normal.gif", "objB_spiral_normal.gif", "objC_color_normal.gif", "objD_zentrifugal_normal.gif", "objE_rotation_normal.gif", "objF_pulse_normal.gif", "objG_shift_normal.gif", "objH_diagonal_normal.gif", "objI_bounce_normal.gif", "objJ_flipper_normal.gif"];
		var animationString = "/apps/pink/anim/" + animationArray[Math.floor(Math.random() * animationArray.length)];
		//new img element is getting appended to the wrapper element:
		$('#wrapper').append($('<img>', {			
			src : animationString,
			id : "newImg_" + (e.pageY -17) + "_" + (e.pageX -17),
			class : 'gen',
			width : 35, 
			height : 35, 
			alt : "Test Image", 
			title : "Test Image"
		}).css({
			position: "absolute",
			top: (e.pageY -17)  + "px",
			left:  (e.pageX -17) + "px"
		}));
	
		var posY = e.pageY-17;
		var posX = e.pageX-17;	
		//1st apporach:		
		//var stringArray = animationString.split("_");
		//stringArray[2] = "tapped.gif";

		animationString = animationString.replace("normal", "tapped");
		$("#newImg_" + (e.pageY -17) + "_" + (e.pageX -17)).click(function(e) {
			e.stopPropagation();
			var snd = new Audio("sound/Woosh.mp3");
			snd.play();		
			increase_activity();
			$("#newImg_" + (posY) + "_" + (posX)).attr('src', animationString);
		});

		setTimeout( function(){
			$("#newImg_" + (e.pageY -17) + "_" + (e.pageX -17)).remove();
			} , 7000);
	});
});
