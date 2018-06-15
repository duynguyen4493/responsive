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
            $getId = isset($_POST['foo']) ? $_POST['foo'] : "";
            $checkUpdate = FALSE;

            //update Product name
            if ($productName != NULL) {
                $stmt_1 = $conn->prepare("UPDATE products SET productName = :product_name WHERE productId = :product_id");
                $data_1 = array('product_name' => $productName, 'product_id' => $getId);
                $stmt_1->execute($data_1);
                $checkUpdate = TRUE;
            }

            //update category Id

            if ($categoryName != NULL) {
                $stmt_2 = $conn->prepare("SELECT categoryId FROM categories WHERE categoryName = :category_name");
                $data_2 = array('category_name' => $categoryName);
                $stmt_2->execute($data_2);
                $result_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
                if ($result_2) {
                    $stmt_3 = $conn->prepare("UPDATE products SET categoryId = :category_id WHERE productId = :product_id");
                    $data_3 = array('category_id' => $result_2['categoryId'], 'product_id' => $getId);
                    $stmt_3->execute($data_3);
                    $checkUpdate = TRUE;
                } else echo "Danh mục không tồn tại";
            }

            //update price
            if ($price != NULL) {
                $stmt_4 = $conn->prepare("UPDATE products SET Price = :price WHERE productId = :product_id");
                $data_4 = array('price' => $price, 'product_id' => $getId);
                $stmt_4->execute($data_4);
                $checkUpdate = TRUE;
            }

            //update image
            if ($_FILES['image']['tmp_name'] != NULL) {
                echo "hehehe";
                $target_file = "../images/" . basename($_FILES['image']['name']);
                $target_file_edit = "images/" . basename($_FILES['image']['name']);
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
                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                        $stmt_5 = $conn->prepare("UPDATE products SET imageName = :image_name WHERE productId = :product_id");
                        $data_5 = array('image_name' => $target_file_edit, 'product_id' => $getId);
                        $stmt_5->execute($data_5);
                        $checkUpdate = TRUE;
                    }
                } else echo "file upload không thành công";
            }
            
            //update day edit
            if ($checkUpdate) {
                $getDay = (string) date('Y-m-d');
                $stmt_6 = $conn->prepare("UPDATE products SET dayEdit = :day_edit WHERE productId = :product_id");
                $data_6 = array('day_edit' => $getDay, 'product_id' => $getId);
                $stmt_6->execute($data_6);
                header('Location: ../listProduct.php');
            } else echo "Cập nhật sản phẩm không thành công! ";
            echo "Click vào link để quay lại trang chủ" . "</br>";
            echo '<a href="../listProduct.php">list Product</a>';
        }
    }
    catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    //discoonnect database
    $conn = null;
?>
