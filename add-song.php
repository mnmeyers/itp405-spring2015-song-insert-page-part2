<?php
require_once __DIR__ . '/vendor/autoload.php';
use \Symfony\Component\HttpFoundation\Session\Session;
use \Itp\Music\ArtistQuery;
use \Itp\Music\GenreQuery;
use \Itp\Music\Song;

$session = new Session();
$session->start();

$artistQuery = new ArtistQuery();
$selectArtists = $artistQuery->getAll();
$genreQuery = new GenreQuery();
$selectGenres = $genreQuery->getAll();
if (isset($_POST['submit'])){
	$song = new Song();
	$song->setTitle($_POST['title']); 
	$song->setArtistId($_POST['artist']); 
	$song->setGenreId($_POST['genre']); 
	$song->setPrice($_POST['price']);
	$song->save();
  $session->getFlashBag()->add('contact-success', 'The song ' . $song->getTitle() . ' with an ID of ' . $song->getId() . ' was inserted successfully!');
  header('Location: add-song.php');
  exit;
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Song Insert</title>

    <!-- Bootstrap -->
    <link href="bootstrap-3.3.2-dist/css/bootstrap.css" rel="stylesheet">
<style>
    

.container {
    width:90%;
    margin: auto;
    height:auto;
}
.form-group{
display: table;
	width: 100%;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
	white-space:nowrap;
	margin-bottom: .45em;
}
label {
    margin-top: 0;
    margin-bottom: 0;
    padding-top: 7px;
    width: 33.33333%;
    float:left;
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    display: block;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    line-height: 1.42857;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    font-weight: 600;
    height:30px;
    
}
button {
	width:100%;
	
}
.btn-default {
	background-color:#52BBA0;
	color:white;
}
.textbox {
    width: 50%;
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    display: block;
    -webkit-font-smoothing: antialiased;
    line-height: 1.42857;
    float:left;
    margin-bottom:15px;
}
.form-control {
    font-weight: lighter;
    -webkit-box-shadow: none;
    box-shadow: none;
    height: 36px;
    padding-left: 12px;
    padding-right: 12px;
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px; 
    font-size: 16px;
    line-height: 1.42857;
    color: #555;
    vertical-align: middle;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    text-transform: none;
    -webkit-appearance: textfield;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

@media (min-width: 768px){
	.navbar-form .form-control {
	display: inline-block;
	width: 100%;
	vertical-align: middle;
	}
}
</style>
  </head>
  <body>
	<div class="navbar navbar-inverse navbar-static-top" role="navigation">
	    <div class="navbar-header"> 
	        <a class="navbar-brand" rel="home" href="add-song.php" title="ITP 405">
	        	Song Insert
	        </a>
	    </div>
	</div>
	
	<div class="container">
		<form class="navbar-form navbar-left" role="search" method="post" action="add-song.php">
      <?php foreach($session->getFlashBag()->get('contact-success') as $message) : ?>
        <?php echo $message ?>
      <?php endforeach ?>
  			<div class="form-group">
        
			    <label>
			    	Song Title: 
			    </label>
  				<input type="text" class="form-control" placeholder="Song Title" name="title" required>
  			</div><br>

  			<div class="form-group">
			    <label>
			    	Artist: 
			    </label>
				<select class="form-control" name="artist">
					<option></option>
	  				<?php
	     				foreach($selectArtists as $artist):
							$artist_id = $artist->id;
							$artist_name = $artist->artist_name;
	                ?>
	                <option value="<?php echo $artist_id?>"><?php echo $artist_name?></option>
	                <?php
	                    endforeach;   
	  				?>
				</select>
 			</div><br>

  			<div class="form-group">
    			<label>
    				Genre: 
    			</label>
  				<select class="form-control" name="genre">
  					<option></option>
  					<?php
     					foreach($selectGenres as $genre):
						$genre_id = $genre->id;
						$genre_name = $genre->genre;
                    ?>
                    <option value="<?php echo $genre_id?>"><?php echo $genre_name?></option>
                    <?php
                        endforeach;
  					?>
				</select>
  			</div><br>

			<div class="form-group">
			    <label>
			    	Price: 
			    </label>
  				<input type="text" class="form-control" placeholder="Price" name="price" required>
  			</div><br>

			<div class="form-group">
				<label>
				</label>
  			<button type="submit" name="submit" class="btn btn-default">Add Song</button>
  			</div>
		</form>

	</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   

  </body>
</html>