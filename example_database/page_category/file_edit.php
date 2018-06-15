<?php
	if (isset($_GET['btn'])) {
		//connect database
		$dsn = "mysql: host=localhost; dbname=18php02";
		try {
		    $conn = new PDO($dsn, "root", "");
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $getId = $_GET['foo'];
			$update = isset($_GET['update']) ? trim($_GET['update']) : "";

			if ($update == NULL) {
					echo "Hãy nhập tên danh mục để chỉnh sửa";
			} else {
				$query = $conn->prepare("SELECT * FROM categories WHERE categoryName = :name");
				$data = array('name' => $update);
				$query->execute($data);
				$result = $query->fetch(PDO::FETCH_ASSOC);
				if (!$result) {
					$stmt = $conn->prepare("UPDATE categories SET categoryName = :name
						WHERE categoryId = :getId");
					$data = array('name' => $update,'getId' => $getId);
					$stmt->execute($data);
					header('Location: ../listCategory.php');
				} else echo "Danh mục đã tồn tại";
			}
		}
		catch (PDOException $e) {
		    echo $sql . "<br>" . $e->getMessage();
		}
		//discoonnect database
		$conn = null;
	}
?>