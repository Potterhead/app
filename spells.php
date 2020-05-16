<?php

$config = include 'config.php';

function getTitle()
{
    return 'Büyüler';
}

$spells = file_get_contents("https://www.potterapi.com/v1/spells?key={$config['api_key']}");

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
