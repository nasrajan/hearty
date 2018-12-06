<!--
	Theory by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php 
$contacts = file ("contacts.txt.txt");
$i=0;
foreach ($contacts as $contact) {
    $match = explode("-", $contact);
    $contactList[$i]['name'] = $match[0];
    $contactList[$i++]['email'] = $match[1];
    
}

include 'includes/header.php'; 
?>

		<!-- Three -->
			<section id="three" class="wrapper">
				<div class="inner">
					<header class="align-center">
						<h2>Contacts</h2>
						<p>The website contacts are given below </p>
					</header>
                                    <table>
                                        <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        </tr>
                                   <?php foreach ($contactList as $contactItem) { ?>     
                                        <tr>
                                            <td><?php echo $contactItem['name'] ?></td>
                                            <td><?php echo $contactItem['email'] ?></td>
                                        </tr>
                                   <?php } ?>    
                                    </table>

				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<div class="flex">
						<div class="copyright">
							&copy; Hearty Arts Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com">Unsplash</a>.
						</div>
						<ul class="icons">
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-linkedin"><span class="label">linkedIn</span></a></li>
							<li><a href="#" class="icon fa-pinterest-p"><span class="label">Pinterest</span></a></li>
							<li><a href="#" class="icon fa-vimeo"><span class="label">Vimeo</span></a></li>
						</ul>
					</div>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>