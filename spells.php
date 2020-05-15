<?php

function getTitle()
{
    return 'Büyüler';
}

$spells = file_get_contents('https://www.potterapi.com/v1/spells?key=$2a$10$UL7Usqkb3s/o8PPz.ZOxxe3JJtOKObSTkaxqdeONfjp4RhKdMDQuS');

$decodedSpells = json_decode($spells, true);

$spellNames = [];

foreach ($decodedSpells as $spell) {
    $spellNames[] = $spell['spell'];
}

?>

<?php

include 'header.php';

include 'navbar.php';

?>


<h1><?php echo getTitle(); ?></h1>

<?php

foreach ($spellNames as $name) {
    echo $name . '<br>';
}

?>

<?php

include 'footer.php';

?>
