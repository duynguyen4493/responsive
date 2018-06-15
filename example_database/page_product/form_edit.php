<?php
	$getId = (int) $_GET['id'];
?>

<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title></title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
 </head>
 <body>
    <div class="container">
        <div class="form">
            <form class="form-check" action="file_edit.php" method="POST" enctype="multipart/form-data">
                <label for="product"><p>Tên sản phẩm</p></label>
                <input type="text" name="productName">
                <label for="category"><p>Danh Mục</p></label>
                <input type="text" name="categoryName">
                <label for="category"><p>Giá sản phẩm</p></label>
                <input type="number" name="price"></br>
                <label for="image"><p>Chọn hình ảnh</p></label>
                <input type="file" name="image">
                <input type="hidden" name="foo" value="<?php echo $getId ?>">
                <input class="btn-success" type="submit" name="btn" value="Update Product">
            </form>
        </div>
    </div>
 </body>
 </html>