(function( $ ) {

	//proccess forms Ajax
	function processHttpRequest(url, data, re){
        if(url && data){
            return $.ajax({
               	url: url,
               	data: data,
               	cache: false,
               	type: 'post',
               	processData: false,
               	contentType: false,
               	datatype: re
            }).promise();
        }
    }

	

	//call a function to handle file upload on select file
	//$('input[type=file]').on('change', fileUpload)

	// $('#newresform').on('submit',  function(e){
	// 	e.preventDefault();
	// 	if(!fileUpload){
	// 		$('.resdropBox').html('upload failed, pls Try again!');
	// 	}else{
	// 		var formdata = $('#newresform').serialize();
	// 		//console.log(formdata);
	// 		processHttpRequest('controller/create/index.php',  data, 'FormData').then(function(re){
	// 			//var response = JSON.parse(re);
	// 			console.log(re);
	// 			$('#newresalert').html(re);
				
 //            });
	// 	}
	// });
		


	function fileUpload(event){
		//notify user about the file upload status
		$('#resdropBox').html(event.target.value+" Uploading...");

		//get selected file
		files = event.target.files;

		//form data check the above bullet  for what it is
		var data = new FormData();

		//file is presented as an array
		for( var i = 0; i < files.length; i++){
			var  file = files[i];
			if(!file.type.match('text.*|image.*|application.*')){
				//check file type
				$('.resdropBox').html("Please choose a valid file.");
			}else if(file.size > 1048576){
				//check file size in bytes
				$('.resdropBox').html("Sorry, your file is too large(>1 MB)");
			}else{
				//append the uploaded file to FormData object
				data.append('file', file, file.name);
				processHttpRequest('controller/create/index.php',  data, 'FormData').then(function(re){
					//get responds and show the uploading status
					var response = JSON.parse(re);
					console.log(response);
					if(response.status == 'ok'){
						$('.resdropBox').html("File has been uploaded succesfully. Click to upload another.");
					}else if(response.status == 'err'){
						$('.resdropBox').html("Image file could not be uploaded.");
					}else if(response.status == 'type_err'){
						$('.resdropBox').html("Please choose an Image file. Click to upload another.");
					}else{
						$('.resdropBox').html("Some problem occured, please try again");
					}
	            });
			}
		}
	}
})( jQuery );