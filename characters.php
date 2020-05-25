<style>
  td{border-right: 1px solid #dee2e6;text-align: center; vertical-align: middle !important;}
  th{text-align: center !important;}
  tr:nth-child(odd){background-color: #efefefa1;}
  thead tr:first-child{background-color: #fff;}
</style>
<?php

$config = include 'config.php';

function getTitle()
{
    return 'Karakterler';
}

$apiUrl = "https://www.potterapi.com/v1/characters?key={$config['api_key']}";

if (isset($_GET['house'])) {

    $validHouses = $config['validHouses'];
    if (!in_array($_GET['house'], $validHouses)) {
        exit('Böyle bir bina yok');
    }

    $apiUrl .= ($_GET['house'] ? "&house=" . ucfirst($_GET['house']) : '');
}


$characters = file_get_contents($apiUrl);

$characterDetails = [];

$characters = json_decode($characters, true);

foreach ($characters as $character) {
    $characterDetails[] = [
        '_id' => $character['_id'],
        'name' => $character['name'],
        'house' => $character['house'] ?? null,
        'role' => $character['role'] ?? null,
        'bloodStatus' => $character['bloodStatus'] ?? null,
        'species' => $character['species'] ?? null
    ];
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
                <?php if(isset($_GET['house'])): ?>
                    <img class="card-img-top" style="width: 5%" src="/assets/images/houses/<?php echo $_GET['house'] ?>.jpg" alt="<?php echo $_GET['house']; ?>">
                    <span><?php echo strtoupper($_GET['house']) ?></span>
                <?php endif; ?>
            </div>
        </section>


        <div class="bg-white p-5">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 15%">Avatar</th>
                    <th scope="col" style="width: 15%">Ad</th>
                    <th scope="col" style="width: 25%">Rol</th>
                    <th scope="col">Bina</th>
                    <th scope="col">Kan Durumu</th>
                    <th scope="col">Tür</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($characterDetails as $detail):
                ?>
                    <tr>
                        <td>
                            <img style=" width: 50%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?php echo $detail['name']?>.jpg">
                        </td>
                        <td><?php echo $detail['name'];?></td>
                        <td><?php echo $detail['role'];?></td>
                        <td><?php echo $detail['house'];?></td>
                        <td><?php echo $detail['bloodStatus'];?></td>
                        <td><?php echo $detail['species'];?></td>
                    </tr>
                <?php
                    endforeach;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php

include 'footer.php';

?>
