<?php 

use app\components\commons\CsrfSecurity;

$this->renderView('views/layout/header', []); 
?>
<?php
$login = $params['login'];
?>


<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a class="license-sys" href="./index.php?controller=index&action=index">License System</a>
    </h5>
 
  <a class="btn btn-outline-primary" href="./index.php?controller=index&action=login">Have an account? Login.</a>
</div>


<?php
if ($login->hasErrors()) {
    ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php
            foreach ($login->getErrors() as $error) {
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
<div class="row">
    <div class="col-md-3">
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method='post'>
            <input type="hidden" name="csrf_token" value="<?php echo CsrfSecurity::generateCsrfToken(); ?>"/>
            <div class="form-group">
                <label for="name">Create account</label>
                <input type="text" class="form-control" id="name" name="createAccount[name]" value='<?= $login->name ?>' placeholder="Name">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="createAccount[password]" value='<?= $login->password ?>' placeholder="Password">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="createAccount[email]" value='<?= $login->email ?>' placeholder="Email">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
   
</div>


<?php $this->renderView('views/layout/footer', []); ?>