var editorDE, editorEN, count, linkCount = 1, booktipCount = 1;

function editorLanguageSwitch(add, remove) {
	$('#language-switch--'+remove).removeClass('active');
	$('#language-switch--'+add).addClass('active');

	$('.language-'+remove).addClass('hidden');
	$('.language-'+add).removeClass('hidden');
}
function changeLanguage() {
	$('#language-switch--de').on('click', function() {
		editorLanguageSwitch('de', 'en');
		editorDE.reflow();
	});
	$('#language-switch--en').on('click', function() {
		editorLanguageSwitch('en', 'de');
		editorEN.reflow();
	});
}

function parseSections(text) {
	var sections = {};
	text = text.replace(/<p>/g, '');
	text = text.replace(/<\/p>/g, '');
	console.log(text);
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
		'reading_time': $('[name="reading_time"]').val(),  
		'introductionDE': $('[name="introductionDE"]').val(), 
		'introductionEN': $('[name="introductionEN"]').val(), 
		'summaryDE': $('[name="summaryDE"]').val(), 
		'summaryEN': $('[name="summaryEN"]').val(), 
		'editor_section_codeDE': $('[name="textDE"]').val(), 
		'editor_section_codeEN': $('[name="textEN"]').val(), 
		'author_name': $('[name="author_name"]').val(), 
		'bio_textDE': $('[name="bio_textDE"]').val(), 
		'bio_textEN': $('[name="bio_textEN"]').val(), 
		'used_materialDE': $('[name="used_materialDE"]').val(), 
		'used_materialEN': $('[name="used_materialEN"]').val(), 
		'gradient_1': $('[name="gradient_1"]').val(), 
		'gradient_2': $('[name="gradient_2"]').val(), 
		'link_color': $('[name="link_color"]').val(), 
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
	

	editorDE.preview();
	var sectionsDE = editorDE.getElement('previewer');
	sectionsDE = parseSections($(sectionsDE).find('#epiceditor-preview').html());

	editorEN.preview();
	var sectionsEN = editorEN.getElement('previewer');
	sectionsEN = parseSections($(sectionsEN).find('#epiceditor-preview').html());

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
		'media_type': $('#media-type-select option:selected').val()
	};

	var media = false;
	formdata = new FormData();

	if($('#media-type-select option:selected').val() == 'image' && $('#media-file-image')[0].files[0] != undefined) {
		formdata.append("media-file-image", $('#media-file-image')[0].files[0]);
		media = 'image';
	}
	else if($('#media-type-select option:selected').val() == 'video' && $('#media-file-video')[0].files[0] != undefined) {
		formdata.append("media-file-video", $('#media-file-video')[0].files[0]);
		media = 'video';
	}
	else if($('#media-type-select option:selected').val() == 'gallery' && $('#media-file-image-multiple')[0].files[0] != undefined) {
		formdata.append('media-file-image-cover', $('#media-file-image-cover')[0].files[0]);

		i = 0;
		for(file in $('#media-file-image-multiple')[0].files) {
			formdata.append('media-file-gallery-'+i, $('#media-file-image-multiple')[0].files[i]);
			i++;
		}
		formdata.append('gallery_items', i);
	
		media = 'gallery';
	}
		
	if(media != 'false') {
		formdata.append("media_type", media);
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
	        }
	    });
    }

    mediacontent = {};
    $('input.media-input').each(function(index) {
    	mediacontent[index] = {};
    	mediacontent[index]['id'] = $(this).attr('data-key');
    	mediacontent[index]['description'] = $(this).val();
    });

	$.post(section['id'], { _token: token, section: section, media: mediacontent })
        .success(function(response){
        	//location.reload();
        	showSuccess('section');
        })
        .error(function(response){
            showError('section');
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
	  clientSideStorage: false
	}

	//Initiate Markdown Editor #1 German
	editorDE = new EpicEditor(opts);
	editorDE.load();

	opts['container'] = 'markdown-textEN';
	opts['textarea'] = 'textEN';

	//Initiate Markdown Editor #2 English
	editorEN = new EpicEditor(opts);
	editorEN.load();
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

		$.post('article/sort', { articles: articles, _token: $('#_token').text() })
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
		})
		$('.section-header').click(function() {
			var section = $(this).attr('data-key');
			if($('.section-content[data-key="'+section+'"]').hasClass('hidden')) {
				$('.section-content[data-key="'+section+'"]').removeClass('hidden');
			}
			else {
				$('.section-content[data-key="'+section+'"]').addClass('hidden');
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
	else if($('form').hasClass('section-editor-form')) {
		$('#media-type-select').change(function() { 
			var selected = $('#media-type-select option:selected').val();
			$('.media-type').addClass('hidden');
			$('#media-'+selected).removeClass('hidden');
		});
	}
	else if($('form').hasClass('magazine-form')) {
		$('#active-magazine').change(function() { 
			setActiveMagazine();
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