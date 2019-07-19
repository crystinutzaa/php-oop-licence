<?php
use app\components\commons\CsrfSecurity;

$this->renderView('views/layout/header', []);
?>
<?php
$license = $params['license'];
$expirationDate = $params['expirationDate'];
$isLogged = $params['isLogged'];
$displayName = $params['displayName'];

?>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a class="license-sys" href="./index.php?controller=index&action=index">License System</a>
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
                <h4 class="my-0 font-weight-normal"> <?php echo $license->name .' - Expires: ' . $expirationDate ?></h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title"><?php echo $license->price ?> <small class="text-muted">/ year</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li><?php echo $license->allowed_websites ?> allowed websites</li>
                </ul>
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method='post'>
                    <input type="hidden" name="csrf_token" value="<?php echo CsrfSecurity::generateCsrfToken(); ?>"/>
                    <input type="hidden" name="order[idLicense]" value="<?php echo $license->id ?>"/>
                    
                    <button type="submit" class="confirm-order btn btn-lg btn-block btn-outline-primary">Confirm Order</button>
                
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