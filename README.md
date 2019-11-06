# SaarTURNier Livescore
Score management for the SaarTURNier competition by TV St. Ingbert

## Setup Database
open your database and run the statement in [`create_database.sql`](https://github.com/MichaelBarz/saarTURNier-livescore/blob/master/ScoreSystem/db_utils/create_database.sql)

## Get Started for Competition
* generate `participants.csv` and `teams.csv` using [saarTURNier-utils](https://github.com/MichaelBarz/saarTURNier-utils)
* run the xampp control center and start *apache* server and *mysql* server
* [**attention**: do this only, if you want to remove previous results. You can also keep them] open *phpmyadmin* (mysql admin button) and truncate the following tables: `teams`, `participants`, `participant_apparatus`
* extend `controlBoard.php` (point administration) for supporting the current year: `<p><a class="btn btn-primary btn-lg" href="participantsAdministration.php?year={YEAR}" role="button">Ergebnisse {YEAR}</a></p>`
* extend `index.php` (result visualization) for supporting the current year: add links to `resultsView` and `teamResultsView` with the current year as parameter
* open [scoresystem](http://localhost/scoresystem/) and click `Dateien einlesen` --> loads the participants and teams into the database
* open [scoresystem](http://localhost/scoresystem/) and click `Verwaltungsoberfläche` --> opens point administration

## Upload Results to Website (Offline to Online)
This is currently a manual process
* Perform `SELECT` statements on `localhost`, export data and import them in the online system. Use the following statements for export:
  * `teams`: `` SELECT `id`+X as `id`, `name`, `year` FROM `teams` WHERE 1 ``
  * `participants`: `` SELECT `id`+Y as `id`, `name`, `gender`, `team`+X as `team` FROM `participants` WHERE 1 ``
  * `participant_apparatus`: `` SELECT `pID`+Y as `pID`, `aID`, `d_value`, `e_value`, `score` FROM `participant_apparatus` WHERE 1 ``
* Export data for each statement with X being the maximum team id and Y the maximum participant id from the online system
  * Export as SQL INSERT statements
  * Import them in the online system (tvigb.de/phpmyadmin)
