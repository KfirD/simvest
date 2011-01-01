<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Coal App &mdash; buy and sell fake coal stocks!</title>
		
		<link rel="stylesheet" type="text/css" href="base.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>
		<script src="home.js" type="text/javascript"></script>
	</head>
	<body class="setup">
		<div id="box">
			<p class="big">Welcome to Coal App</p>
			<div class="buttons">
				<div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-text="play coal app -- an addicting game where you buy and sell stocks" data-count="horizontal" data-via="kfirdolev" data-related="netspencer:naplognews">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>
				<div class="fb"><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FCoal-App%2F151185061576632&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></div>
				<div class="clear"></div>
			</div>
			<p class="description">Simulating buying and selling fake coal stocks.</p>
			<p class="awkward">Login with <a rel="facebook" class="switch" href="#">Facebook</a> or <a rel="name" class="switch" href="#">enter your name</a> to start playing</p>
			<div class="switch-login facebook">
			<a class="fb-login" href="<?php echo $loginUrl ?>"></a>
			</div>
			<div style="display:none;" class="switch-login name">
			<form method="post" >
				<div id="name"><input id="your_name" type="text" name="name" /></div>
			</form>
			</div>
		</div>
		
		 <div id="brought_by">
		<p>Brought to you by: <a class="by_link" href="http://twitter.com/mralpaca">Max Grusky</a>, <a class="by_link"
		href="http://twitter.com/kfirdolev">Kfir Dolev</a>, <a class="by_link" href="http://twitter.com/netspencer">Spencer Schoeben</a></p>
		</div>
		
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-20493848-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>

	</body>
	

</html>
