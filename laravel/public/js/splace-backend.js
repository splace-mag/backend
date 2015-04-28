var editorDE, editorEN;

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
	console.log(text)
	var sections = {};
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
		'page_titleDE': $('[name="page_titleDE"]').val(), 
		'page_subtitleDE': $('[name="page_subtitleDE"]').val(), 
		'textDE': $('[name="descriptionDE"]').val(), 
		'editor_section_codeDE': $('[name="textDE"]').val(), 
		'titleEN': $('[name="titleEN"]').val(), 
		'page_titleEN': $('[name="page_titleEN"]').val(), 
		'page_subtitleEN': $('[name="page_subtitleEN"]').val(), 
		'textEN': $('[name="descriptionEN"]').val(), 
		'editor_section_codeEN': $('[name="textEN"]').val(), 
		'author': $('[name="author"]').val(), 
		'author_descriptionDE': $('[name="author_descriptionDE"]').val(), 
		'author_descriptionEN': $('[name="author_descriptionEN"]').val(), 
		'used_material': $('[name="used_material"]').val(), 
	};

	var sectionsDE = editorDE.getElement('previewer');
	sectionsDE = parseSections($(sectionsDE).find('#epiceditor-preview').html());

	var sectionsEN = editorEN.getElement('previewer');
	sectionsEN = parseSections($(sectionsEN).find('#epiceditor-preview').html());


	$.post(article['id'], { _token: token, article: article, sectionsDE: sectionsDE, sectionsEN: sectionsEN })
        .success(function(response){
        	showSuccess('article');
        	setTimeout(function() { 
        		history.back() 
        	}, 2000);
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
		'textDE': $('[name="textDE"]').val(), 
		'textEN': $('[name="textEN"]').val(), 
		'noteDE': $('[name="noteDE"]').val(), 
		'noteEN': $('[name="noteEN"]').val(), 
		'note_shortDE': $('[name="noteShortDE"]').val(), 
		'note_shortEN': $('[name="noteShortEN"]').val(), 
	};

	$.post(section['id'], { _token: token, section: section })
        .success(function(response){
        	showSuccess('section');
        	setTimeout(function() { 
        		history.back() 
        	}, 2000);
        })
        .error(function(response){
            showError('section');
        });
}
function showSuccess(form){
	$('.'+form+'-editor-form__success').css('display', 'block');
}
function showError(form){
	$('.'+form+'-editor-form__error').css('display', 'block');
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

function init() {
	changeLanguage();
	
	if($('form').hasClass('article-editor-form')) {
		epiceditor();

	}

	$('.article-editor-form').on('submit', saveArticle);
	$('.section-editor-form').on('submit', saveSection);
}


init();