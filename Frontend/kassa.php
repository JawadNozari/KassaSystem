<?php
	session_start();
	/*
	if(!$_SESSION["inloggad"]){
		header("location:index.php");
	}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./Styles/kassa.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./Styles/navbar.css"> 
    <script src="../Scripts/kassa.js"></script>
    <title>Kassa</title>
</head>
<body>
	 <?php include "../Backend/header.php" ?>
  	<div class="container">
		<div class="ItemAdded"><a>Tillagd i varukorgen</a></div>  
    	<div class="row">
      		<div class="left">
        		<h2>Kategorier</h2>
        		<input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Sök.." title="Type in a category">
            	<ul id="myMenu">
            		<li><a href="#">Dryck</a></li>
              		<li><a href="#">Läsk</a></li>
              		<li><a href="#">Energidryck</a></li>
              		<li><a href="#">Kakor</a></li>
              		<li><a href="#">Godis</a></li>
              		<li><a href="#">Tuggumi</a></li>
              		<li><a href="#">Choklad</a></li>
              		<li><a href="#">Proteinbar</a></li>
            	</ul>
      		</div>
      		<div class="right mb-5">
            	<section class="pt-1 pb-2">
                    <div class="row w-100">
                        <div class="col-lg-12 col-md-12 col-12">
                            <h3 class="display-5 mb-2 text-center">Varukorg</h3>
                            <p class="mb-5 text-center">
                            <i class="text-info font-weight-bold"> <?php echo $_SESSION["index"] ?> </i> varor i din varukorg</p>
							<!--<table class="table">
								<thead>
									<th>Produkt</th>
									<th>Pris</th>

								</thead>
-->
							<?php 
								include "../Backend/fetch_data.php"; 
								include "../Backend/Calculation.php";
							?>
							<!--</table>-->
                            <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                                <a href="Kassa.php"><i class="fas fa-arrow-left mr-2"></i>Lägg till fler</a>
                            </div>
						</div>
					</div>
				</section>
        	</div>
    	</div>
  	</div>
</body>
</html>
<?php
  	if(isset($_POST['btn'])){
    	console($_POST['product_name']);
  	}
?>

<!--
	Namn, pris, antal
	Varor som inte har streckkod i listan
	Registrera manuellt
	Scanna, kommer upp
	Visa totala priset längst ner
	Trycka på lappar
	K key kontant
	S key swish
-->