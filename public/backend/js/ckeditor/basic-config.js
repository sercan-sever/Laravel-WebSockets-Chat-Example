CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		'/',
		'/',
		'/',
		'/',
		'/',
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'align', 'bidi', 'blocks', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		/* { name: 'tools', groups: [ 'tools' ] }, */
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	config.removeButtons = 'Source,Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,About,ShowBlocks,Flash,PageBreak,SpecialChar,HorizontalRule,Anchor,Language,BidiRtl,BidiLtr,Find,CreateDiv,CopyFormatting,RemoveFormat,Styles,Format,Font,FontSize,Iframe';
};
