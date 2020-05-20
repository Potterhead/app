<?php

$config = include 'config.php';

function getTitle()
{
    return 'Evler';
}

$houses = file_get_contents("https://www.potterapi.com/v1/houses?key={$config['api_key']}");

$decodedHouses = json_decode($houses, true);
$houseDetails = [];

foreach ($decodedHouses as $house) {
    $houseDetails[] = [
        'id' => $house['_id'],
        'name' => $house['name'] ?? null,
        'founder' => $house['founder'] ?? null,
        'headOfHouse' => $house['headOfHouse'] ?? null,
        'mascot' => $house['mascot'] ?? null,
        'houseGhost' => $house['houseGhost'] ?? null,
        'school' => $house['school'] ?? null,
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
            </div>
        </section>

        <div class="row bg-white p-5">
            <?php
            foreach ($houseDetails as $detail):
            ?>
                <div class="col-md-6">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="assets/images/houses/<?php echo strtolower($detail['name']) ?>.jpg" alt="<?php echo $detail['name']; ?>">
                        <div class="card-body">
                            <h5 align="center" class="card-title"><strong><?php echo strtoupper($detail['name']); ?></strong></h5>
                            <p class="card-text">
                                <strong>Evin Kurucusu:</strong> <?php echo $detail['founder']; ?>
                            </p>
                            <p class="card-text">
                                <strong>Bina Müdürü:</strong> <?php echo $detail['headOfHouse']; ?>
                            </p>
                            <p class="card-text">
                                <strong>Evin Maskotu  :</strong> <?php echo $detail['mascot']; ?>
                            </p>
                            <p class="card-text">
                                <strong>Evin Hayaleti :</strong> <?php echo $detail['houseGhost']; ?>
                            </p>
                            <p class="card-text">
                                <strong>Okul:</strong> <?php echo $detail['school']; ?>
                            </p>
                            <div class="justify-content-between align-items-center">
                                <div class="btn-group float-right">
                                    <a href="characters.php?house=<?php echo strtolower($detail['name']); ?>" class="btn btn-sm btn-outline-secondary">Show Students</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>


<?php

include 'footer.php';

?>
