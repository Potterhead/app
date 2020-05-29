<?php

session_start();

$showForm = true;

if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    unset($_SESSION['inputs']);
    $showForm = false;
}

$inputs = [
    'fullname' => $_SESSION['inputs']['fullname'] ?? '',
    'email' => $_SESSION['inputs']['email'] ?? '',
    'house_id' => $_SESSION['inputs']['house_id'] ?? '',
    'password' => $_SESSION['inputs']['password'] ?? '',
];

function getTitle()
{
    return 'Kayıt Ol';
}

$config = include 'config.php';

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
                
                <?php
                if (isset($_SESSION['errors'])):
                    if (count($_SESSION['errors']) > 0) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <p><strong>Form'da bazı hatalarla karşılaşıldı!</strong></p>

                            <ul>
                                <?php
                                foreach ($_SESSION['errors'] as $error):
                                    ?>
                                    <li><?php echo $error['message']; ?></li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                <?php
                } else {
                ?>
                        <div class="alert alert-success" role="alert">
                            <p><strong>Tebrikler! Potterhead'e hoş geldiniz!</strong></p>
                        </div>
                <?php
                }
                endif;
                ?>

                <?php if($showForm): ?>
                <form name="registerForm" method="POST" action="action.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">İsim Soyisim</label>
                        <input name="fullname" value="<?php echo $inputs['fullname']; ?>" type="text"
                               class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Eposta Adresi</label>
                        <input name="email" value="<?php echo $inputs['email']; ?>" type="email" class="form-control"
                               id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Bina Seç</label>
                        <select name="house_id" class="form-control" id="exampleFormControlSelect1">
                            <?php foreach ($config['validHouses'] as $houseId => $house): ?>
                                <option <?php if ($houseId == $inputs['house_id']) {
                                    echo 'selected="selected"';
                                } ?> value="<?php echo $houseId; ?>"><?php echo ucfirst($house); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Parola</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button name="submit" value="1" type="submit" class="btn btn-primary">Kayıt Ol</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php

session_destroy();

include 'footer.php';
