<form id="file-form" action="http://localhost:8888/posts/productDetails" method="POST">
  <input type="file" id="file-select" name="photos[]" multiple/>
  <button type="submit" id="upload-button">Upload</button>
  <br>
</form>
<form action="http://localhost:8888/public/posts/productDetails" method="POST">
  Product ID:<br>
  <input type="text" name="productId" value="XYZ">
  <br>
  Name:<br>
  <input type="text" name="productName" value="Product">
  <br>
  Price:<br>
  <input type="text" name="productPrice" value="100">
  <br>
  <input type="submit" value="Submit">
</form>


<script type="text/javascript">
    var form = document.getElementById('file-form');
    var fileSelect = document.getElementById('file-select');
    var uploadButton = document.getElementById('upload-button');
    var imageIds = [];
    form.onsubmit = function(event) {
        event.preventDefault();
        //uploadButton.innerHTML = 'Uploading...';
        var files = fileSelect.files;
        var xhr = new XMLHttpRequest();
        for (var i = 0; i < files.length; i++) {
            var formData = new FormData();
            var file = files[i];
            if (!file.type.match('image.*')) {
                continue;
            }
            formData.append('photo', file, file.name);
            xhr.open('POST', 'http://localhost:8888/public/posts/imageUpload', true);
            xhr.send(formData);
//            xhr.onload = function(){
//                if (xhr.status === 200) {
//                    imageIds.push(xhr.response);
//                }
//            }
            
        }
}
</script>