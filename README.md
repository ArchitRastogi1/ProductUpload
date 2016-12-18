This Project has 2 folders where code is written - 
1 - public
2 - app

public folder has files which are accessable to everyone.
app folder has files which are not accessable to everyone.

Request first go to index.php file which is inside public folder , this index.php redirects request to corrosponding api

In app folder there are 4 subfolders 

1 - batch (it has cron job files)
2 - services (it has services which do tasks like communticating with dao etc)
3 - models (object model and constant files etc)
4 - dao (it performs db operations)
5 - routes (posts,gets)
	It has apis 

Tasks - 

HomePage - url  - http://localhost:8888/public/

Image Upload API - url  -  htpp://localhost:8888/public/posts/imageUpload
Product Details API - url - http://localhost:8888/public/posts/productDetails
Product Details Fetch API - url - http://localhost:8888/public/gets/productData

Cron Job Running command - /usr/local/php/bin/php app/batch/DeleteDataFromRedis.php


DB  structure  - 

there are 2  tables - (ProductImage, ProductData)
ProductImage saves images data
ProductData saves product details like name, price etc



