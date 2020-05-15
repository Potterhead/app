<?php

function getTitle()
{
    return 'Evler';
}

$houses = file_get_contents('https://www.potterapi.com/v1/houses?key=$2a$10$UL7Usqkb3s/o8PPz.ZOxxe3JJtOKObSTkaxqdeONfjp4RhKdMDQuS');

$decodedHouses = json_decode($houses, true);

$houseNames = [];

foreach ($decodedHouses as $house) {
    $houseNames[] = $house['name'];
}

?>

<?php

include 'header.php';

include 'navbar.php';

?>


<h1><?php echo getTitle(); ?></h1>

<?php

foreach ($houseNames as $houseName) {
    echo "$houseName<br>";
}

?>

<?php

include 'footer.php';

?>
