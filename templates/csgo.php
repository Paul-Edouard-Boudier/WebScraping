
<!-- En fait il faut faire une string géante et renvoyer via echo a la fin, pour load tout le bordel avec .load() -->
<?php 
	// require_once("functions/scraping.php");
	// $hltvNews = $GLOBALS['hltvNews'];
	// $csgoRedditPost = $GLOBALS['csgoRedditPost'];
	// var_dump($hltvNews);
	// echo '<br>';
	// var_dump($GLOBALS['hltvNews']);die;
	$fullString = '<div class="container-fluid csgo-related">
									<div class="row">
										<div class="col-md-2 relative-container"><div class="logo_hltv"></div></div>
										<div class="col-md-8 all_news_hltv">';
	foreach ($hltvNews as $news) {
		$hltvString = '<a class="link_hltv row" href="https://www.hltv.org'.$news[0].'" target="blank">';
		$hltvString .= '<div class="hltv country_hltv col-md-1">'.$news[1].'</div>';
		$hltvString .= '<div class="hltv title_hltv col-md-9">'.$news[2].'</div>';
		$hltvString .= '<div class="hltv sub_info_hltv col-md-2">';
		$hltvString .= '<div class="time_hltv row">'.$news[3].'</div>';
		$hltvString .= '<div class="comments_hltv row">'.$news[4].'</div>';
		$hltvString .= '</div></a>';
		$fullString .= $hltvString;
	}
	// end of div 'all_news_hltv'and row above
	$fullString .= '</div></div>';

	// reddit string
	$fullString .= '<div class="row">
												<div class="col-lg-2 relative-container">
													<div class="logo_reddit_csgo"></div>
												</div>
											 	<div class="col-lg-8 no-padding-margin reddit_csgo">
													<div class="box-reddit">';

	foreach ($csgoRedditPost as $post) {
		$redditCsgoString = '<div class="post_csgo">';
		$redditCsgoString .= '<a class="container-fluid link_csgo_reddit" href="'.$post->permalink.'" target="blank">';
		$redditCsgoString .= '<div class="row">';

		$redditCsgoString .= '<div class="col-1">
														<div class="reddit_upvotes">'.$post->upvotes.'</div>
													</div>';

		$redditCsgoString .= '<div class="col-11">';
		$redditCsgoString .= '<div class="reddit_author">Posted By '.$post->author.'</div>';
		$redditCsgoString .= '<div class="reddit_authorText">'.$post->authorText.'</div>';
		$redditCsgoString .= '<div class="reddit_title">'.$post->title.'</div>';
		$redditCsgoString .= '<div class="media reddit_media">';
		if ($post->media) {
			if ($post->media["type"] == "gfycat.com") {
				$mediaString = '<div class="gif">';
				$mediaString .= html_entity_decode($post->media["content"]);
				$mediaString .= '</div>';
			} else {
				$mediaString = html_entity_decode($post->media["content"]);
			}
		} else {
			$mediaString = '<img src="'.$post->linkOfPost.'" alt="">';
		}
		// end of media div
		$redditCsgoString .= $mediaString.'</div>';
		$redditCsgoString .= '<div class="reddit_comments">'.$post->comments.' comments</div>';

		// end of col-11 div
		$redditCsgoString .= '</div>';


		// end of div row then a link then div post_csgo
		$redditCsgoString .= '</div></a></div>';
		$fullString .= $redditCsgoString;
	}

	// end of 2 first div of $redditCsgoString: box_reddit then container then row then the very first one
	$fullString .= '</div></div></div></div>';
	echo $fullString;
?>