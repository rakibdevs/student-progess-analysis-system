/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.removePlugins = 'wsc,scayt,blockquote,save,flash,iframe,tabletools,pagebreak,templates,about,showblocks,newpage,language,print,div,maximize';
    config.removeButtons = 'Source,Print,Form,TextField,Textarea,Button,CreateDiv,Copy,Cut,Undo,Redo,Paste,PasteText,PasteFromWord,Select,HiddenField,Radio,Checkbox,ImageButton,Anchor,BidiLtr,BidiRtl,Preview,Indent,Outdent';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor_wiris';
	//config.toolbar_Full.push({name:'wiris', items:['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry']});
	config.allowedContent = true;
	config.height = '200px';
};
