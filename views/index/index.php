<?php $this->renderView('views/layout/header', []); ?>
<?php
$licenses = $params['licenses'];
$isLogged = $params['isLogged'];
$displayName = $params['displayName'];
$idLicense = $params['idLicense'];
$expiredLicense = $params['expiredLicense'];
?>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a class="license-sys" href="./index.php?controller=index&action=index">License System</a>
    </h5>
 
  
<?php
if ($isLogged) {

    ?>
    <a class="btn btn-outline-primary" href="./index.php?controller=account&action=view">Hi <?php echo $displayName; ?> </a>
    <a id="logout" class="btn btn-outline-primary" href="./index.php?controller=index&action=logout">Logout</a>
    <?php } else {

    ?>
    <a class="btn btn-outline-primary" href="./index.php?controller=index&action=login">Login</a>
    <?php }

    ?>
</div>
    <div class="card-deck mb-3 text-center">
        <?php
        if (is_array($licenses) && count($licenses) > 0) {
            foreach ($licenses as $license) {

                ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal"> <?php echo $license->name ?></h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><?php echo $license->price ?> <small class="text-muted">/ year</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li><?php echo $license->allowed_websites ?> allowed websites</li>
                        </ul>
                        <?php 
                            if (isset($idLicense) && $idLicense == $license->id) {
                        ?>
                            <?php
                                if (isset($expiredLicense) && $expiredLicense)  {
                            ?>
                                    <a class="buy-license btn btn-lg btn-block btn-primary" href="./index.php?controller=cart&action=buy&id=<?php echo $license->id ?>">Continue with Current Plan</a>
                            <?php } else {
                            ?>
                                <a class="btn btn-lg btn-block btn-primary" href="#">Current Plan</a>
                            <?php
                            } ?>
                        <?php 
                            } else if (!isset($idLicense)) {
                       ?>
                                <a class="buy-license btn btn-lg btn-block btn-outline-primary" href="./index.php?controller=cart&action=buy&id=<?php echo $license->id ?>">Buy</a>
                         <?php 
                            } else {
                          ?>    
                                <a class="buy-license btn btn-lg btn-block btn-outline-primary" href="./index.php?controller=cart&action=buy&id=<?php echo $license->id ?>">Upgrade</a>
                                <?php 
                            }
                        ?>
                        
                    </div>
                </div>
                <?php
            }
        } else {

            ?>
            <div class="alert alert-info" role="alert">No license available yet</div> 
        <?php
    }

    ?>
    </div>

    <?php $this->renderView('views/layout/footer', []); ?>