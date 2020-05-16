<?php

$config = include 'config.php';

function getTitle()
{
    return 'Karakterler';
}

$characters = file_get_contents("https://www.potterapi.com/v1/characters?key={$config['api_key']}");

$characterNames = [];

$characters = json_decode($characters, true);

foreach ($characters as $character) {
    $characterNames[] = $character['name'];
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
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">House</th>
                    <th scope="col">Blood Status</th>
                    <th scope="col">Species</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $counter = 1;
                foreach ($characterNames as $name) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $counter++; ?> </th>
                        <td><?php echo $name; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
