<?php 

		// reddit string
		$fullString = '<div class="container-fluid lol-related">';
		$fullString .= '<div class="row">
													<div class="col-lg-2 relative-container">
														<div class="logo_reddit_lol"></div>
													</div>
												 	<div class="col-lg-8 no-padding-margin reddit_lol">
														<div class="box-reddit">';
	foreach ($lolRedditPost as $post) {
		$redditLolString = '<div class="post_lol">';
		$redditLolString .= '<a class="container-fluid link_lol_reddit" href="'.$post->permalink.'" target="blank">';
		$redditLolString .= '<div class="row">';

		$redditLolString .= '<div class="col-1">
														<div class="reddit_upvotes">'.$post->upvotes.'</div>
													</div>';

		$redditLolString .= '<div class="col-11">';
		$redditLolString .= '<div class="reddit_author">Posted By '.$post->author.'</div>';
		$redditLolString .= '<div class="reddit_authorText">'.$post->authorText.'</div>';
		$redditLolString .= '<div class="reddit_title">'.$post->title.'</div>';
		$redditLolString .= '<div class="media reddit_media">';
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
		$redditLolString .= $mediaString.'</div>';
		$redditLolString .= '<div class="reddit_comments">'.$post->comments.' comments</div>';

		// end of col-11 div
		$redditLolString .= '</div>';


		// end of div row then a link then div post_lol
		$redditLolString .= '</div></a></div>';
		$fullString .= $redditLolString;
	}
		// end of box-reddit col-lg-8 row then container-fluid, the very first div.
		$fullString .= '</div></div></div></div>';

	echo $fullString;
?>