<!DOCTYPE HTML>
<!--
	Theory by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Hearty Arts</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.php" class="logo"></a>
					<nav id="nav">
						<a href="index.php">Home</a>
						<a href="about.php">About</a>
						<a href="products.php">Products</a>
                                                <a href="news.php">News</a>
                                                <a href="contacts.php">Contacts</a>
                                                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
                                                    <a href="account.php?logout=true">Log Out</a>
                                                <?php } else { ?>
                                                    <a href="login.php">Login</a>
                                                <?php } ?>    
					</nav>
                                       
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>
                 <div></div>
