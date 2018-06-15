<?php
	echo $_GET['id'];
	$dsn = "mysql: host=localhost; dbname=18php02";
    try {
        $conn = new PDO($dsn, "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM products WHERE productId = :product_id");
        $data = array('product_id' => $_GET['id']);
        $stmt->execute($data);
        header('Location: ../listProduct.php');
    }
    catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    //discoonnect database
    $conn = null;
?>