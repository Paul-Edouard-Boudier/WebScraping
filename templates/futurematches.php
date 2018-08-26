<div class="container">
	<div class="row" data-leagues="leagues">
		<div class="col-3 league" data-league="eu">
			<p>EU LCS</p>
			</div>
		<div class="col-3 league" data-league="na"><p>NA LCS</p></div>
		<div class="col-3 league" data-league="lck"><p>LCK</p></div>
		<div class="col-3 league" data-league="lpl"><p>LPL</p></div>
	</div>
		<div class="container">
			<?php 
			if (array_key_exists("EU", $futureMatches)) {
				$checkIfDateIsTheSame = "";
				foreach ($futureMatches["EU"] as $match) {
					$date = dateFr($match["date"]);
					if ($date !== $checkIfDateIsTheSame) {
						$div = "<h4 class='eu'>".$date."</h4>";
						echo $div;
						$checkIfDateIsTheSame = $date;
					}
			?>
			<div class="row">
				<div class="container-fluid">
					<div class="popup eu">
					<?php 
						// var_dump($date);
						$hour = timeOfDateFr($match["date"]);
						// $date = new DateTime($match["date"], new DateTimeZone('Europe/Paris'));
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
						// if($div){echo($div);};
						echo "<p>".$hour." ".$teams[0][0]." vs ".$teams[1][0]."</p>";
						echo "<span class='popuptext'>";
						echo $match["league_name"]." ".$match["season"]." ";
						echo $match["name"];
						echo "<br>";
						echo $match["match_type"]." ";
						echo $match["number_of_games"];
						// echo $date->format('d-m H:i');
						echo "</span>";
					?>
					</div>
				</div>
			</div>
			<?php 
				}
			}
			?>
			<?php 
			if (array_key_exists("NA", $futureMatches)) {
				$checkIfDateIsTheSame = "";
				foreach ($futureMatches["NA"] as $match) {
					$date = dateFr($match["date"]);
					if ($date !== $checkIfDateIsTheSame) {
						$div = "<h4 class='na'>".$date."</h4>";
						echo $div;
						$checkIfDateIsTheSame = $date;
					}
			?>
			<div class="row">
				<div class="container-fluid">
					<div class="popup na">
					<?php 
						// var_dump($date);
						$hour = timeOfDateFr($match["date"]);
						// $date = new DateTime($match["date"], new DateTimeZone('Europe/Paris'));
						$teams = [];
						if (count($match["opponents"]) == 1) {
							$teams[] = [$match["opponents"][0]->opponent->acronym];
							$teams[] = ["TBD"];
						} elseif(count($match["opponents"]) < 1) {
							$teams[] = ["TBD"];
							$teams[] = ["TBD"]; 
						}	else {
							foreach ($match["opponents"] as $team) {
								$teams[] = [$team->opponent->acronym];
							}
						}
						// if($div){echo($div);};
						echo "<p>".$hour." ".$teams[0][0]." vs ".$teams[1][0]."</p>";
						echo "<span class='popuptext'>";
						echo $match["league_name"]." ".$match["season"]." ";
						echo $match["name"];
						echo "<br>";
						echo $match["match_type"]." ";
						echo $match["number_of_games"];
						// echo $date->format('d-m H:i');
						echo "</span>";
					?>
					</div>
				</div>
			</div>
			<?php 
				}
			}
			?>
			<?php 
			if (array_key_exists("LCK", $futureMatches)) {
				$checkIfDateIsTheSame = "";
				foreach ($futureMatches["LCK"] as $match) {
					$date = dateFr($match["date"]);
					if ($date !== $checkIfDateIsTheSame) {
						$div = "<h4 class='lck'>".$date."</h4>";
						echo $div;
						$checkIfDateIsTheSame = $date;
					}
			?>
			<div class="row">
				<div class="container-fluid">
					<div class="popup lck">
					<?php 
						// var_dump($date);
						$hour = timeOfDateFr($match["date"]);
						// $date = new DateTime($match["date"], new DateTimeZone('Europe/Paris'));
						$teams = [];
						if (count($match["opponents"]) == 1) {
							$teams[] = [$match["opponents"][0]->opponent->acronym];
							$teams[] = ["TBD"];
						} else {
							foreach ($match["opponents"] as $team) {
								$teams[] = [$team->opponent->acronym];
							}
						}
						// if($div){echo($div);};
						echo "<p>".$hour." ".$teams[0][0]." vs ".$teams[1][0]."</p>";
						echo "<span class='popuptext'>";
						echo $match["league_name"]." ".$match["season"]." ";
						echo $match["name"];
						echo "<br>";
						echo $match["match_type"]." ";
						echo $match["number_of_games"];
						// echo $date->format('d-m H:i');
						echo "</span>";
					?>
					</div>
				</div>
			</div>
			<?php 
				}
			}
			?>
			<?php 
			if (array_key_exists("LPL", $futureMatches)) {
				$checkIfDateIsTheSame = "";
				foreach ($futureMatches["LPL"] as $match) {
					$date = dateFr($match["date"]);
					if ($date !== $checkIfDateIsTheSame) {
						$div = "<h4 class='lpl'>".$date."</h4>";
						echo $div;
						$checkIfDateIsTheSame = $date;
					}
			?>
			<div class="row">
				<div class="container-fluid">
					<div class="popup lpl">
					<?php 
						// var_dump($date);
						$hour = timeOfDateFr($match["date"]);
						// $date = new DateTime($match["date"], new DateTimeZone('Europe/Paris'));
						$teams = [];
						if (count($match["opponents"]) == 1) {
							$teams[] = [$match["opponents"][0]->opponent->acronym];
							$teams[] = ["TBD"];
						} else {
							foreach ($match["opponents"] as $team) {
								$teams[] = [$team->opponent->acronym];
							}
						}
						// if($div){echo($div);};
						echo "<p>".$hour." ".$teams[0][0]." vs ".$teams[1][0]."</p>";
						echo "<span class='popuptext'>";
						echo $match["league_name"]." ".$match["season"]." ";
						echo $match["name"];
						echo "<br>";
						echo $match["match_type"]." ";
						echo $match["number_of_games"];
						// echo $date->format('d-m H:i');
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