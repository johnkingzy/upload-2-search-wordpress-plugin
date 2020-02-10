(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$.getScript('https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js');
	$.getScript('https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js');

	// When the window is loaded
	$( window ).load(function() {
		document.querySelector("#fileUploadForm").addEventListener('submit', readFile)
		// document.querySelector("#fileUploadForm input#customFile").addEventListener('change', function(evt) {
		// 	console.log('got here');
		// 	// document.querySelector("#fileUploadForm .custom-file-label").innerHTML = fileUpload.value
		// });
	});
      /*
       * Handles file upload
       */
	function readFile(evt) {
		evt.preventDefault();
		//Reference the FileUpload element.
		var fileUpload = document.getElementById('customFile');
		//Validate whether File is valid Excel file.
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
		if (regex.test(fileUpload.value.toLowerCase())) {
			if (typeof FileReader != 'undefined') {
				var reader = new FileReader();

				//For Browsers other than IE.
				if (reader.readAsBinaryString) {
					reader.onload = function(e) {
						processExcelFile(e.target.result);
					};
					reader.readAsBinaryString(fileUpload.files[0]);
				} else {
					//For IE Browser.
					reader.onload = function(e) {
						var data = '';
						var bytes = new Uint8Array(e.target.result);
						for (var i = 0; i < bytes.byteLength; i++) {
							data += String.fromCharCode(bytes[i]);
						}
						processExcelFile(data);
					};
					reader.readAsArrayBuffer(fileUpload.files[0]);
				}
			} else {
				alert('This browser does not support HTML5.');
			}
		} else {
			alert('Please upload a valid Excel file.');
		}
	}

	/*
		* Process excel file
		*/
	function processExcelFile(data) {
		//Read the Excel File data.
		var workbook = XLSX.read(data, {
			type: 'binary',
		});

		//Fetch the name of First Sheet.
		var firstSheet = workbook.SheetNames[0];

		//Read all rows from First Sheet into an JSON array.
		var excelRows = XLSX.utils.sheet_to_row_object_array(
			workbook.Sheets[firstSheet],
		);

		var results = []
		//Add the data rows from Excel file.
		for (var i = 0; i < excelRows.length; i++) {
			var obj = excelRows[i];
			var objKeys = Object.keys(obj);
			console.log(obj)
			results.push({
				id1: obj['Student ID'],
				id2: obj['Student ID_1'],
				classroom: obj['Class Room']
			});

		}
		$.ajax({
						url: window.location,
						type: 'POST',
						data: { data_import: true, results: JSON.stringify(results) },
						success: function( response){
							// console.log("data sent successfully");
							alert('Excel file was uploaded successfully');
						},
						error: function(error){
							console.log("error");
						}
			});

	}
})( jQuery );
