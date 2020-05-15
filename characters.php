<?php

$config = include 'config.php';

function getTitle()
{
    return 'Karakterler';
}

$characters = file_get_contents("https://www.potterapi.com/v1/characters?key={$config['api_key']}");

$characterNames = [];

$characters = json_decode($characters, true);

foreach ($characters as $character) {
    $characterNames[] = $character['name'];
}

?>

<?php

include 'header.php';

include 'navbar.php';

?>

<h1><?php echo getTitle(); ?></h1>

<?php

foreach ($characterNames as $name) {
    echo $name . "<br>";
}

?>

<?php

include 'footer.php';

?>
