<div class="container-fluid csgo-related">
	<div class="row">
		<div class="col-md-2 relative-container">
			<div class="logo_hltv"></div>
			TEST TEST
			Fin du test
		</div>
		<div class="col-md-8 all_news_hltv">
			<?php
				foreach ($hltvNews as $news) {
			?> 
			<a class="link_hltv row" href="https://www.hltv.org<?= $news[0] ?>" target="blank">
				<div class="hltv country_hltv col-md-1"><?= $news[1] ?></div>
				<div class="hltv title_hltv col-md-9"><?= $news[2] ?></div>
				<div class="hltv sub_info_hltv col-md-2">
					<div class="time_hltv row"><?= $news[3] ?></div>
					<div class="comments_hltv row"><?= $news[4]?></div>
				</div>
			</a>
			<?php
				 } 
			?>
		</div>
	</div>
	<!-- <div class="row">
		<div class="col-lg-2 relative-container">
			<div class="logo_reddit_csgo"></div>
		</div>
		<div class="col-lg-8 no-padding-margin reddit_csgo">
			<div class="box-reddit">
				<?php foreach ($csgoRedditPost as $post) { ?>
					<div class="post_csgo">
						<a class="container-fluid link_csgo_reddit" href="<?= $post->permalink ?>" target="blank">
							<div class="row">
								<div class="col-1">
									<div class="reddit_upvotes"><?= $post->upvotes ?></div>
								</div>
								<div class="col-11">
									<div class="reddit_author">Posted by <?= $post->author ?></div>
									<div class="reddit_authorText"><?= $post->authorText ?></div>
									<div class="reddit_title"><?= $post->title ?></div>
									<div class="media reddit_media">
									<?php 
										if ($post->media) {
											if ($post->media["type"] == "gfycat.com") {
												echo "<div class='gif'>";
												echo html_entity_decode($post->media["content"]);
												echo "</div>";
											} else {
												echo html_entity_decode($post->media["content"]);	
											}
										} else {
											echo '<img src="'.$post->linkOfPost.'" alt="">';
										}
									?>
									</div>
									<div class="reddit_comments"><?= $post->comments ?> comments</div>										
								</div>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div> -->
</div>