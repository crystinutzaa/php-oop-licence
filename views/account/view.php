<?php 

use app\components\commons\CsrfSecurity;

$this->renderView('views/layout/header', []); 
?>
<?php
$license = $params['license'];
$expirationDate = $params['expirationDate'];
$isLogged = $params['isLogged'];
$displayName = $params['displayName'];
$websites = $params['websites'];
$licenseIsExpired = $params['licenseIsExpired'];
?>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a class="license-sys" href="./index.php?controller=index&action=index<?php if ($licenseIsExpired) echo '&expiredLicense=1';?>">License System</a>
    </h5>


    <a class="btn btn-outline-primary" href="./index.php?controller=account&action=view">Hi <?php echo $displayName; ?> </a>
    <a id="logout" class="btn btn-outline-primary" href="./index.php?controller=index&action=logout">Logout</a>


</div>

<?php
if (isset($license)) {

    ?>
    <div class = "card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal <?php if ($licenseIsExpired) echo 'alert alert-danger';?>"> <?php echo $license->name .' - Expires: ' . $expirationDate ?></h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title"><?php echo $license->price ?> <small class="text-muted">/ year</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li><?php echo $license->allowed_websites ?> allowed websites</li>
                </ul>
                

                
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method='post'>
                    <input type="hidden" name="csrf_token" value="<?php echo CsrfSecurity::generateCsrfToken(); ?>"/>
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal"> Add Website URLs</h4>
                    </div>
                    <br/>
                    <div class="">
                        <?php 
                            for ($i=0; $i < $license->allowed_websites; $i++ ) {
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <!--<label for="website">Website URL</label>-->
                                            <input type="hidden" class="form-control"  name="websites[id_website][]" value='<?php if (isset($websites[$i])) {echo $websites[$i]->id_website;} ?>'>
                                            
                                            <?php

                                                if (isset($websites[$i]) &&  $websites[$i]->hasErrors()) {
                                                    ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <ul>
                                                            <?php
                                                            foreach ($websites[$i]->getErrors() as $error) {
                                                                ?>
                                                                <li> <?php echo $error->message ?></li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            <input type="text" class="form-control"  name="websites[url][]" value='<?php if (isset($websites[$i])) {echo $websites[$i]->url;} ?>' placeholder="Website URL  <?= $i+1?>">
                                        </div>

                                    </div> 
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                    
                     <button type="submit" class="btn btn-primary" <?php if ($licenseIsExpired) echo 'disabled';?> >Submit Websites</button>
                     <?php if ($licenseIsExpired) {
                         
                     ?>
                          <a href="./index.php?controller=index&action=index&expiredLicense=1">Buy License</a>
                     <?php
                     
                     }?>
                </form>
                
            </div>
        </div>

    </div>
    <?php
} else {

    ?>
    <div class="alert alert-info" role="alert">No license available yet</div> 

    <div class="clear">
        <a class="btn btn-outline-primary" href="./index.php?controller=index&action=index">Select a license</a>
    </div>
    <?php
}

?>

<?php $this->renderView('views/layout/footer', []); ?>