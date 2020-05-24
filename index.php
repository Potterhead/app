<?php

$config = include 'config.php';

function getTitle()
{
    return 'Anasayfa';
}

$house = file_get_contents("https://www.potterapi.com/v1/sortingHat?key={$config['api_key']}");

$house = str_replace("\"", "", strtolower($house));

$validHouses = $config['validHouses'];

$houseId =  array_search($house, $validHouses);
$houseInformation = file_get_contents("https://www.potterapi.com/v1/houses/{$houseId}?key={$config['api_key']}");

$houseDetails = json_decode($houseInformation, 1)[0] ?? [];

function houseColor($house) {
    switch ($house) {
        case "gryffindor":
            $color = "#991d3c";
            break;
        case "ravenclaw":
            $color = "#025ab3";
            break;
        case "hufflepuff":
            $color = "#e8af26";
            break;
        case "slyterin":
            $color = "#164235";
            break;
        default:
            $color = "#000";
    }
    return $color;
}

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
                        <p>Tebrikler! Seçmen şapka sizi <strong><a href="houses.php" style="color: <?php echo houseColor($house); ?>"><?php echo $house; ?></a></strong> evine yerleştirdi.</p>
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
