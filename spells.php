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

<div class="pt-5">

    <div class="container">

        <section class="jumbotron text-center pt-5 mb-5 bg-white">
            <div class="container">
                <h1 class="jumbotron-heading"><?php echo getTitle(); ?></h1>
            </div>
        </section>


        <div class="bg-white p-5">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Spell</th>
                    <th scope="col">Type</th>
                    <th scope="col">Effect</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $counter = 1;
                foreach ($spellNames as $name) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $counter++; ?> </th>
                        <td><?php echo $name; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php

include 'footer.php';

?>
