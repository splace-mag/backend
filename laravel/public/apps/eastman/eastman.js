function eastman_startup() {
	console.log('Starting Eastman');

	$("#choosefromcam").click(function () {
		$('#filegal').click();
	});

	$("#hiddencontainer").click(function(){
		$("#splashscreen").hide();
		render("default.jpg");
	});

	$("#filegal").change(function(e){
		var URL = window.webkitURL || window.URL;
		var url = URL.createObjectURL(e.target.files[0]);
		var img = new Image();
		img.src = url;
		$("#splashscreen").hide();
		render(url);		
	});

	function render(e){

		$('#topFilter').css("background-image", "url("+e+")");
		$('#bottomFilter').css("background-image", "url("+e+")");
		$('#leftFilter').css("background-image", "url("+e+")");
		$('#rightFilter').css("background-image", "url("+e+")");
		$('#noFilter').css("background-image", "url("+e+")");

			$('.filterImage').css({'background-size':'1024px 730px'});
			$('#noFilter').css({'background-size':'1024px 730px'});

			$('#leftFilter').css({'':'1024px 730px'});
			$('#rightFilter').css({'width':'1024px'});
			$('#rightFilter').css({'height':'730px'});
			
			$('#topFilter').css({'background-size':'1024px 730px'});
			$('#bottomFilter').css({'background-size':'1024px 730px'});


		//Step 3: opacity Interpolation
		window.addEventListener('deviceorientation',function(event){ 
			if(event.alpha >= 0 <180){
                var beta = -event.gamma; //top bottom
                if(event.beta < 90 && event.beta > -90){
                    var gamma = event.beta; //left right
                }else{
                    var gamma = -event.beta; //left right
                }
            }else{ //buggy
                var beta = -event.gamma; //top bottom
                if(event.beta < 90 && event.beta > -90){
                    var gamma = -event.beta; //left right
                }else{
                    var gamma = event.beta; //left right
                }
            }	
            var maxAngle = 20;
            var minAngle = -20;
            var treshold=5;

            if(beta > maxAngle) beta = maxAngle;
            if(gamma > maxAngle) gamma = maxAngle;
            if(beta < minAngle) beta = minAngle;
            if(gamma < minAngle) gamma = minAngle;

			//get weight of the beta and gamma value on the total opacity change
			var fb = Math.abs(beta)/(Math.abs(beta)+Math.abs(gamma));
			var fg = 1-fb;
			
			//beta value filters: bottom = ]0;60] top = ]0;-60] 
			if(beta > 0){
				var opacity = Math.round(beta/maxAngle*100)/100;
				$('#bottomFilter').css({'opacity':opacity*fb});
				$('#topFilter').css({'opacity':0});
				//activate bottom info text, deactivate top info text
				$('#bottom_info').css({'background':'url("/apps/eastman/info_ufa_pink.png")'});
				$('#top_info').css({'background':'url("/apps/eastman/info_techni_white.png")'});
			}else if(beta < 0){
				var opacity = Math.round(beta/minAngle*100)/100;
				$('#bottomFilter').css({'opacity':0});
				$('#topFilter').css({'opacity':opacity*fb});
				//activate top info text, deactivate bottom info text
				$('#bottom_info').css({'background':'url("/apps/eastman/info_ufa_white.png")'});
				$('#top_info').css({'background':'url("/apps/eastman/info_techni_pink.png")'});
			}else{
				$('#bottomFilter').css({'opacity':0});
				$('#topFilter').css({'opacity':0});
				//deactivate top info text, deactivate bottom info text
				$('#bottom_info').css({'background':'url("/apps/eastman/info_ufa_white.png")'});
				$('#top_info').css({'background':'url("/apps/eastman/info_techni_white.png")'});
			}

			//gamma value filters: right = ]0;60] left = ]0;-60] 
			if(gamma > 0){
				var opacity = Math.round(gamma/maxAngle*100)/100;
				$('#rightFilter').css({'opacity':opacity*fg});
				$('#leftFilter').css({'opacity':0});
				//activate right info text, deactivate left info text
				$('#right_info').css({'background':'url("/apps/eastman/info_eastman_pink.png")'});
				$('#left_info').css({'background':'url("/apps/eastman/info_bw_white.png")'});
			}else if(gamma < 0){
				var opacity = Math.round(gamma/minAngle*100)/100;
				$('#rightFilter').css({'opacity':0});
				$('#leftFilter').css({'opacity':opacity*fg});
				//activate left info text, deactivate right info text
				$('#right_info').css({'background':'url("/apps/eastman/info_eastman_white.png")'});
				$('#left_info').css({'background':'url("/apps/eastman/info_bw_pink.png")'});
			}else{
				$('#rightFilter').css({'opacity':0});
				$('#leftFilter').css({'opacity':0});
				//deactivate left info text, deactivate right info text
				$('#right_info').css({'background':'url("/apps/eastman/info_eastman_white.png")'});
				$('#left_info').css({'background':'url("/apps/eastman/info_bw_white.png")'});
			}
			
			//logic for text divs
			//set background src for div #filterText
			if(gamma>treshold && beta<-treshold){ //top right corner
				console.log("right corner activated");
				if(gamma>=Math.abs(beta)){
					$('#filterText').css({'background':'url("/apps/eastman/eastman.png")'});
				}else{
					$('#filterText').css({'background':'url("/apps/eastman/techni.png")'});
				}
			}else if(gamma>treshold && beta>treshold){ //bottom right corner
				if(gamma>= beta){
					$('#filterText').css({'background':'url("/apps/eastman/eastman.png")'});
				}else{
					$('#filterText').css({'background':'url("/apps/eastman/ufa.png")'});
				}
			}else if(gamma<-treshold && beta<-treshold){ //top left corner
				if(Math.abs(gamma)>=Math.abs(beta)){
					$('#filterText').css({'background':'url("/apps/eastman/sw.png")'});
				}else{
					$('#filterText').css({'background':'url("/apps/eastman/techni.png")'});
				}
			}else if(gamma<-treshold && beta > treshold){ //bottom left corner
				if(Math.abs(gamma)>=beta){
					$('#filterText').css({'background':'url("/apps/eastman/sw.png")'});
				}else{
					$('#filterText').css({'background':'url("/apps/eastman/ufa.png")'});
				}
			}else if((beta<-treshold && gamma > -treshold) && (beta<-treshold && gamma < treshold) ){ // only top
				$('#filterText').css({'background':'url("/apps/eastman/techni.png")'});
			}else if((beta>treshold && gamma > -treshold) && (beta>treshold && gamma < treshold) ){ // only bottom
				$('#filterText').css({'background':'url("/apps/eastman/ufa.png")'});
			}else if((gamma<-treshold && beta > -treshold) && (gamma<-treshold && beta < treshold) ){ // only left
				$('#filterText').css({'background':'url("/apps/eastman/sw.png")'});
			}else if((gamma>treshold && beta > -treshold) && (gamma>treshold && beta < treshold) ){ // only right
				$('#filterText').css({'background':'url("/apps/eastman/eastman.png")'});
			}else{ //values not in range
				$('#filterText').css({'background':''});
			}
			$('.info').css("background-repeat", "no-repeat");


			/*$('#filterText').css({'top':'30%'});
			$('#filterText').css({'left':'30%'}); */
			$('#filterText').css({'background-repeat':'no-repeat'});

			$('.filterImage').css({'background-size':'1024px 730px'});
			$('#noFilter').css({'background-size':'1024px 730px'});

			$('#leftFilter').css({'':'1024px 730px'});
			$('#rightFilter').css({'width':'1024px'});
			$('#rightFilter').css({'height':'730px'});
			
			$('#topFilter').css({'background-size':'1024px 730px'});
			$('#bottomFilter').css({'background-size':'1024px 730px'});

		},false);
	}




	console.log('Started Eastman');
}


function eastman_teardown() {
	console.log('Nothing to do here, move along');
}

