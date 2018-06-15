<?php
    //connect database
    $dsn = "mysql: host=localhost; dbname=18php02";
    try {
        $conn = new PDO($dsn, "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //when click button Submit
        if (isset($_POST['btn'])) {
            $productName = isset($_POST['productName']) ? trim($_POST['productName']) : "";
            $categoryName = isset($_POST['categoryName']) ? trim($_POST['categoryName']) : "";
            $price = isset($_POST['price']) ? trim($_POST['price']) : "";

            //upload image
            if ($_FILES['image']['tmp_name'] != NULL) {
                $target_file = "images/" . basename($_FILES['image']['name']);
                $uploadOk = 1;
                $imageFileTyppe = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                $check = getimagesize($_FILES['image']['tmp_name']);
                if (!$check) {
                    echo "File upload không phải là file hình ảnh";
                    $uploadOk = 0;
                }
                if ($_FILES['image']['size'] > 500000) {
                    echo "file upload qúa lớn";
                    $uploadOk = 0;
                }
                if ($imageFileTyppe != 'jpg' and $imageFileTyppe != 'png' and $imageFileTyppe != 'jpeg' and $imageFileTyppe != 'gif' ) {
                    echo "Chỉ được upload file jpg, png, jpeg và gif";
                    $uploadOk = 0;
                }
            } else $error_1 = "Bạn chưa chọn hình ảnh";

            //add product into database
            if ($productName == NULL or $categoryName == NULL or $price == NULL or $uploadOk == 0) {
                $error_2 = 'Hãy nhập đầy đủ thông tin và tải lại hình ảnh';
            } else {

                //add product
                $stmt_1 = $conn->prepare("SELECT categoryId FROM categories WHERE categoryName = :category_name");
                $data_1 = array('category_name' => $categoryName);
                $stmt_1->execute($data_1);
                $result_1 = $stmt_1->fetch(PDO::FETCH_ASSOC);
                if ($result_1) {
                    $stmt_2 = $conn->prepare("SELECT * FROM products WHERE productName = :product_name");
                    $data_2 = array('product_name' => $productName);
                    $stmt_2->execute($data_2);
                    $result_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
                    if (!$result_2) {
                        $getDay = (string) date('Y-m-d');
                        $stmt_3 = $conn->prepare("INSERT INTO products (categoryId, productName, Price, dayPost, imageName) VALUES (:category_id, :name, :price, :day_post, :image_name)");
                        $data_3 = array('category_id' => $result_1['categoryId'], 'name' => $productName, 'price' => $price, 'day_post' => $getDay, 'image_name' => $target_file);
                        $stmt_3->execute($data_3);

                        //copy image to folder images
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                                echo "Hình sản phẩm đã được lưu";
                            }
                        } else $error_1 = "file upload không thành công";

                        $success = "Đã thêm sản phẩm $productName thành công!";

                    } else $error_2 = "Sản phẩm này đã tồn tại";
                    
                } else $error_2 = "Sản phẩm không nằm trong các danh mục đã tạo";
            }
        }
        //show list product
        $stmt_4 = $conn->prepare("SELECT * FROM products");
        $stmt_4->execute();
        $showResult = $stmt_4->fetchAll(PDO::FETCH_ASSOC);

        //search product
        if (isset($_POST['btn_search'])) {
            $search = isset($_POST['search']) ? trim($_POST['search']) : "";
            $select = isset($_POST['select']) ? trim($_POST['select']) : "";
            if ($search == NULL) {
                $error_3 = "Bạn chưa nhập dữ liệu để tìm kiếm";
            } else {
                if ($select == 'categoryName') {
                    $stmt = $conn->prepare("SELECT * FROM products 
                        INNER JOIN categories ON products.categoryId = categories.categoryId
                        WHERE categories.categoryName = :search");
                    $data = array('search' => $search);
                    $stmt->execute($data);
                    $showResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                if ($select == 'productName') {
                    $stmt = $conn->prepare("SELECT * FROM products WHERE productName = :search");
                    $data = array('search' => $search);
                    $stmt->execute($data);
                    $showResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                if ($select == 'dayPost') {
                    $stmt = $conn->prepare("SELECT * FROM products WHERE dayPost = :search");
                    $data = array('search' => $search);
                    $stmt->execute($data);
                    $showResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                if ($select == 'Price') {
                    $search = (int)$search;
                    $stmt = $conn->prepare("SELECT * FROM products WHERE Price = :search");
                    $data = array('search' => $search);
                    $stmt->execute($data);
                    $showResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                $searched = count($showResult);
                $searchAlert = "Đã tìm được $searched sản phẩm";
            }
        }
    }
    catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    //discoonnect database
    $conn = null;
?>
 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title></title>
     <link rel="stylesheet" type="text/css" href="css/style_for_productlist.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
 </head>
 <body>
    <div class="container">
        <div class="alert row">
            <div class="col-md-4">
                <?php if (isset($success)) : ?>
                    <p><?php echo $success ?></p>
                <?php endif ?>
                <?php if (isset($error_1)) : ?>
                    <p><?php echo $error_1 ?></p>
                <?php endif ?>
                <?php if (isset($error_2)) : ?>
                    <p><?php echo $error_2 ?></p>
                <?php endif ?>
                <?php if (isset($error_3)) : ?>
                    <p><?php echo $error_3 ?></p>
                <?php endif ?>
                <?php if (isset($searchAlert)) : ?>
                    <p><?php echo $searchAlert ?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form">
            <form class="form-check" action="" method="POST" enctype="multipart/form-data">
                <label for="product"><p>Tên sản phẩm:</p></label>
                <input type="text" name="productName">
                <label for="category"><p>Danh Mục:</p></label>
                <input type="text" name="categoryName"></br>
                <label for="category"><p>Giá sản phẩm:</p></label>
                <input type="number" name="price">
                <input type="file" name="image">
                <input class="btn btn-success" type="submit" name="btn" value="Add Product">
            </form>
        </div>
        <div class="search">
            <form action="" method="POST">
                <label for="search"><p>Tìm kiếm:</p></label>
                <input type="text" name="search">
                <select name="select" id="select">
                    <option value="categoryName">theo danh mục</option>
                    <option value="productName">theo tên SP</option>
                    <option value="dayPost">theo ngày đăng</option>
                    <option value="Price">theo giá SP</option>
                </select>
                <input class="btn-primary" type="submit" name="btn_search" value="Search">
            </form>
        </div>
        <div class="table row">
            <div class="col-md-8">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hình sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach ($showResult as $row) : ?>
                                <tr>
                                    <?php
                                        $dsn = "mysql: host=localhost; dbname=18php02";
                                        $conn = new PDO($dsn, "root", "");

                                        $stmt = $conn->prepare("SELECT categoryName FROM categories WHERE categoryId = :getId");
                                        $data = array('getId' => $row['categoryId']);
                                        $stmt->execute($data);
                                        $name = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <td><p><?php echo $row['productId'] ?></p></td>
                                    <td><img  id="avatar" src="<?php echo $row['imageName'] ?>" alt="Hình sản phẩm"></td>
                                    <td><p><?php echo $row['productName'] ?></p></td>
                                    <td><p><?php echo $name['categoryName'] ?></p></td>
                                    <td><p><?php echo $row['Price'] . ' đ' ?></p></td>
                                    <td><p><a href="page_product/form_edit.php?id=<?php echo $row['productId'] ?>">Sửa</a></p></td>
                                    <td><p><a href="page_product/delete.php?id=<?php echo $row['productId'] ?>">Xóa</a></p></td>
                                </tr>
                            <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </body>
 </html>