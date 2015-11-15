var el, editor = {}, sectionsDE, sectionsEN, count, linkCount = 1, booktipCount = 1;

function editorLanguageSwitch(add, remove) {
	$('#language-switch--'+remove).removeClass('active');
	$('#language-switch--'+add).addClass('active');

	$('.language-'+remove).addClass('hidden');
	$('.language-'+add).removeClass('hidden');
}

function changeLanguage() {
	$('#language-switch--de').on('click', function() {
		editorLanguageSwitch('de', 'en');

	    for (var i = 0; i < el.length; i++) {
	    	editor[i].reflow();
	    }
	});
	$('#language-switch--en').on('click', function() {
		editorLanguageSwitch('en', 'de');
		
		for (var i = 0; i < el.length; i++) {
	    	editor[i].reflow();
	    }
	});
}

function parseSections(text) {
	var sections = {};
	text = text.replace(/<p>/g, '');
	text = text.replace(/<\/p>/g, '');

	var parts = text.split('[--');

	i = 0;
	for(p in parts) {
		if(i == 0) {
			i++;
			continue;
		}

		var s = parts[p].split('--]');
		sections[i-1] = { id: s[0], html: s[1] };
		i++;
	}

	return sections;
}

function saveArticle(e) {
	e.preventDefault();
	token = $('[name="_token"]').val();

	var article = {
		'id': $('[name="id"]').val(), 
		'titleDE': $('[name="titleDE"]').val(), 
		'titleEN': $('[name="titleEN"]').val(), 
		'spitzmarke': $('[name="spitzmarke"]').val(), 
		'page_titleDE': $('[name="page_titleDE"]').val(), 
		'page_titleEN': $('[name="page_titleEN"]').val(), 
		'page_title_padding_left': $('[name="page_title_padding_left"]').val(), 
		'page_title_padding_top': $('[name="page_title_padding_top"]').val(), 
		'page_subtitleDE': $('[name="page_subtitleDE"]').val(), 
		'page_subtitleEN': $('[name="page_subtitleEN"]').val(),
		'page_sub_title_padding_left': $('[name="page_sub_title_padding_left"]').val(), 
		'page_sub_title_padding_top': $('[name="page_sub_title_padding_top"]').val(), 
		'app_name': $('[name="app_name"]').val(), 
		'reading_time': $('[name="reading_time"]').val(),  
		'markdown_introductionDE': $('[name="introductionDE"]').val(), 
		'markdown_introductionEN': $('[name="introductionEN"]').val(), 
		'markdown_summaryDE': $('[name="summaryDE"]').val(), 
		'markdown_summaryEN': $('[name="summaryEN"]').val(), 
		'editor_section_codeDE': $('[name="textDE"]').val(), 
		'editor_section_codeEN': $('[name="textEN"]').val(), 
		'author_name': $('[name="author_name"]').val(), 
		'markdown_used_materialDE': $('[name="used_materialDE"]').val(), 
		'markdown_used_materialEN': $('[name="used_materialEN"]').val(), 
		'markdown_bio_textDE': $('[name="bio_textDE"]').val(), 
		'markdown_bio_textEN': $('[name="bio_textEN"]').val(), 
		'bio_text_shortDE': $('[name="bio_text_shortDE"]').val(), 
		'bio_text_shortEN': $('[name="bio_text_shortEN"]').val(), 
		'gradient_1': $('[name="gradient_1"]').val(), 
		'gradient_2': $('[name="gradient_2"]').val(), 
		'link_color': $('[name="link_color"]').val(), 
		'subtitle_backgroundcolor': $('[name="subtitle_backgroundcolor"]').val(), 
		'cover_image_padding_left': $('[name="cover_image_padding_left"]').val(), 
		'cover_image_padding_top': $('[name="cover_image_padding_top"]').val()
	};
	
	var links = {}; 
	$('.link-input').each(function(index) {

		links[index] = { 
			'id': $(this).children('[name="link-id"]').val(), 
			'article_id': $('[name="id"]').val(), 
			'number': (index+1), 
			'link': $(this).children('[name="link"]').val(), 
			'link_descriptionDE': $(this).children('[name="link_descriptionDE"]').val(), 
			'link_descriptionEN': $(this).children('[name="link_descriptionEN"]').val()
		};
	});

	var booktips = {}; 
	$('.booktip-input').each(function(index) {

		booktips[index] = { 
			'id': $(this).children('[name="booktip-id"]').val(), 
			'article_id': $('[name="id"]').val(), 
			'number': (index+1), 
			'booktipDE': $(this).children('[name="booktip_descriptionDE"]').val(), 
			'booktipEN': $(this).children('[name="booktip_descriptionEN"]').val()
		};
	});
	
	for (var i = 0; i < el.length; i++) {
		editor[i].preview();
		editor[i].edit();

		var element = editor[i].getElement('container');
		if($(element).attr('data-markdown') == 'textDE') {
			sectionsDE = parseSections($(editor[i].getElement('previewer')).find('#epiceditor-preview').html());
		}
		else if($(element).attr('data-markdown') == 'textEN') {
			sectionsEN = parseSections($(editor[i].getElement('previewer')).find('#epiceditor-preview').html());
		}
		else if($(element).attr('data-markdown') == 'introductionDE') {
			article['introductionDE'] = $(editor[i].getElement('previewer')).find('#epiceditor-preview').html();
		}
		else if($(element).attr('data-markdown') == 'introductionEN') {
			article['introductionEN'] = $(editor[i].getElement('previewer')).find('#epiceditor-preview').html();
		}
		else if($(element).attr('data-markdown') == 'summaryDE') {
			article['summaryDE'] = $(editor[i].getElement('previewer')).find('#epiceditor-preview').html();
		}
		else if($(element).attr('data-markdown') == 'summaryEN') {
			article['summaryEN'] = $(editor[i].getElement('previewer')).find('#epiceditor-preview').html();
		}
		else if($(element).attr('data-markdown') == 'used_materialDE') {
			article['used_materialDE'] = $(editor[i].getElement('previewer')).find('#epiceditor-preview').html();
		}
		else if($(element).attr('data-markdown') == 'used_materialEN') {
			article['used_materialEN'] = $(editor[i].getElement('previewer')).find('#epiceditor-preview').html();
		}
		else if($(element).attr('data-markdown') == 'bio_textDE') {
			article['bio_textDE'] = $(editor[i].getElement('previewer')).find('#epiceditor-preview').html();
		}
		else if($(element).attr('data-markdown') == 'bio_textEN') {
			article['bio_textEN'] = $(editor[i].getElement('previewer')).find('#epiceditor-preview').html();
		}
		
    }

	var cover_file = $('#cover_image')[0].files[0];
	var bio_file = $('#bio_image')[0].files[0];

	if(cover_file != undefined || bio_file != undefined) {
		formdata = new FormData();
		formdata.append("cover_image", cover_file);
		formdata.append("bio_image", bio_file);
        formdata.append("_token", token);

	    $.ajax({
	        type: "POST",
	        url: "fileupload/"+article['id'],
	        enctype: 'multipart/form-data',
	        contentType: false, 
	        processData: false, 
	        data: formdata, 
	        success: function () {
	            console.log('Images successful uploaded');
	        }
	    });
    }

	$.post(article['id'], { _token: token, article: article, sectionsDE: sectionsDE, sectionsEN: sectionsEN, links: links, booktips: booktips })
        .success(function(response){
        	showSuccess('article');
        	//setTimeout(function() { 
        	//	history.back();
        	//}, 2500);
        })
        .error(function(response){
            showError('article');
        });
}

function saveSection(e) {
	e.preventDefault();

	token = $('[name="_token"]').val();

	var section = {
		'id': $('[name="id"]').val(), 
		'noteDE': $('[name="noteDE"]').val(), 
		'noteEN': $('[name="noteEN"]').val(), 
		'media_type': 'multiple'
	};

	//save Image
	if($('[name="media-file-image"]')[0].files[0] != undefined) {
		formdata = new FormData();
		formdata.append("media-file-image", $('[name="media-file-image"]')[0].files[0]);
		formdata.append('image-descriptionDE', $('[name="image-descriptionDE"]').val());
		formdata.append('image-descriptionEN', $('[name="image-descriptionEN"]').val());
		
		uploadMedia(section, formdata, token);
	}
	//save Youtube Video Link
	formdata = new FormData();
	if($('[name="media-youtube-video"]').val() == '') {
		formdata.append("media-youtube-video", '-');
	}
	else {
		formdata.append("media-youtube-video", $('[name="media-youtube-video"]').val());
	}
	formdata.append('youtube-video-descriptionDE', $('[name="youtube-video-descriptionDE"]').val());
	formdata.append('youtube-video-descriptionEN', $('[name="youtube-video-descriptionEN"]').val());

	uploadMedia(section, formdata, token);

	//save Vimeo Video Link
	formdata = new FormData();
	if($('[name="media-vimeo-video"]').val() == '') {
		formdata.append("media-vimeo-video", '-');
	}
	else {
		formdata.append("media-vimeo-video", $('[name="media-vimeo-video"]').val());
	}
	formdata.append('vimeo-video-descriptionDE', $('[name="vimeo-video-descriptionDE"]').val());
	formdata.append('vimeo-video-descriptionEN', $('[name="vimeo-video-descriptionEN"]').val());
	
	uploadMedia(section, formdata, token);
	
	//save Gallery Cover Image
	if($('[name="media-file-image-cover"]')[0].files[0] != undefined) {
		formdata = new FormData();
		formdata.append('media-file-image-cover', $('[name="media-file-image-cover"]')[0].files[0]);
		formdata.append('gallery-thumbnail-descriptionDE', $('[name="gallery-thumbnail-descriptionDE"]').val());
		formdata.append('gallery-thumbnail-descriptionEN', $('[name="gallery-thumbnail-descriptionEN"]').val());

		uploadMedia(section, formdata, token);
	}

	//save Gallery Images
	if($('[name="media-file-image-multiple"]')[0].files[0] != undefined) {
		formdata = new FormData();
		i = 0;
		for(file in $('[name="media-file-image-multiple"]')[0].files) {
			formdata.append('media-file-gallery-'+i, $('#media-file-image-multiple')[0].files[i]);
			i++;
		}
		formdata.append('gallery_items', i);
	
		uploadMedia(section, formdata, token);
	}
		
	
	
    mediacontent = {};
    $('.media-input').each(function(index) {
    	if($(this).parent().attr('id') != 'media-youtube-video' && $(this).parent().attr('id') != 'media-vimeo-video' && $(this).children('[name="media-descriptionDE"]').attr('data-key') != '-1') {
    		mediacontent[index] = {};
	    	mediacontent[index]['id'] = $(this).children('.media-descriptionDE').attr('data-key');
	    	mediacontent[index]['descriptionDE'] = $(this).children('.media-descriptionDE').val();
	    	mediacontent[index]['descriptionEN'] = $(this).children('.media-descriptionEN').val();
    	}  	
    });

	$.post(section['id'], { _token: token, section: section, media: mediacontent })
        .success(function(response){
        	showSuccess('section');
        })
        .error(function(response){
            showError('section');
        });
    
}

function uploadMedia(section, formdata, token) {
    formdata.append("_token", token);

    $.ajax({
        type: "POST",
        url: "fileupload/"+section['id'],
        enctype: 'multipart/form-data',
        contentType: false, 
        processData: false, 
        data: formdata, 
        success: function () {
            console.log('Media successful uploaded');
            showSuccess('section');
        }
    });
}

function saveComment(e) {
	e.preventDefault();
	
	token = $('[name="_token"]').val();

	var comment = {
		'id': $('[name="id"]').val(), 
		'marked': $('[name="marked"]').is(':checked') ? 1 : 0, 
		'text': $('[name="text"]').val()
	};

	$.post(comment['id'], { _token: token, comment: comment })
        .success(function(response){
        	//location.reload();
        	showSuccess('comment');
        })
        .error(function(response){
            showError('comment');
        });
}

function saveMagazine(e) {
	e.preventDefault();
	
	token = $('[name="_token"]').val();

	var magazine = {
		'id': $('[name="id"]').val(), 
		'active': $('[name="active"]:checked').val(), 
		'title': $('[name="title"]').val(), 
		'version': $('[name="version"]').val()
	};

	$.post(magazine['id'], { _token: token, magazine: magazine })
        .success(function(response){
        	showSuccess('magazine');
        	//setTimeout(function() { 
        	//	$(location).attr('href', '/admin/magazines');
        	//}, 2500);
        })
        .error(function(response){
            showError('magazine');
        });
}

function showSuccess(form){
	$('.'+form+'-editor-form__success').removeClass('hidden');
	setTimeout(function() { 
        $('.'+form+'-editor-form__success').addClass('hidden');
    }, 10000);
}
function showError(form){
	$('.'+form+'-editor-form__error').removeClass('hidden');
	setTimeout(function() { 
        $('.'+form+'-editor-form__error').addClass('hidden');
    }, 10000);
}

function epiceditor() {
	//Epiceditor options 
	var opts = {
	  container: 'markdown-textDE',
	  textarea: 'textDE',
	  basePath: '/epiceditor',
	  theme: {
	    base: '/themes/base/epiceditor.css',
	    editor: '/themes/editor/epic-dark.css'
	  },
	  clientSideStorage: false, 
	  focusOnLoad: false
	}

	el = document.getElementsByClassName('epiceditor');
    for (var i = 0; i < el.length; i++) {
    	opts.container = el[i];
    	opts.localStorageName = 'epiceditor-' + i;
    	opts.textarea = $(el[i]).attr('data-markdown');
    	editor[i] = new EpicEditor(opts).load();
    }
}

function addLinkContent() {
	var html = '<a class="link-head" data-key="'+linkCount+'"><h4>Link '+linkCount+'</h4></a><div class="link-input" data-key="'+linkCount+'"><input type="hidden" name="link-id" value="-1"><input class="form-control" type="text" name="link" placeholder="Link"><h5>Beschreibung Deutsch</h5><input class="form-control" type="text" name="link_descriptionDE" placeholder="Beschreibung Deutsch"><h5>Beschreibung Englisch</h5><input class="form-control" type="text" name="link_descriptionEN" placeholder="Beschreibung Englisch"><hr></div>';
	$('.link-box').append(html);
	linkCount += 1;
}

function addBooktipContent() {
	var html = '<a class="booktip-head" data-key="'+booktipCount+'"><h4>Buchtipp '+booktipCount+'</h4></a><div class="booktip-input" data-key="'+booktipCount+'"><input type="hidden" name="link-id" value="-1"><input class="form-control" type="text" name="booktip_descriptionDE" placeholder="Buchtipp Deutsch"><input class="form-control" type="text" name="booktip_descriptionEN" placeholder="Buchtipp Englisch"><hr></div>';
	$('.booktip-box').append(html);
	booktipCount += 1;
}

function valueInput(value) {
	$('.delete-'+value+'').on('click', function() {
		var key = $(this).attr('data-key');
		$('.'+value+'-head[data-key="'+key+'"]').remove();
		$('.'+value+'-input[data-key="'+key+'"]').remove();
	});
	$('.'+value+'-head').on('click', function() {
		var key = $(this).attr('data-key');
		if($('.'+value+'-input[data-key="'+key+'"]').hasClass('hidden')) {
			$('.'+value+'-input[data-key="'+key+'"]').removeClass('hidden');
		}
		else {
			$('.'+value+'-input[data-key="'+key+'"]').addClass('hidden');
		}
	});
}

function sorted(listId) {
	var articles = {};
	var sections = {};

	if(listId == 'article-list') {
		$('#article-list').find('li').each(function(i) {
			if($(this).hasClass('important')) {
				return;
			}
			$(this).attr('number', (i+1));

			articles[i] = {};
			articles[i]['id'] = $(this).attr('id');
			articles[i]['number'] = $(this).attr('number');
		});

		$.post('/admin/article/sort', { articles: articles, _token: $('#_token').text() })
        .success(function(response){ })
        .error(function(response){ });
	}

	if(listId == 'section-list') {
		$('#section-list').find('li').each(function(i) {
			if($(this).hasClass('important')) {
				return;
			}
			$(this).attr('number', (i+1));

			sections[i] = {};
			sections[i]['id'] = $(this).attr('id');
			sections[i]['number'] = $(this).attr('number');
		});

		$.post('/admin/sections/sort', { sections: sections, _token: $('#_token').text() })
        .success(function(response){ })
        .error(function(response){ });
	}
}

function setActiveMagazine() {
	var selected = $('#active-magazine option:selected').val();
	token = $('[name="_token"]').val();

	$.post('admin/magazine', { _token: token, active: selected })
        .success(function(response){ 
        	location.reload(); 
        })
        .error(function(response){ 
        	console.log('Fehler!'); 
        });
}

function initializeForms() {
	if($('form').hasClass('article-editor-form')) {
		epiceditor();

		$('.show-sections').click(function() {
			$('.section-content').removeClass('hidden');
			for (var i = 0; i < el.length; i++) {
		    	editor[i].reflow();
		    }
		})
		$('.section-header').click(function() {
			var section = $(this).attr('data-key');
			if($('.section-content[data-key="'+section+'"]').hasClass('hidden')) {
				$('.section-content[data-key="'+section+'"]').removeClass('hidden');
			}
			else {
				$('.section-content[data-key="'+section+'"]').addClass('hidden');
			}

			for (var i = 0; i < el.length; i++) {
		    	editor[i].reflow();
		    }
		});

		if($('.link-input').val() != undefined) {
			linkCount = Number($('.link-input').last().attr('data-key'))+1;
		}
		$('.add-link').on('click', addLinkContent);
		valueInput('link');

		if($('.booktip-input').val() != undefined) {
			booktipCount = Number($('.booktip-input').last().attr('data-key'))+1;
		}
		$('.add-booktip').on('click', addBooktipContent);
		valueInput('booktip');
	}
	/*
	else if($('form').hasClass('section-editor-form')) {
		$('#media-type-select').change(function() { 
			var selected = $('#media-type-select option:selected').val();
			$('.media-type').addClass('hidden');
			$('#media-'+selected).removeClass('hidden');
		});
	}
	*/
	else if($('form').hasClass('magazine-form')) {
		$('#active-magazine').change(function() { 
			setActiveMagazine();
		});
	}

	else if($('form').hasClass('section-editor-form')) {
		$('[name="media-file-image"]').change(function() {
			if($('[name="media-file-image"]')[0].files[0] != undefined) {
				$('#media-image > .media-input').removeClass('media-empty');
				var html = 	'<input class="form-control" name="image-descriptionDE" data-key="-1" type="text" placeholder="Bildbeschreibung Deutsch" />'
						+  	'<input class="form-control" name="image-descriptionEN" data-key="-1" type="text" placeholder="Bildbeschreibung Englisch" />';
				$('#media-image > .media-input').html(html);
			}
		});

		$('[name="media-youtube-video"]').keyup(function() {
			if($('[name="media-youtube-video"]').val() != '') {
				$('#media-youtube-video > .media-input').removeClass('media-empty');
				var html = 	'<input class="form-control" name="youtube-video-descriptionDE" data-key="-1" type="text" placeholder="Bildbeschreibung Deutsch" />'
						+  	'<input class="form-control" name="youtube-video-descriptionEN" data-key="-1" type="text" placeholder="Bildbeschreibung Englisch" />';
				$('#media-youtube-video > .media-input').html(html);
			}
			else {
				$('#media-youtube-video > .media-input').html('');
			}
		});

		$('[name="media-vimeo-video"]').keyup(function() {
			if($('[name="media-vimeo-video"]').val() != '') {
				$('#media-vimeo-video > .media-input').removeClass('media-empty');
				var html = 	'<input class="form-control" name="vimeo-video-descriptionDE" data-key="-1" type="text" placeholder="Bildbeschreibung Deutsch" />'
						+  	'<input class="form-control" name="vimeo-video-descriptionEN" data-key="-1" type="text" placeholder="Bildbeschreibung Englisch" />';
				$('#media-vimeo-video > .media-input').html(html);
			}
			else {
				$('#media-vimeo-video > .media-input').html('');
			}
		});

		$('[name="media-file-image-cover"]').change(function() {
			if($('[name="media-file-image-cover"]')[0].files[0] != undefined) {
				$('#media-gallery-thumbnail > .media-input').removeClass('media-empty');
				var html = 	'<input class="form-control" name="gallery-thumbnail-descriptionDE" data-key="-1" type="text" placeholder="Bildbeschreibung Deutsch" />'
						+  	'<input class="form-control" name="gallery-thumbnail-descriptionEN" data-key="-1" type="text" placeholder="Bildbeschreibung Englisch" />';
				$('#media-gallery-thumbnail > .media-input').html(html);
			}
		});
	}

	if($('ul').hasClass('sortable')) {
		$('.sortable').sortable({
		    items: ':not(.important)'
		}).bind('sortupdate', function() {
			sorted($(this).attr('id'));
		});
	}
	    


	$('.article-editor-form').on('submit', saveArticle);
	$('.section-editor-form').on('submit', saveSection);
	$('.comment-editor-form').on('submit', saveComment);
	$('.magazine-editor-form').on('submit', saveMagazine);
}


function init() {
	changeLanguage();
	initializeForms();

}


init();