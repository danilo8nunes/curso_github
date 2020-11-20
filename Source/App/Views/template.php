<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?= url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= url();?>assets/css/style.css">
    <script src="https://kit.fontawesome.com/d3c56018e1.js" crossorigin="anonymous"></script>
    <title><?= $title; ?></title>
<body>
    <div class='container-jumbotron container mx-auto mt-0 p-1'>
        <div class="jumbotron bg-primary text-white text-center mb-3">
            <h1 class="display-4">
                <i class="fas fa-address-book" style="font-size:60px"></i>
                <strong>Contacts</strong>
            </h1>
        </div>
   </div>
    <?= $alert; ?>
    
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>

    <script type="text/javascript" src="<?= url();?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?= url();?>assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?= url();?>assets/js/script.js"></script>
</body>
</html>