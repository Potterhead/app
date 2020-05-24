<?php

$config = include 'config.php';
include 'func.php';

$house = file_get_contents("https://www.potterapi.com/v1/sortingHat?key={$config['api_key']}");

$house = str_replace("\"", "", strtolower($house));

$houseId =  array_search($house, houses());

$houseInformation = file_get_contents("https://www.potterapi.com/v1/houses/{$houseId}?key={$config['api_key']}");

$houseDetails = json_decode($houseInformation, 1)[0] ?? [];

?>

<?php

include_once 'header.php';

include_once 'navbar.php';

?>

<div class="pt-5">

    <div class="container">

        <section class="jumbotron text-center pt-5 mb-5 bg-white">
            <div class="container">
                <h1 class="jumbotron-heading"><?php echo getTitle(); ?></h1>
            </div>
        </section>

        <div class="bg-white p-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6">
                        <p>Tebrikler! Seçmen şapka sizi <strong><a href="houses.php" style="background-color: <?php echo houseColor($house); ?>; color: #fff;"><?php echo $house; ?></a></strong> evine yerleştirdi.</p>
                        <span class="mb-3">Ufak Bilgiler</span>
                        <ul class="mt-3">
                            <li>
                                <strong>Bina Kurucusu:</strong> <?php echo $houseDetails['founder'] ?? "" ?>
                            </li>
                            <li>
                                <strong>Bina Müdürü:</strong> <?php echo $houseDetails['headOfHouse'] ?? "" ?>
                            </li>
                            <li>
                                <strong>Bina Hayaleti:</strong> <?php echo $houseDetails['houseGhost'] ?? "" ?>
                            </li>
                            <li>
                                <strong>Bina Maskotu:</strong> <?php echo $houseDetails['mascot'] ?? "" ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <img class="card-img-top" src="assets/images/houses/<?php echo $house ?>.jpg" alt="<?php echo $house; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include_once 'footer.php';

?>
