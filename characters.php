<?php

$config = include 'config.php';

function getTitle()
{
    return 'Karakterler';
}

$apiUrl = "https://www.potterapi.com/v1/characters?key={$config['api_key']}";

//hello
if (isset($_GET['house'])) {
    
    $validHouses = [
        '5a05e2b252f721a3cf2ea33f' => 'gryffindor',
        '5a05da69d45bd0a11bd5e06f' => 'ravenclaw',
        '5a05dc8cd45bd0a11bd5e071' => 'slytherin',
        '5a05dc58d45bd0a11bd5e070' => 'hufflepuff',
    ];
    if (!in_array($_GET['house'], $validHouses)) {
        exit('Böyle bir ev yok');
    }

    $apiUrl .= ($_GET['house'] ? "&house=" . ucfirst($_GET['house']) : '');
}

$characters = file_get_contents($apiUrl);
function translate($str,$lang1,$lang2)
{
    if (!empty($str)) {
        $data = file_get_contents(preg_replace("/ /", "%20", "https://translate.yandex.net/api/v1.5/tr.json/translate?lang=$lang1-$lang2&key=trnsl.1.1.20200517T084000Z.a97e2d8c203592be.b39042ec7867756140fada1a347146fd019a32d1&text=$str"));
        $data = json_decode($data, true);
        echo $data['text'][0];
    }
}


$characters = file_get_contents("https://www.potterapi.com/v1/characters?key={$config['api_key']}");

$characterDetails = [];

$characters = json_decode($characters, true);

foreach ($characters as $character) {
    $characterDetails[] = [
        '_id' => $character['_id'],    //house'daki üye bilgisi ile karşılaştırmak için kullanılıyor
        'name' => $character['name'],
        'house' => $character['house'] ?? '',
        'role' => $character['role'] ?? '',
        'bloodStatus' => $character['bloodStatus'],
        'species' => $character['species']
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
                <span><?php echo $_GET['house'] ?? '' ?></span>
            </div>
        </section>


        <div class="bg-white p-5">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Ev</th>
                    <th scope="col">Kan Durumu</th>
                    <th scope="col">Tür</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $counter = 1;

                // sayfada uyarı bilgisi görünmemesi için eklendi. Butona basılarak sayfaya gidilmişse burası çalışır
                if(isset($_GET['house'])){
                    //linki parçalama ve $houseID değişkenine linkin sonundaki ID'yi atama
                    $link = $_SERVER['REQUEST_URI'];
                    $parts = parse_url($link);
                    $query = array();
                    parse_str($parts['query'], $query);
                    
                    $houseID = array_search($query['house'], $validHouses);
                    
                    //API key'i ile belirtilen ID'deki house'a ait üye bilgilerini çekme
                    $houses = file_get_contents("https://www.potterapi.com/v1/houses/{$houseID}?key={$config['api_key']}");
                    $houses = json_decode($houses, true);
                }

                // Karakter sayfasından çekilen karakter bilgilerini tabloya yazdırma
                foreach ($characterDetails as $detail):
                    if (!isset($_GET['house']) || $_GET['house'] == strtolower($detail['house'])) {
                    // house bilgisi girilmemişse yani house sayfasından butona basılmamışsa tüm karakterleri yazar
                ?>
                        <tr>
                            <th scope="row"><?php echo $counter++; ?> </th>
                            <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?php echo $detail['name']?>.jpg"></td>
                            <td><?php echo $detail['name'];?></td>
                            <td><?php echo $detail['role'];?></td>
                            <td><?php echo $detail['house'];?></td>
                            <td><?php echo $detail['bloodStatus'];?></td>
                            <td><?php echo $detail['species'];?></td>
                            <!--
                            Translate API için kullandım ama biraz yavaş yüklendiği için yorum satırı içerisine aldım
                            <th scope="row"><?//php echo $counter++; ?> </th>
                            <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?//php echo $detail['name']?>.jpg"></td>
                            <td><?//php echo $detail['name'];?></td>
                            <td><?//php translate("".$detail['role'], "en", "tr");?></td>
                            <td><?//php echo $detail['house'];?></td>
                            <td><?//php translate("".$detail['bloodStatus'], "en", "tr");?></td>
                            <td><?//php translate("".$detail['species'], "en", "tr");?></td>
                            -->
                        </tr>
                        <?php
                    }
                    // house bilgisi girilmişse yani house sayfasından butona basılmışsa sadece o house ID'sine sahip karakterleri yazar
                    else{
                        //Burayı inceleyebilirsiniz: https://www.potterapi.com/v1/houses/5a05da69d45bd0a11bd5e06f?key=$2a$10$EKveuCEHVz5zic.8WJQHjuqmFYREVSj5V1TH7Tkw8vdLuIeTnVb86
                        $houseDetail = [];
                        foreach ($houses[0]["members"] as $uye){
                            $houseDetail[] = [
                                'id' => $houses[0]['_id'],
                                'name' => $houses[0]['name'],
                                'members' => $uye['_id']
                            ];
                        }

                        foreach ($houseDetail as $inf){
                            // House bilgilerindeki üye ID'si ile karakter bilgilerindeki üye ID'si eşitse tabloya yazar
                            if($inf['members'] == $detail['_id']){
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $counter++; ?> </th>
                                    <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?php echo $detail['name']?>.jpg"></td>
                                    <td><?php echo $detail['name'];?></td>
                                    <td><?php echo $detail['role'];?></td>
                                    <td><?php echo $detail['house'];?></td>
                                    <td><?php echo $detail['bloodStatus'];?></td>
                                    <td><?php echo $detail['species'];?></td>
                                    <!--
                                    Translate API için kullandım ama biraz yavaş yüklendiği için yorum satırı içerisine aldım
                                    <th scope="row"><?//php echo $counter++; ?> </th>
                                    <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/characters/<?//php echo $detail['name']?>.jpg"></td>
                                    <td><?//php echo $detail['name'];?></td>
                                    <td><?//php translate("".$detail['role'], "en", "tr");?></td>
                                    <td><?//php echo $detail['house'];?></td>
                                    <td><?//php translate("".$detail['bloodStatus'], "en", "tr");?></td>
                                    <td><?//php translate("".$detail['species'], "en", "tr");?></td>
                                    -->
                                </tr>
                                <?php
                                break;
                            }
                        }
                    }
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
