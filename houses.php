<?php

$config = include 'config.php';

function getTitle()
{
    return 'Evler';
}

$houses = file_get_contents("https://www.potterapi.com/v1/houses?key={$config['api_key']}");

$decodedHouses = json_decode($houses, true);

$houseNamesAndIDs = [];
$houseInfos = [];

foreach ($decodedHouses as $house) {
    $houseNamesAndIDs[] = [
        $house['_id'] => $house['name']
    ];
    $houseInfos[] = [
        'kurucusu' => $house['founder'],
        'evinBasi' => $house['headOfHouse'],
        'maskotu' => $house['mascot'],
        'evinHayaleti' => $house['houseGhost'],
        'okulu' => $house['school']
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
            //$houseInfos dizisinin içerisinde gezinebilmek için oluşturuldu
            $sayac=0;
            foreach ($houseNamesAndIDs as $details) {
                foreach ($details as $houseId => $houseName){?>
                <div class="col-md-6">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="assets/images/houses/<?php echo $houseName?>.jpg" alt="<?php echo $houseName; ?>"> <!--Alperen Keşkekoğlu-->                        <div class="card-body">
                            <h5 align="center" class="card-title"><strong><?php if(isset($houseName)) echo strtoupper($houseName); else echo "Mevcut Değil";?></strong></h5>
                            <p class="card-text">
                                <strong>Evin Kurucusu:</strong> <?php if(isset($houseInfos[$sayac]['kurucusu'])) echo $houseInfos[$sayac]['kurucusu']; else echo "Mevcut Değil"; ?>
                            </p>
                            <p class="card-text">
                                <strong>Evin Başı &nbsp;&emsp;&emsp;:</strong> <?php if(isset($houseInfos[$sayac]['evinBasi'])) echo $houseInfos[$sayac]['evinBasi']; else echo "Mevcut Değil";?>
                            </p>
                            <p class="card-text">
                                <strong>Evin Maskotu  :</strong> <?php if(isset($houseInfos[$sayac]['maskotu'])) echo $houseInfos[$sayac]['maskotu']; else echo "Mevcut Değil"; ?>
                            </p>
                            <p class="card-text">
                                <strong> Evin Hayaleti :</strong> <?php if(isset($houseInfos[$sayac]['evinHayaleti'])) echo $houseInfos[$sayac]['evinHayaleti']; else echo "Mevcut Değil";?>
                            </p>
                            <p class="card-text">
                                <strong> Okul &emsp;&emsp;&emsp;&emsp;:</strong> <?php if(isset($houseInfos[$sayac]['okulu'])) echo $houseInfos[$sayac]['okulu']; else echo "Mevcut Değil"; ?>
                            </p>
                            <div class="justify-content-between align-items-center">
                                <div class="btn-group float-right">
                                    <a href="characters.php?house=<?php echo $houseId; ?>" class="btn btn-sm btn-outline-secondary">Show Students</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php $sayac++; }} ?>
        </div>
    </div>
</div>


<?php

include 'footer.php';

?>
