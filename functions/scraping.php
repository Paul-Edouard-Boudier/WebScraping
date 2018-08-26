<?php 

 	function curl($url) {
    $ch = curl_init();  // Initialising cURL
    curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Setting cURL's option to return the webpage data
    $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
    curl_close($ch);    // Closing cURL
    return $data;   // Returning the data from the function
  }

  class RedditPost {
  	public $title;
  	public $content;
  	// link for the reddit post
  	public $permalink;
  	// easy link to images but useless if the post has video 
  	public $linkOfPost;
  	public $author;
  	public $authorText;
  	public $comments;
  	// might be an array if possible that holds images or video
  	// Think it's useless for now
  	// public $preview;
  	// Hold media for gif or video
  	public $media;

  }

  // SUMMARY:
  // - HLTV
  // - REDDIT CSGO
  // - LOL NEWS RELATED (REDDIT, LOLESPORT, UPCOMING MATCHES)
  // - HACKERNEWS
  // - REDDIT PROGRAMMING
  // - JVC (?)
  // - IMDb (?)
  // - TWITCH
  // - LAST TWEET (?)
  
  
	// -------------------------------------
	// -------------------------------------

  // /!\ HLTV SITE /!\ //

  $hltv = curl("https://www.hltv.org/");


  // This one is to capture the group of news, today's news, yesterday's news and other news
  $regexHltv = '/<div class="standard-box standard-list">(<a href=".*?".*?>.*?<div class="newstext">.*?<\/div>.*?<div class="newsrecent">.*?<\/div>.*?<\/a>)<\/div>/s';
  preg_match_all($regexHltv, $hltv, $matches, PREG_PATTERN_ORDER);
  // I want to replace all break of line and then more than double white space so i can work with it
	$buffer = str_replace(array("\r", "\n"), '', $matches[0][0]);
	$strippedString = preg_replace('/\s\s+/', '', $buffer);

  // Then on the scraped part, i regex so that I can work with chunk that represent each news of today
  preg_match_all('/<a href=\"(.*?)\".*?>(.*?)<div class=\"newstext\">(.*?)<\/div>.*?<div class=\"newsrecent\">(.*?)<\/div><div>([0-9]*\scomments?)<\/div><\/div><\/a>/', $strippedString, $hltvScrapped);

  $hltvNews = [];

  // This chunk is to have an array of news instead of an array of array of links then images then title etc...
  for ($i=1; $i < count($hltvScrapped) ; $i++) { 
  	$x = 0;
  	foreach ($hltvScrapped[$i] as $data) {
  		$hltvNews[$x][$i - 1] = $data;
  		$x += 1;
  	}
  }
  $GLOBALS['hltvNews'] = $hltvNews;
 //  var_dump($hltvNews);
 //  echo '<br>';
	// var_dump($GLOBALS['hltvNews']);die;



  // TODO: upcoming matches that are >= 2 stars
  // 			Ranking first 5 teams

	// /!\ END HLTV SITE /!\ //
	
	// ---------------------
	
	// /!\ REDDIT CSGO SITE /!\ //

	$redditCsgo = curl("https://www.reddit.com/r/GlobalOffensive/.json");

	$jsonRedditCsgo = json_decode($redditCsgo);
	$arrayCsgoPost = $jsonRedditCsgo->data->children;
	$arrayCsgoPostSliced = array_slice($arrayCsgoPost, 0, 6);

	// array of final posts, the one i chose to keep, so the first 6.
	$csgoRedditPost = [];

	foreach ($arrayCsgoPostSliced as $rawPost) {
		$post = new RedditPost();

		$post->title = $rawPost->data->title;
		$post->content = $rawPost->data->selftext;
		$post->permalink = "https://www.reddit.com/".$rawPost->data->permalink;
		$post->linkOfPost = $rawPost->data->url;
		$post->author = $rawPost->data->author;
		$post->authorText = $rawPost->data->author_flair_text;
		$post->comments = $rawPost->data->num_comments;
		$post->upvotes = $rawPost->data->ups;
		if (!empty((array)$rawPost->data->media_embed)) {
			// regex so that the media isn't wider than 450px;
			$widthRegulationRegex = "/width=\\\"([0-9]{1,5})\\\"/";
			$mediaRegulated = preg_replace($widthRegulationRegex, 'width="535"', $rawPost->data->media_embed->content);
			$post->media = ["content" => $mediaRegulated,
				"type" => $rawPost->data->media->type];
		}
		// $post->preview = ["images" => $rawPost->data->preview->images];
		// if (array_key_exists("reddit_video_preview", $rawPost->data->preview)) {
		// 	// var_dump($rawPost->data->preview);die;
		// 	$post->preview = ["images" => $rawPost->data->preview->images, "video" => $rawPost->data->preview->reddit_video_preview];
		// }
		// 
		// Not usefull since we use html_entity_decode wich pretty much do that
		// $array_search = ["&lt;", "&gt;"];
		// $array_replace = ["<", ">"];
		// $post->media = str_replace($array_search, $array_replace, $post->media);


		
		$csgoRedditPost[] = $post;
	}

	$GLOBALS['csgoRedditPost'] = $csgoRedditPost;


	// /!\ END REDDIT CSGO SITE /!\ //
	
	
	// -------------------------------------
	// -------------------------------------


	// /!\ LOL NEWS RELATED /!\
	

	$lolMatches = json_decode(curl("https://api.pandascore.co//lol/matches/upcoming?token=gGJTiqJPMZseaqMQ1YoeuHYVs0Pdhw-ZWucaaQcjvQgugIcKEok"));
	$futureMatches = [];

	// league name:  "NA LCS"  "LPL China" "EU LCS" "LCK - Champions Korea"
	// $name = "semi final blabla"
	// $number_of_games = "5"
	// $match_type = "best of"
	// $opponents->opponent->name ou acronym = "CLA" / "CLG Academy"
	// $opponents->opponent->image_url
	// $league->name = "NA Academy"
	// $serie->slug = "league-of-legends-na-academy-summer-2018"
	// $serie->full_name = "Summer 2018"

	$x = 0;
	$futurMatches = [];
	foreach ($lolMatches as $match) {
		if ($match->league->name == "EU LCS") {
			$futureMatches["EU"][$x]["league_name"] = $match->league->name;
			$futureMatches["EU"][$x]["season"] = $match->serie->full_name;
			$futureMatches["EU"][$x]["name"] = $match->name;
			$futureMatches["EU"][$x]["date"] = $match->begin_at;
			$futureMatches["EU"][$x]["opponents"] = $match->opponents;
			$futureMatches["EU"][$x]["match_type"] = $match->match_type;
			$futureMatches["EU"][$x]["number_of_games"] = $match->number_of_games;
			$x += 1;
		} else if ($match->league->name == "NA LCS") {
			$futureMatches["NA"][$x]["league_name"] = $match->league->name;
			$futureMatches["NA"][$x]["season"] = $match->serie->full_name;
			$futureMatches["NA"][$x]["name"] = $match->name;
			$futureMatches["NA"][$x]["date"] = $match->begin_at;
			$futureMatches["NA"][$x]["opponents"] = $match->opponents;
			$futureMatches["NA"][$x]["match_type"] = $match->match_type;
			$futureMatches["NA"][$x]["number_of_games"] = $match->number_of_games;
			$x += 1;
		} else if ($match->league->name == "LCK - Champions Korea") {
			$futureMatches["LCK"][$x]["league_name"] = $match->league->name;
			$futureMatches["LCK"][$x]["season"] = $match->serie->full_name;
			$futureMatches["LCK"][$x]["name"] = $match->name;
			$futureMatches["LCK"][$x]["date"] = $match->begin_at;
			$futureMatches["LCK"][$x]["opponents"] = $match->opponents;
			$futureMatches["LCK"][$x]["match_type"] = $match->match_type;
			$futureMatches["LCK"][$x]["number_of_games"] = $match->number_of_games;
			$x += 1;
		} else if ($match->league->name == "LPL China") {
			$futureMatches["LPL"][$x]["league_name"] = $match->league->name;
			$futureMatches["LPL"][$x]["season"] = $match->serie->full_name;
			$futureMatches["LPL"][$x]["name"] = $match->name;
			$futureMatches["LPL"][$x]["date"] = $match->begin_at;
			$futureMatches["LPL"][$x]["opponents"] = $match->opponents;
			$futureMatches["LPL"][$x]["match_type"] = $match->match_type;
			$futureMatches["LPL"][$x]["number_of_games"] = $match->number_of_games;
			$x += 1;
		}
	}
	
	// /!\ END LOL NEWS RELATED /!\ // 








	if (isset($_POST["csgo"]) && !empty($_POST["csgo"])) {
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
	}
	if (isset($_POST["lol"]) && !empty($_POST["lol"])) {
		echo 'test AJAX SAMER';
	}
