<html>
<head>
  <title>Homepage</title>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
</head>

<body>
<form id="file-form" method="POST">
  <input type="file" id="file-select" name="photos[]" multiple/>
  <button type="submit" id="upload-button">Upload</button>
  <p id="imageMsg"></p>
  <br>
</form>
  <form action="http://localhost:8888/public/posts/productDetails" method="POST" id="productDetails">
  Product ID:<br>
  <input type="text" name="productId" value="XYZ">
  <br>
  Name:<br>
  <input type="text" name="productName" value="Product">
  <br>
  Price:<br>
  <input type="text" name="productPrice" value="100">
  <br>
  <input type="hidden" name="imageIds" id="imageIDs">
  <input type="submit" id="ProductSubmit" value="Submit">
</form>
   <p id="detailsMsg"></p>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    var fileForm = $('#file-form');
    var ProductSubmit = $('#ProductSubmit');
    var fileSelect = document.getElementById('file-select');
    var uploadButton = document.getElementById('upload-button');
    var imageIds = [];
    
    ProductSubmit.off().on('click',function(event){
        event.preventDefault();
        $('#imageIDs').val(imageIds);
        $('#productDetails').submit();
    });
    fileForm.off().on('submit',function(event) {
        event.preventDefault();
        
        var l=$('#file-select')[0].files.length,ajaxObj={};
        $.each($('#file-select')[0].files, function(i, file) {
            var data = new FormData();
            data.append('photo', file);
            ajaxObj=uploadFile(ajaxObj,data);
        });
        $('#imageMsg').html('Images Uploaded');
        function uploadFile(ajaxObj,data){
          var ajaxPromise={};
          if(ajaxObj.always)
            {
              ajaxObj.always(function(){
                ajaxPromise=uploadAjaxCall(data);
              })
            }
            else
            {
             ajaxPromise=uploadAjaxCall(data)
            }
            return ajaxPromise;
          }

          function uploadAjaxCall(data){
             var ajaxPromise=$.ajax({
                url: 'http://localhost:8888/public/posts/imageUpload',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data){
                    imageIds.push(data);
                }
              });
             return ajaxPromise;
          }
          
        
});
</script>
</body>
</html>