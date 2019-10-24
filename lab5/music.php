<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>

		<!-- Ex 1: Number of Songs (Variables) -->
		<?php $song_count = 5678; ?>
		<p>
			I love music.
			I have <?= $song_count ?> total songs,
			which is over <?= (int)($song_count/10) ?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->

		<div class="section">
			<h2>Yahoo! Top Music News</h2>

			<ol>
				<?php
				$news_pages=$_GET["newspages"];
				if(isset($_GET["newspages"])){
					for($i=1;$i<=$news_pages;$i++){ ?>
					<li><a href="http://music.yahoo.com/news/archive/?page=<?=$i?>">Page <?=$i?></a></li>
					<?php
				}
			}
				else {
					for($i=1;$i<=5;$i++){ ?>
					<li><a href="http://music.yahoo.com/news/archive/?page=<?=$i?>">Page <?=$i?></a></li>
					<?php
				}
			}
					?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>

			<ol>

				 <?php
                    $list = array();
				   $lines = file("favorite.txt");
				   foreach($lines as $li){
						 $list[]=$li;
					 }
					 ?>
					 <?php
					 for($i=0;$i<count($lines);$i++){?>
						 <li><a href="http://en.wikipedia.org/wiki/<?=$list[$i]?>"><?=$list[$i]?></a></li>
						<?php
					 }
					?>
			</ol>
		</div>

		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

		<!--
			<ul id="musiclist">
				<li class="mp3item">
					<a href="lab5/musicPHP/songs/paradise-city.mp3">paradise-city.mp3</a>
				</li>

				<li class="mp3item">
					<a href="lab5/musicPHP/songs/basket-case.mp3">basket-case.mp3</a>
				</li>

				<li class="mp3item">
					<a href="lab5/musicPHP/songs/all-the-small-things.mp3">all-the-small-things.mp3</a>
				</li>
			-->

			<ul id="musiclist">
				<?php
				$a = "lab5/musicPHP/songs/all-the-small-things.mp3";
				$mplist = array();
				$mppath = array();
				$mpsize = array();
				$mplist_1 = array();
				$mpsize_1 = array();
				$mp3_list = glob("lab5/musicPHP/songs/*.mp3");

					foreach($mp3_list as $mp3){
								$mppath[] = $mp3;
								$mplist[] = substr($mp3,20);
					}

					for($i=0;$i<count($mp3_list);$i++){
						$mpsize[$i] = floor(filesize($mppath[$i])/1024);
					}

			$mplist_1 = array("$mpsize[0]"=>$mplist[0],"$mpsize[1]"=>$mplist[1],"$mpsize[2]"=>$mplist[2],"$mpsize[3]"=>$mplist[3],"$mpsize[4]"=>$mplist[4],"$mpsize[5]"=>$mplist[5],"$mpsize[6]"=>$mplist[6]);


			krsort($mplist_1);

			foreach ($mplist_1 as $key => $val) {
//    	print "$key = $val\n";
			?>

			<li class="mp3item"><a href="lab5/musicPHP/songs/<?=$val?>"><?=$val?></a> (<?=$key?> KB)</li>

			<?php
			}
						?>


				<!-- Exercise 8: Playlists (Files) -->
				<?php
				$m3u_list = glob("lab5/musicPHP/songs/*.m3u");
				$m3list = array();
				foreach(array_reverse($m3u_list) as $m3u){
					?>
					<?php
							$m3list = substr($m3u,20);
							?>
							 <li class="playlistitem"><?= $m3list ?>:
							<ul><?php
							$lines = file($m3u);
							shuffle($lines);
							foreach($lines as $mp3u_1){
								if(strpos($mp3u_1,"#") === 0 ){?>
										<?php
								}
								else{
									?><li><?=$mp3u_1?></li><?php
								}
							}
							?></ul></li>
							<?php
				}
				?>

<!--
				<li class="playlistitem">326-13f-mix.m3u:
					<ul>
						<li>Basket Case.mp3</li>
						<li>All the Small Things.mp3</li>
						<li>Just the Way You Are.mp3</li>
						<li>Pradise City.mp3</li>
						<li>Dreams.mp3</li>
					</ul>
			</ul>
-->


		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
