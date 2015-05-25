function saveUser(e) {
	e.preventDefault();
	
	token = $('[name="_token"]').val();

	var user = {
		'id': $('[name="id"]').val(), 
		'name': $('[name="name"]').val(), 
		'email': $('[name="email"]').val()
	};

	$.post('user', { _token: token, user: user })
        .success(function(response){
        	showSuccess();
        })
        .error(function(response){
            showError();
        });
}

function showSuccess(form){
	$('.panel-heading').text($('[name="name"]').val());
	$('.user-editor-form__success').css('display', 'block');
	setTimeout(function() { 
		$('.user-editor-form__success').css('display', 'none'); 
	}, 5000);
}
function showError(form){
	$('.user-editor-form__error').css('display', 'block');
	setTimeout(function() { 
		$('.user-editor-form__error').css('display', 'none'); 
	}, 5000);
}


function init() {
	$('.user-editor-form').on('submit', saveUser);
}


init();