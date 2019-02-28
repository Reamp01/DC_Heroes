<?php
// This are the variables that are used in the star-rating system and foreach loops
$numberOfStars = 0;
$totalNumberOfStars = 0;
$loopCounterReview = 0;

// This will loop trough all the reviews of a specific hero
foreach($infoHeroReviewsArray as $key => $infoHeroReviews)
{
    // Starrate is filled with the number of stars given by the comment. (fetched from database)
    $numberOfStars = $infoHeroReviews['rating'];
 
    // Starcount will be the value of starcount + starRate.
    $totalNumberOfStars = $totalNumberOfStars + $numberOfStars;

    // This variable will count the number of loops we have entered.
    $loopCounterReview++;

    // This will loop trough the stars and shows empty, full and/or half stars.
    for($i = 1; $i <= 5; $i++)
    {
        if($numberOfStars >= 1)
        {
            $numberOfStars--;
        }
        elseif ($numberOfStars >= 0.5)
        {
            $numberOfStars -= 0.5;
        }
    }
}

// This will perform when a loop has been activated.
if($totalNumberOfStars > 0)
{
    // This will count the avarage number of a stars a specific hero gets.
    $totalNumberOfStars = $totalNumberOfStars / $loopCounterReview;
}

// This will print the avarage number of stars a hero or villian gets.
for($i = 1; $i <= 5; $i++)
{
    if($totalNumberOfStars >= 1)
        {
            echo "<img class='Review_Stars' src='Afbeeldingen/Rating_Stars/FullStar.png' />";
            $totalNumberOfStars--;
        }
        elseif ($totalNumberOfStars >= 0.5)
        {
            echo "<img class='Review_Stars' src='Afbeeldingen/Rating_Stars/HalfStar.png' />";
            $totalNumberOfStars -= 0.5;
        }
        else
        {
            echo "<img class='Review_Stars' src='Afbeeldingen/Rating_Stars/EmptyStar.png' />";
        }
}
?>