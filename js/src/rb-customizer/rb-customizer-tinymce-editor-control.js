( function( $ ) {
	var tinymceSettings = {
		quicktags: {
			buttons:"strong,em,link,ul,ol,li"
		},
		tinymce: {
			branding:false,
			browser_spellcheck:true,
			cache_suffix:"wp-mce-4607-20180123",
			convert_urls:false,
			elementpath:false,
			end_container_on_empty_block:true,
			entities:"38,amp,60,lt,62,gt",
			entity_encoding:"raw",
			fix_list_elements:true,
			//formats:{alignleft: Array(2), aligncenter: Array(2), alignright: Array(2), strikethrough: {…}},
			indent:true,
			keep_styles:false,
			language:"es",
			menubar:false,
			plugins:"charmap,colorpicker,hr,lists,paste,tabfocus,textcolor,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wptextpattern",
			preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",
			relative_urls:false,
			remove_script_host:false,
			resize:"vertical",
			skin:"lightgray",
			theme:"modern",
			toolbar1:"bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,outdent,indent,cut,copy,paste,undo,redo,link,unlink,image,cleanup,help,code,hr,removeformat,formatselect,fontselect,fontsizeselect,styleselect,sub,sup,forecolor,backcolor,forecolorpicker,backcolorpicker,charmap,visualaid,anchor,newdocument,blockquote,separator",
			wp_keep_scroll_position:false,
			wp_lang_attr:"es-ES",
			wp_shortcut_labels:{
				'Align center':"accessC",
				'Align left':"accessL",
				'Align right':"accessR",
				'Blockquote':"accessQ",
				'Bold':"metaB",
				'Bullet list':"accessU",
				'Code':"accessX",
				'Copy':"metaC",
				'Cut':"metaX",
				'Distraction-free writing mode':"accessW",
				'Heading 1':"access1",
				'Heading 2':"access2",
				'Heading 3':"access3",
				'Heading 4':"access4",
				'Heading 5':"access5",
				'Heading 6':"access6",
				'Insert Page Break tag':"accessP",
				'Insert Read More tag':"accessT",
				'Insert/edit image':"accessM",
				'Italic':"metaI",
				'Justify':"accessJ",
				'Keyboard Shortcuts':"accessH",
				'Numbered list':"accessO",
				'Paragraph':"access7",
				'Paste':"metaV",
				'Redo':"metaY",
				'Remove link':"accessS",
				'Select all':"metaA",
				'Strikethrough':"accessD",
				'Toolbar Toggle':"accessZ",
				'Underline':"metaU",
				'Undo':"metaZ"
			},
			wpautop:false,
			wpeditimage_html5_captions:true
		}
	};

	$(document).ready(function(){
		$('#customize-controls').append(
		'<div id="rb-tinymce-editor-panel">'
		+'<div class="controls-bar"><i class="fas fa-times close-button"></i></div>'
		+'<div id="rb-tinymce-editor">'
		+'</div>'
		+'</div>');
	});

	$(document).on('click', '#rb-tinymce-editor-panel .controls-bar .close-button', function(){
		closeTinymceEditorPanel( $(this).closest('.customize-tinymce-control') );
	});

	$(document).on('click', '.customize-tinymce-control .edit-button', function(){
		openTinymceEditorPanel( $(this).closest('.customize-tinymce-control') );
	});

	function closeTinymceEditorPanel( $controlPanel ){
		$('#rb-tinymce-editor-panel').finish().fadeOut();
		wp.editor.remove( "rb-tinymce-editor" );
	}

	function openTinymceEditorPanel( $controlPanel ){
		$('#rb-tinymce-editor-panel').finish().fadeIn();
		wp.editor.initialize( "rb-tinymce-editor", tinymceSettings);		
	}

} )( jQuery );
