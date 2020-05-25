<style>
  td{border-right: 1px solid #dee2e6;text-align: center;}
  th{text-align: center !important;}
  tr:nth-child(odd){background-color: #efefefa1;}
  thead tr:first-child{background-color: #fff;}
</style>
<?php

$config = include 'config.php';
include 'Spell.php';
function getTitle()
{
    return 'Büyüler';
}

$spells = file_get_contents("https://www.potterapi.com/v1/spells?key={$config['api_key']}");

$decodedSpells = json_decode($spells, true);

$spellDetails = [];

foreach ($decodedSpells as $decode) {
    $spell = new Spell();
    $spell->spell = $decode['spell'];

    try {
      $spell->setType($decode['type']);
    } catch (SpellNotFound $exception) {
      die($exception->getMessage());
    }

    $spell->effect = $decode['effect'];
    $spellDetails[] = $spell;
    // die(var_dump($spellDetails));
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
                    <th scope="col">Büyü</th>
                    <th scope="col">Tür</th>
                    <th scope="col">Etki</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $counter = 1;
                foreach ($spellDetails as $detail) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $counter++; ?> </th>
                        <td><?php echo $detail->spell; ?></td>
                        <td><?php echo $detail->type; ?></td>
                        <td><?php echo $detail->effect; ?></td>
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
