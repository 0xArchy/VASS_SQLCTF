<?php
  require('config.php');
  if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $userhash = md5($_POST['username']);
    $sql = "INSERT INTO registration (username, userhash, campus, regtime) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $_POST['username'], $userhash , $_POST['campus'], time());
    if ($stmt->execute()) {;
	    setcookie('user', $userhash);
	    header("Location: /account.php");
	    exit;
    }
    $sql = "update registration set campus = ? where username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_POST['campus'], $_POST['username']);
    $stmt->execute();
    setcookie('user', $userhash);
    header("Location: /account.php");
    exit;
  }

?>

<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div >
    <div class="container">
		<h1 class="text-center m-5">Registro Hack&Win GSyA</h1>
		<img src="img/logoUCLM.jpg" height="500">
	</div>
	<section class="bg-secondary text-center p-5 mt-4">
		<div class="container p-3">
			<h3 class="text-white">Registro</h3>
			<form action="#" method="Post">
				<input type="text" name="username" placeholder="Usuario">
                <select id="campus" name="campus">
                 <option value="Ciudad Real">Ciudad Real</option>
                 <option value="Albacete">Albacete</option>
                 <option value="Cuenca">Cuenca</option>
                 <option value="Guadalajara">Guadalajara</option>
              </select>
				<button type="submit" class="btn btn-default">Registrar<i class="fa fa-envelope"></i></button>
			</form>
		</div>
	</section>
</div>
