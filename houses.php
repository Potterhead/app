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
        'name' => $house['name'],
        'founder' => $house['founder'],
        'headOfHouse' => $house['headOfHouse']
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
            <?php  foreach ($houseDetails as $detail) { ?>
                <div class="col-md-6">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="/assets/images/<?php echo $detail['name'] ?>.jpg" alt="<?php echo $detail['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $detail['name']; ?></h5>
                            <p class="card-text">
                                <ul>
                                    <li><strong>Founder: </strong><?php echo $detail['founder']; ?></li>
                                    <li><strong>Head of House: </strong><?php echo $detail['headOfHouse']; ?></li>
                                </ul>

                            </p>
                            <div class="justify-content-between align-items-center">
                                <div class="btn-group float-right">
                                    <a href="characters.php?house=<?php echo strtolower($detail['name']); ?>" class="btn btn-sm btn-outline-secondary">Show Students</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>


<?php

include 'footer.php';

?>
