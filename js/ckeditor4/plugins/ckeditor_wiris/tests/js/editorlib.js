/**
 * Creates a CKEditor instance on "example" div.
 * @param {String} lang CKEditor language. MathType read this variable to set the editor lang.
 * @param {String} wiriseditorparameters JSON containing MathType Web parameters.
 */
function createEditorInstance(lang, wiriseditorparameters) {

	// Defines editor language, 'en' by default
	if (typeof lang == 'undefined') {
		lang = 'en';
	}

	// If wiriseditorparameters is not defined, an empty JSON as parameter.
	// This config parameter is not mandatory. Only use them when you want to change
	// any editor params from the client side.
	// It is recommended to define editor params on configuration.ini.
	if (typeof wiriseditorparameters === 'undefined') {
		wiriseditorparameters = {};
	}

	// Disables creating the inline editor automatically for elements with the contenteditable attribute set to true.
	CKEDITOR.disableAutoInline = true;

	// Custom toolbar for demo.
	CKEDITOR.config.toolbar_Full =
	[
	{ name: 'document', items : [ 'Source'] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
	{ name: 'editing', items : [ 'Find'] },
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
	{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
	];

	

	let ckEditorConfiguration = {
		
		toolbar:'Full',
		height: '365px',
		// Editor parameters. Not mandatory.
		wiriseditorparameters: wiriseditorparameters
	};

	// This is done to test when the user doesn't initialize the editor with the language property.
	if (lang !== 'en') {
		ckEditorConfiguration.language = lang;
	}

	// CKEDITOR instance.
	CKEDITOR.replace('example',ckEditorConfiguration);


	// Focusing CKEditor when the instance is ready. Only for demo porpuses.
	CKEDITOR.on("instanceReady", function(event)
	{
		CKEDITOR.instances.example.focus();
		updateFunction();
	});
}

// Creating CKEditor demo instance.
if (typeof _wrs_int_langCode !== 'undefined') {
	createEditorInstance(_wrs_int_langCode, {});
} else {
	createEditorInstance('en', {});
}

/**
 * Getting data from editor using getData CKEditor method.
 * formulas are parsed to save mode format (mathml, image or base64)
 * For more information see: http://www.wiris.com/es/plugins/docs/full-mathml-mode.
 * @return {String} CKEditor parsed data.
 */
 function getEditorData() {
 	return CKEDITOR.instances.example.getData();
 }


/**
 * Changes dynamically wiriseditorparameters CKEditor config variable.
 * @param {Json} json_params MathType Web editor parameters.
 */
 function setParametersSpecificPlugin(wiriseditorparameters) {
 	var lang = CKEDITOR.instances.example.config.language;
 	resetEditor(lang, wiriseditorparameters);
 }

/**
 * Resets CKEDITOR instance.
 * @param {Lang} lang CKEditor language.
 * @param {Json} wiriseditorparameters JSON containing MathType Web parameters.
 */
 function resetEditor(lang, wiriseditorparameters){
 	if (typeof wiriseditorparameters === 'undefined') {
 		var wiriseditorparameters = {}
 	}
	// Destroying CKEditor instance.
	CKEDITOR.instances.example.destroy();
	// New CKEditor instance.
	createEditorInstance(lang, wiriseditorparameters);
	// Reset modal window.
	_wrs_modalWindow = undefined;
}


/**
 * Gets wiriseditorparameters from CKEditor.
 * @return {Object} MathType web parameters as JSON. An empty JSON if is not defined.
 */
 function getWirisEditorParameters() {
 	if (typeof CKEDITOR.instances.example.config != 'undefined' && typeof CKEDITOR.instances.example.config.wiriseditorparameters != 'undefined') {
 		return CKEDITOR.instances.example.config.wiriseditorparameters;
 	}
 	return {};
 }