<?php
    $dsn = "mysql: host=localhost; dbname=18php02";
    try {
        $conn = new PDO($dsn, "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['btn'])) {
            //add category name
            $categoryName = isset($_POST['categoryName']) ? trim($_POST['categoryName']) : "";
            if ($categoryName == NULL) {
                $error = 'Hãy nhập tên danh mục';
            } else {
                $stmt_1 = $conn->prepare("SELECT * FROM categories WHERE categoryName = :category_name");
                $data_1 = array('category_name' => $categoryName);
                $stmt_1->execute($data_1);
                $result_1 = $stmt_1->fetch();
                if (!$result_1) {
                   $sql = "INSERT INTO categories (categoryName)
                    VALUES (:categoryName)";
                    $stmt_2 = $conn->prepare($sql);
                    $data_2 = array('categoryName' => $categoryName);
                    $stmt_2->execute($data_2);
                    $success = "Đã thêm danh mục $categoryName thành công!";
                } else $error = "Danh mục đã tồn tại";
            }
        }    
        //show list category
        $sql = "SELECT * FROM categories";
        $stmt_3 = $conn->prepare($sql);
        $stmt_3->execute();
        $result_3 = $stmt_3->fetchAll(PDO::FETCH_ASSOC);
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
     <link rel="stylesheet" type="text/css" href="css/style_for_categorylist.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
 </head>
 <body>
    <div class="container">
        <div class="alert row">
            <div class="col-md-4">
                <?php if (isset($success)) : ?>
                    <p><?php echo $success ?></p>
                <?php endif ?>
                <?php if (isset($error)) : ?>
                    <p><?php echo $error ?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form">
            <form class="form-check" action="" method="POST">
                <label for="category"><p>Danh Mục</p></label>
                <input type="text" name="categoryName">
                <input class="btn-success" type="submit" name="btn" value="Add">
            </form>
        </div>
        <div class="row">
            <div class="col-md-5">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category_name</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($result_3) > 0) : ?>
                            <?php foreach ($result_3 as $row) : ?>
                                <tr>
                                    <td><?php echo $row['categoryId'] ?></td>
                                    <td><?php echo $row['categoryName'] ?></td>
                                    <td><a href="page_category/form_edit.php?id=<?php echo $row['categoryId'] ?>">Sửa</a></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </body>
 </html>