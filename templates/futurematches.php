<div class="container">
	<div class="row" data-leagues="leagues">
		<div class="col-3 league active" data-league="eu">
			<p>EU LCS</p>
			</div>
		<div class="col-3 league" data-league="na"><p>NA LCS</p></div>
		<div class="col-3 league" data-league="lck"><p>LCK</p></div>
		<div class="col-3 league" data-league="lpl"><p>LPL</p></div>
	</div>
	<div class="container">
		<?php 
			foreach ($futureMatchesForEveryLeague as $key => $futureMatchesByLeague) {
				$checkIfDateIsTheSame = "";
				foreach ($futureMatchesByLeague as $match) {
					// var_dump($match);
					$date = dateFr($match["date"]);
					if ($date !== $checkIfDateIsTheSame) {
						$div = "<div class='date ".strtolower($key)."'><h4 style='margin-bottom: 0px;'>".$date."</h4></div>";
						echo $div;
						$checkIfDateIsTheSame = $date;
					}
		?>
				<div class="row">
				<div class="container-fluid">
					<div class="popup <?= strtolower($key)?>" >
					<?php 
						$hour = timeOfDateFr($match["date"]);
						$teams = [];
						if (count($match["opponents"]) == 1) {
							$teams[] = [$match["opponents"][0]->opponent->acronym];
							$teams[] = ["TBD"];
						} elseif (count($match["opponents"]) < 1) {
							$teams[] = ["TBD"];
							$teams[] = ["TBD"];
						} else {
							foreach ($match["opponents"] as $team) {
								$teams[] = [$team->opponent->acronym];
							}
						}

						// echo "<p>".$hour." ".$teams[0][0]." vs ".$teams[1][0]."</p>";
						echo "<div class='match'>";
						echo "<div class='time'><p>".$hour."</p></div>";
						// echo "<div class='clash'>";
						// echo "<div class='blue-team'>";
						echo "<div class='blue-team'><p>".$teams[0][0]."</p></div>";
						if (isset($match["opponents"][0])) {
							echo "<div class='team-logo'><img src=".$match["opponents"][0]->opponent->image_url."></div>";
						} else {
							echo "<div class='team-logo'></div>";
						}
						// END of BLUE-TEAM
						// echo "</div>";
						// echo "<div class='blue-team-logo'><img src=".$match["opponents"][0]->opponent->image_url."></div>";
						echo "<div class='vs'><p> VS </p></div>";
						// echo "<div class='red-team'>";
						if (isset($match["opponents"][1])) {
							echo "<div class='team-logo'><img src=".$match["opponents"][1]->opponent->image_url."></div>";
						} else {
							echo "<div class='team-logo'></div>";
						}
						// echo "<div class='blue-team-logo'><img src=".$match["opponents"][1]->opponent->image_url."></div>";
						echo "<div class='red-team'><p>".$teams[1][0]."</p></div>";
						// END of RED-TEAM
						// echo "</div>";
						// END of CLASH DIV
						// echo "</div>";
						// END of MATCH DIV
						echo "</div>";
						echo "<span class='popuptext'>";
						echo $match["league_name"]." ".$match["season"]." ";
						echo $match["name"];
						echo "<br>";
						echo $match["match_type"]." ";
						echo $match["number_of_games"];
						echo "</span>";

					?>
					</div>
				</div>
			</div>
		<?php 
				}
			} 
		?>
	</div>
</div>