<?php

$config = include 'config.php';
include 'House.php';

function getTitle()
{
    return 'Binalar';
}

$houses = file_get_contents("https://www.potterapi.com/v1/houses?key={$config['api_key']}");

$decodedHouses = json_decode($houses, true);
$houseDetails = [];

foreach ($decodedHouses as $decode) {
    $house = new House();
    
    try {
        $house->setId($decode['_id'])
            ->setName($decode['name'])
            ->setFounder($decode['founder']);
    } catch (HouseNotFound $houseNotFound) {
        $house->setName('Gryfindor')
            ->setFounder($decode['founder']);
    } catch (WrongIdTypeException $typeException) {
        die($typeException->getMessage());
    }
    
    $house->headOfHouse = $decode['headOfHouse'] ?? null;
    $house->mascot = $decode['mascot'] ?? null;
    $house->houseGhost = $decode['houseGhost'] ?? null;
    $house->school = $decode['school'] ?? null;
    
    $houseDetails[] = $house;
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
                        <img class="card-img-top" src="assets/images/houses/<?php echo strtolower($detail->name) ?>.jpg" alt="<?php echo $detail->name; ?>">
                        <div class="card-body">
                            <h5 align="center" class="card-title"><strong><?php echo strtoupper($detail->name); ?></strong></h5>
                            <p class="card-text">
                                <strong>Bina Kurucusunun Soyadı:</strong> <?php echo $detail->getFounder(); ?>
                            </p>
                            <p class="card-text">
                                <strong>Bina Müdürü:</strong> <?php echo $detail->headOfHouse; ?>
                            </p>
                            <p class="card-text">
                                <strong>Bina Maskotu  :</strong> <?php echo $detail->mascot; ?>
                            </p>
                            <p class="card-text">
                                <strong>Bina Hayaleti :</strong> <?php echo $detail->houseGhost; ?>
                            </p>
                            <p class="card-text">
                                <strong>Okul:</strong> <?php echo $detail->school; ?>
                            </p>
                            <div class="justify-content-between align-items-center">
                                <div class="btn-group float-right">
                                    <a href="characters.php?house=<?php echo strtolower($detail->name); ?>" class="btn btn-sm btn-outline-secondary">Show Students</a>
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
