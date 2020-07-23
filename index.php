<html>
	<head>
		<title>Image Cropping</title>
		<script src="jquery-1.9.1.min.js"></script>
		<script src="bootstrap.min.js"></script>
		<script src="croppie.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css"></link>
		<link rel="stylesheet" href="croppie.css"></link>
	</head>
	
	<body>
		
		<input type="file" name="upload_image" id="upload_image">
		<br>
		<br>
		<div id="uploaded_image"></div>
		
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
		Developted by Parwiz Danyar
		
		<div class="modal" id="uploadimageModal" tabIndex={-1} role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example-Modal3">Design Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
					<div id="image_demo" style="width:350px;margin-top:30px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary crop_image">Upload</button>
                </div>							
                </div>
            </div>
        </div>
		
	</body>
	
	<script>
		$(document).ready(function(){
			$image_crop = $('#image_demo').croppie({
				enableExif:true,
				viewport:{
					width:200,
					height:200,
					type: 'square'
				},
				boundary:{
					width:300,
					height:300
				}
			});
			
			$("#upload_image").on('change', function(){
				var reader = new FileReader();
				reader.onload = function(event){
					$image_crop.croppie('bind', {
						url: event.target.result
					}).then(function(){
						console.log('JQuery bind complete');
					});
				}
				reader.readAsDataURL(this.files[0]);
				$('#uploadimageModal').modal('show');
			});
			
			$(".crop_image").click(function(event){
				$image_crop.croppie('result', {
					type: 'canvas',
					size: 'viewport'
				}).then(function(response){
					$.ajax({
						url:'upload.php',
						type: 'POST',
						data:{"image":response},
						success:function(data)
						{
							$("#uploadimageModal").modal("hide");
							$("#uploaded_image").html(data);
						}
					});
				});
			});
		});
	</script>
</html>