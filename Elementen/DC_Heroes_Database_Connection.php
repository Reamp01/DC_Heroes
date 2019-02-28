<?php
// This are the variables for connection to a datase
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'dc-heroes';

if(isset($_GET['teamNumber']))
{
    if(isset($_GET['heroNumber']))
    {
        $heroNumber = $_GET['heroNumber'];

        //This database connection is for getting information from a specific hero
        $conn = mysqli_connect($servername, $username, $password, $database);            
        $sql = "select * from hero where heroId=" . $heroNumber .";";
        $result = mysqli_query($conn, $sql);
        $infoHeroArray = array();
        $infoHeroArray = mysqli_fetch_assoc($result);
        mysqli_close($conn);

        if(!empty($_POST['reviewStarNumber']) || !empty($_POST['reviewDate']) || !empty($_POST['reviewComment']))
        {
            $reviewRating = $_POST["reviewStarNumber"];
            $reviewDate = $_POST["reviewDate"];
            $reviewComment = $_POST["reviewComment"];
            $reviewName = $_POST['reviewName'];

            // This is for posting the information that was filled in the form into the database: "review"
            $conn = mysqli_connect($servername, $username, $password, $database);               
            if (!$conn) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = 'INSERT INTO rating VALUES (NULL, '. $heroNumber .', '. $reviewRating .', '. $reviewDate .', "'. $reviewComment .'","'. $reviewName .'");';
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn); 
        }

        //This database connection is for getting review-information from a specific hero
        $conn = mysqli_connect($servername, $username, $password, $database);              
        $sql = "select * from rating where heroId=" . $heroNumber .";";
        $result = mysqli_query($conn, $sql);
        $infoHeroReviewsArray = array();
        if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                $infoHeroReviewsArray[] = $row;
            }
        }
        mysqli_close($conn);
    }

    // The teamNumber will be taken from the url
    $teamNumber = $_GET['teamNumber'];

    //This is for getting al the team-members from a specific team
    $conn = mysqli_connect($servername, $username, $password, $database);
    switch ($teamNumber) 
    {
        case 1:
            $sql = "select hero.heroId, heroName, heroDescription, heroPower, heroImage, teamId, AVG(rating) from hero left JOIN rating on hero.heroId = rating.heroId where teamId=1 GROUP BY heroId;";
            break;
        case 2:
            $sql = "select hero.heroId, heroName, heroDescription, heroPower, heroImage, teamId, AVG(rating) from hero left JOIN rating on hero.heroId = rating.heroId where teamId=2 GROUP BY heroId;";
        break;
        case 3:
            $sql = "select hero.heroId, heroName, heroDescription, heroPower, heroImage, teamId, AVG(rating) from hero left JOIN rating on hero.heroId = rating.heroId where teamId=3 GROUP BY heroId;";
        break;
        case 4:
            $sql = "select hero.heroId, heroName, heroDescription, heroPower, heroImage, teamId, AVG(rating) from hero left JOIN rating on hero.heroId = rating.heroId where teamId=4 GROUP BY heroId;";
        break;
        case 5:
            $sql = "select hero.heroId, heroName, heroDescription, heroPower, heroImage, teamId, AVG(rating) from hero left JOIN rating on hero.heroId = rating.heroId where teamId=5 GROUP BY heroId;";
        break;
    }
    $result = mysqli_query($conn, $sql) or die($sql);
    $chooseHeroArray = array();
    if (mysqli_num_rows($result) > 0) 
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            $chooseHeroArray[] = $row;
        }
    }
    mysqli_close($conn);
}

// This is for looping trough the team names
$conn = mysqli_connect($servername, $username, $password, $database);
$sql = "SELECT teamId, teamName, teamImage, COUNT(heroId) from team NATURAL JOIN hero GROUP BY teamID";
$result = mysqli_query($conn, $sql);
$chooseTeamArray = array();
if (mysqli_num_rows($result) > 0) 
{
    while($row = mysqli_fetch_assoc($result)) 
    {
        $chooseTeamArray[] = $row;
    }
}
mysqli_close($conn);
?>
