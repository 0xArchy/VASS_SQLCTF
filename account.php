<?php
if (!isset($_COOKIE['user'])) {
  echo "Please Register!";
  exit;
}

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
		<h1 class="text-center m-5">Registro Hack&Win GSyA</h1>
		<img src="img/logoUCLM.jpg" height="500">
	</div>
	<section class="bg-dark text-center p-5 mt-4">
		<div class="container p-5">
            <?php 
              include('config.php');
              $user = $_COOKIE['user'];
              $sql = "SELECT username, campus FROM registration WHERE userhash = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("s", $user);
              $stmt->execute();
              
              $result = $stmt->get_result(); // get the mysqli result
              $row = $result->fetch_assoc(); // fetch data   
              echo '<h1 class="text-white">Welcome ' . $row['username'] . '</h1>';
              echo '<h3 class="text-white">Other Players In ' . $row['campus'] . '</h3>';
              $sql = "SELECT username FROM registration WHERE campus = '" . $row['campus'] . "'";
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {
                echo "<li class='text-white'>" . $row['username'] . "</li>";
              }
?>
		</div>
	</section>
</div>
