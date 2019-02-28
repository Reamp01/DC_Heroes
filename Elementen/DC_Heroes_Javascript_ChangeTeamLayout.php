<?php

switch ($teamNumber) 
    {
        case 1:
            echo "document.getElementById('Selected_Team_Img').src = 'Afbeeldingen/Teams/bat.png';";
            echo "document.getElementById('Choose_Team').style.backgroundColor = '#333333';";
            echo "document.getElementById('Homepage_Header').style.backgroundColor = '#333333';";
        break;

        case 2:
            echo "document.getElementById('Selected_Team_Img').src = 'Afbeeldingen/Teams/sup.jpg';";
            echo "document.getElementById('Choose_Team').style.backgroundColor = '#0079c2';";
            echo "document.getElementById('Homepage_Header').style.backgroundColor = '#0079c2';";
        break;

        case 3;
            echo "document.getElementById('Selected_Team_Img').src = 'Afbeeldingen/Teams/fla.jpg';";
            echo "document.getElementById('Choose_Team').style.backgroundColor = '#800a0a';";
            echo "document.getElementById('Homepage_Header').style.backgroundColor = '#800a0a';";
        break;

        case 4;
            echo "document.getElementById('Selected_Team_Img').src = 'Afbeeldingen/Teams/sui.jpg';";
            echo "document.getElementById('Choose_Team').style.backgroundColor = '#000000';";
            echo "document.getElementById('Homepage_Header').style.backgroundColor = '#000000';";
        break;

        case 5;
            echo "document.getElementById('Selected_Team_Img').src = 'Afbeeldingen/Teams/jus.jpg';";
            echo "document.getElementById('Choose_Team').style.backgroundColor = '#000000';";
            echo "document.getElementById('Homepage_Header').style.backgroundColor = '#000000';";
        break;
    }
?>