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
				foreach ($futureMatches["EU"] as $match) {
			?>
			<div class="row">
				<div class="container-fluid">
					<div class="popup eu">
					<?php 
						$date = new DateTime($match["date"], new DateTimeZone('Europe/Paris'));
						$teams = [];
						if (count($match["opponents"]) == 1) {
							$teams[] = [$match["opponents"][0]->opponent->acronym];
							$teams[] = ["TBD"];
						} else {
							foreach ($match["opponents"] as $team) {
								$teams[] = [$team->opponent->acronym];
							}
						}
						echo "<p>".$date->format('d-m H:i')." ".$teams[0][0]." vs ".$teams[1][0]."</p>";
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
				foreach ($futureMatches["NA"] as $match) {
			?>
			<div class="row">
				<div class="container-fluid">
					<div class="popup na">
					<?php 
						$date = new DateTime($match["date"], new DateTimeZone('Europe/Paris'));
						$teams = [];
						if (count($match["opponents"]) == 1) {
							$teams[] = [$match["opponents"][0]->opponent->acronym];
							$teams[] = ["TBD"];
						} else {
							foreach ($match["opponents"] as $team) {
								$teams[] = [$team->opponent->acronym];
							}
						}
						echo "<p>".$date->format('d-m H:i')." ".$teams[0][0]." vs ".$teams[1][0]."</p>";
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
				foreach ($futureMatches["LCK"] as $match) {
			?>
			<div class="row">
				<div class="container-fluid">
					<div class="popup lck">
					<?php 
						$date = new DateTime($match["date"], new DateTimeZone('Europe/Paris'));
						$teams = [];
						if (count($match["opponents"]) == 1) {
							$teams[] = [$match["opponents"][0]->opponent->acronym];
							$teams[] = ["TBD"];
						} else {
							foreach ($match["opponents"] as $team) {
								$teams[] = [$team->opponent->acronym];
							}
						}
						echo "<p>".$date->format('d-m H:i')." ".$teams[0][0]." vs ".$teams[1][0]."</p>";
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
				foreach ($futureMatches["LPL"] as $match) {
			?>
			<div class="row">
				<div class="container-fluid">
					<div class="popup lpl">
					<?php 
						$date = new DateTime($match["date"], new DateTimeZone('Europe/Paris'));
						$teams = [];
						if (count($match["opponents"]) == 1) {
							$teams[] = [$match["opponents"][0]->opponent->acronym];
							$teams[] = ["TBD"];
						} else {
							foreach ($match["opponents"] as $team) {
								$teams[] = [$team->opponent->acronym];
							}
						}
						echo "<p>".$date->format('d-m H:i')." ".$teams[0][0]." vs ".$teams[1][0]."</p>";
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