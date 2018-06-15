<?php
	$getId = (int) $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<?php if(isset($error)) : ?>
			<div class="alert row">
				<div class="col-md-5">
					<p><?php echo $error ?></p>
				</div>
			</div>
		<?php endif ?>
		<div class="form">
			<form action="file_edit.php" method="GET">
				<label for="update"><p>Chỉnh sửa danh mục</p></label></br>
				<input name="update" type="text">
				<input class="btn-success" type="submit" name="btn" value="Update">
				<input type="hidden" name="foo" value="<?php echo $getId ?>">
			</form>
		</div>
	</div>
</body>
</html>