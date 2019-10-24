<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>S1Meon.art - Projects</title>
	<link rel="stylesheet" type="text/css" href="formatting.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<?php require_once "recaptchalib.php";?>
</head>

<body class="blur">
	<input type="checkbox" id="toggler" onchange="navToggled()" checked>
	<div class="wrap">
		<label for="toggler" class="toggle">
			<p class="toggle">☰</p>
		</label>
	</div>
	<div class="container">
		<div class="glass">
			<h2><b>S1M</b>eon art</h2>
			<h4>ARTIST | COMPUTER SCIENTIST</h4>
			<h3>My Projects</h3>
			<h4>An unsorted collection of a few of my HTML 5 (and other) projects I've made in the past.</h4>
			<div class="glass" style="margin: 10px 10px 20px 10px; padding: 5px;">
				<a href="PoW" style="text-decoration: none;">
					<h4 style="margin: 0;">Proof of Work - Blockchain simulation tool</h4>
				</a>
				<a href="pool" style="text-decoration: none;">
					<h4 style="margin: 0;">Blockchain payment schemes - Algorithm analyzer tool</h4>
				</a>
			</div>
			<div id="gallery">
				<script>
					<?php
						function isHTML($var){
							return (endsWith($var,".html")||endsWith($var,".php"));
						}
						function isIMG($var){
							return (endsWith($var,".jpg")||endsWith($var,".png"));
						}
						function endsWith($a,$b){
							$l=strlen($b);
							return $l===0||(substr($a,-$l)===$b);
						}
						
						$galleryLinks=array_slice(scandir("old/project"),2);
						$thumbnailImages=array_slice(scandir("old/project/thumbnail"),2);
						$galleryLinks=array_filter($galleryLinks,"isHTML");
						$thumbnailImages=array_filter($thumbnailImages,"isIMG");
						
						$galleryLinks=explode("~","old/project/".implode("~old/project/",$galleryLinks));
						$thumbnailImages=explode("~","old/project/thumbnail/".implode("~old/project/thumbnail/",$thumbnailImages));
						
						array_push($galleryLinks,"projectBALL");
						array_push($thumbnailImages,"projectBALL/thumbnail.jpg");
						
						$count = count($galleryLinks);
						$order = range(1, $count);
						shuffle($order);
						array_multisort($order, $galleryLinks, $thumbnailImages);

						echo "var galleryLinks = [\n";
						echo "\t\t\t\t\t\t\"".implode("\",\n\t\t\t\t\t\t\"",$galleryLinks)."\"\n\t\t\t\t\t];\n";
						echo "\t\t\t\t\tvar thumbnailImages = [\n";
						echo "\t\t\t\t\t\t\"".implode("\",\n\t\t\t\t\t\t\"",$thumbnailImages)."\"\n\t\t\t\t\t];\n";
					?>
				</script>
			</div>
			<h4 style="text-align: left">
				<a href="http://smilebasicsource.com/page?pid=630" target="_blank">3D Parkour</a> - I spent 2015 to 2017 developing this masssive 3D game for the Nintendo 3DS using the SmileBASIC programming language.<br>
				<a href="http://smilebasicsource.com/page?pid=284" target="_blank">Fractal Canvas</a> - A high performance fractal exploring application for the Nintendo 3DS.<br>
			</h4>
			<br>
			<h3>Find me at</h3>
			<div class="social">
				<a href="https://s1meon.deviantart.com/" target="_blank"><span>DeviantArt</span></a>
				<a href="https://www.instagram.com/simewu/" target="_blank"><span>Instagram</span></a>
				<a href="http://colorslive.com/author?id=95735" target="_blank"><span>Colors3D</span></a>
				<a href="https://twitter.com/monstre180" target="_blank"><span>Twitter</span></a>
			</div>
			<h4>You can show your support by clicking the link down below!</h4>
			<div class="social">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
					">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
			<div id="bingCited" class="glass">
				<h3 style="font-size: 16px;">Wallpaper from <a href="https://www.bing.com/" target="_blank">Bing Images</a></h3>
			</div>
		</div>
	<?php require_once "include/init.php"?></div>
	<div class="hidden">
		<ul>
			<!--<li>
				<a href="/"><img src="profile.jpg" alt="" class=""/></a>
			</li>-->
			<li><a href="">Home</a></li>
			<li><a href="gallery.php">Artwork</a></li>
			<li><a href="projects.php" class="selected">Projects</a></li>
			<li><a href="portfolio.php">Portfolio</a></li>
		</ul>
	</div>
</body>
<script src="main.js"></script>
</html>