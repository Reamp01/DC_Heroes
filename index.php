<?php
    include 'Elementen/DC_Heroes_Database_Connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- This will link the stylesheet for this document -->
    <link rel="stylesheet" type="text/css" href="CSS/DC_Heroes_CSS.css" />
    <!-- This is the title of the tab -->
    <title>DC Heroes</title>
    <!-- This will show a favicon -->
    <link rel="shortcut icon" type="image/png" href="Afbeeldingen/DC_Heroes_Logo_Black.png"/>
</head>

<body>
    <!-- This is the header that will be shown on top of the body -->
    <header id='Homepage_Header'>
        <a href="index.php"> <h1 id="DC_Heroes_Logo_H1">Super-Heroes</h1> <img src="Afbeeldingen/DC_Heroes_Logo.png" id="DC_Heroes_Logo_Img" /> </a>
    </header>

        <!-- This is the div where you can choose a team -->
        <div id="Choose_Team">
            <h2 >Teams:</h2>
            <nav>
                <!-- This will show all the different team's and universe's (with images)-->
                <ul id="List_Team">
                    <?php 
                        foreach($chooseTeamArray as $key => $chooseTeam) { ?>
                            <h5><?php echo $chooseTeam['COUNT(heroId)']; ?> Members  </h5>  
                            <a href="index.php?teamNumber=<?php echo $chooseTeam['teamId']; ?>"> 
                                <img src="Afbeeldingen/Teams/<?php echo $chooseTeam['teamImage']; ?>"/> <li><?php echo $chooseTeam['teamName']; ?></li> <br/> <br/>  
                            </a>
                    <?php } ?>
                </ul>
            </nav>
            <!-- This will show the logo of the team that is selected -->
            <img id="Selected_Team_Img" src="Afbeeldingen/Teams/emp.jpg" />
        </div>

        <!-- This is the div where you choose a specific hero to show more information about that hero -->
        <div id="Choose_Hero">
            <?php
                // When a teamNumber is given in the URL then this div will loop trough the different heroes from that given team
                if(isset($_GET['teamNumber'])) {
                    $loopCounterChooseHero = 0;

                    foreach($chooseHeroArray as $key => $chooseHero) {
                        // This varialbe will count the number of loops
                        $loopCounterChooseHero++;

                        // If the variable above is equal to an even number the div will have a different background then normal
                        if ($loopCounterChooseHero % 2 == 0) {
                            echo '<div class="Heroes_Div" style=" background-color: #3e3e3e;">';
                        } 
                        // If that same variable has an odd number the background will be normal
                        else { 
                            echo '<div class="Heroes_Div" style=" background-color: #2e2e2e;">';
                        } ?>
                        <img class="Choose_Hero_Image" src="Afbeeldingen/Heroes/<?php echo $chooseHero['heroImage']; ?>" />
                        <h2  class="Choose_Hero_Name"><?php echo $chooseHero['heroName']; ?></h2>
                            <div class="Choose_Hero_StarDiv">
                                <?php 
                                    $starNumber = $chooseHero['AVG(rating)']; 
                                    for($i = 1; $i <= 5; $i++) {
                                        if($starNumber >= 1) {
                                                echo "<img class='Review_Stars' src='Afbeeldingen/Rating_Stars/FullStar.png' />";
                                                $starNumber--;
                                            }
                                            elseif ($starNumber >= 0.5) {
                                                echo "<img class='Review_Stars' src='Afbeeldingen/Rating_Stars/HalfStar.png' />";
                                                $starNumber -= 0.5;
                                            }
                                            else {
                                                echo "<img class='Review_Stars' src='Afbeeldingen/Rating_Stars/EmptyStar.png' />";
                                            }
                                    }   ?>
                            </div>
                        <p   class="Choose_Hero_Description"><?php echo $chooseHero['heroDescription']; ?></p> <br/>
                        <a   class="Choose_Hero_AHref" href="index.php?teamNumber=<?php echo $teamNumber;?>&heroNumber=<?php echo $chooseHero['heroId'];?>">
                            <h5 class="Choose_Hero_ReadMore">Read More...</h5>
                        </a>
                    </div>
                <?php } }
                // When there isn't a teamNumber provided in the URL then the text: Choose a team will appear in this div
                else {
                    echo "<h2 style='color: #ffffff; text-align: center;'>Choose a team or universe.</h2>";
                } ?>
    </div>

    <!-- This is the div where the information about a specific hero is shown -->
    <div id="Information_Hero">
        <?php
            if(isset($_GET['heroNumber'])) { ?>         
                <div class="Info_Hero_Image_Container">
                    <img class="Info_Hero_Img" src="Afbeeldingen/Heroes/<?php echo $infoHeroArray['heroImage'];      ?>" />
                    <h2 class="Info_Hero_H2"><?php echo $infoHeroArray['heroName']; ?></h2>
                    <div class="Review_Star_Div"><?php include 'Elementen/DC_Heroes_StarCount_ForHero.php'; ?></div> 
                </div> <hr/> 

                <h3 class="Info_Hero_H3">Description:</h3>
                <p class="Info_Hero_Description"><?php echo $infoHeroArray['heroDescription'] ?></p>
                <h3 class="Info_Hero_H3">Power(s):</h3>             
                <ul class="Info_Hero_Powers">
                    <?php echo $infoHeroArray['heroPower']; ?>
                </ul>
                <h3 class="Info_Hero_H3">Review This Hero:</h3> 

                <form class="Info_Hero_Form" action="index.php?teamNumber=<?php echo $teamNumber; ?>&heroNumber=<?php echo $heroNumber; ?>" method="POST">
                    <input type="text" name="reviewName" placeholder="Your name (isn't necessary)" class="Info_Hero_Form_Name"> <br/> <br/>
                    <input type="text" placeholder="Write here a comment about this hero." name="reviewComment" class="Info_Hero_Form_Text" required> <br/>
                    1<input type="radio" name="reviewStarNumber" value="1" required>
                    2<input type="radio" name="reviewStarNumber" value="2" required>
                    3<input type="radio" name="reviewStarNumber" value="3" checked required>
                    4<input type="radio" name="reviewStarNumber" value="4" required>
                    5<input type="radio" name="reviewStarNumber" value="5" required> <br/>
                    <input type="hidden" name="reviewDate" value="<?php echo date('Ymd'); ?>"> <br/>
                    <input type="submit">
                    <input type="reset">
                </form>

                <h3 class='Info_Hero_H3'>Review(s):</h3>
                <?php 
                foreach($infoHeroReviewsArray as $key => $infoHeroReviews) { ?>
                    <div class="Review_Div_Item">
                        <h3 class="Review_Username"><?php echo $infoHeroReviews['ratingUsername']; ?></h3>
                        <p class="Review_Review"><?php echo $infoHeroReviews['ratingReview']; ?></p>
                        <div class="Review_Star_Div">
                            <?php
                                $numberOfStars = $infoHeroReviews['rating'];
                                
                                for($i = 1; $i <= 5; $i++) {
                                    if($numberOfStars >= 1) {
                                        echo "<img class='Review_Stars' src='Afbeeldingen/Rating_Stars/FullStar.png' />";
                                        $numberOfStars--;
                                    }
                                    elseif ($numberOfStars >= 0.5) {
                                        echo "<img class='Review_Stars' src='Afbeeldingen/Rating_Stars/HalfStar.png' />";
                                        $numberOfStars -= 0.5;
                                    }
                                    else {
                                        echo "<img class='Review_Stars' src='Afbeeldingen/Rating_Stars/EmptyStar.png' />";
                                    }
                                } 
                            ?>
                        </div>
                        <p class="Reveiw_Date"><?php echo $infoHeroReviews['ratingDate']; ?></p>
                    </div>
                <?php } }
            else {
                echo "<h3 style='text-align: center; color: #ffffff;'>Choose a character from a team or universe.</h3>";
            }
        ?>
    </div>

    <script>
        // This will link to a php file which will change the layout of the website 
        <?php 
            include 'Elementen/DC_Heroes_Javascript_ChangeTeamLayout.php';
        ?>
    </script>

</body>
</html>