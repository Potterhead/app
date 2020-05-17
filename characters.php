<?php

$config = include 'config.php';

function getTitle()
{
    return 'Karakterler';
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
                    $houseID=$query['house'];

                    //API key'i ile belirtilen ID'deki house'a ait üye bilgilerini çekme
                    $houses = file_get_contents("https://www.potterapi.com/v1/houses/{$houseID}?key={$config['api_key']}");
                    $houses = json_decode($houses, true);
                }

                // Karakter sayfasından çekilen karakter bilgilerini tabloya yazdırma
                foreach ($characterDetails as $detail):
                    // house bilgisi girilmemişse yani house sayfasından butona basılmamışsa tüm karakterleri yazar
                    if (! isset($_GET['house'])) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $counter++; ?> </th>
                            <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/<?php echo $detail['name']?>.jpg"></td>
                            <td><?php echo $detail['name']; ?></td>
                            <td><?php echo $detail['role']; ?></td>
                            <td><?php echo $detail['house']; ?></td>
                            <td><?php echo $detail['bloodStatus']; ?></td>
                            <td><?php echo $detail['species']; ?></td>
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
                                    <td><img style=" width: 40%; height: auto;" alt="" class="card-img-top" src="assets/images/<?php echo $detail['name']?>.jpg"></td>
                                    <td><?php echo $detail['name']; ?></td>
                                    <td><?php echo $detail['role']; ?></td>
                                    <td><?php echo $detail['house']; ?></td>
                                    <td><?php echo $detail['bloodStatus']; ?></td>
                                    <td><?php echo $detail['species']; ?></td>
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
