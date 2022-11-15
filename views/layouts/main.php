<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100 sb-nav-fixed">
        
        <?php $this->beginBody() ?>
        
        
       
        
               
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->

            <?= Html::a("<span>Inicio</span>", ['site/index'], ['class' => 'navbar-brand ps-3']) ?>
            <!-- Sidebar Toggle-->
            <?= Html::button("<i class='fas fa-bars'></i>", ['class' => 'btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0', 'id' => 'sidebarToggle']) ?>
            <!-- Navbar Search-->
            <?php $search_form = ActiveForm::begin(['options' => ['class' => 'd-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 ']]); ?>


            <?php ActiveForm::end(); ?>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 mx-auto">
                <li class="nav-item dropdown">                    
                    <?= Html::a("<i class='fas fa-user fa-fw'></i>", [''], ['class' => 'nav-link dropdown-toggle', 'id' => 'navbarDropdown', 'role' => 'button', 'data-bs-toggle' => 'dropdown', 'aria-expanded' => 'false']) ?>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">                        
                        <li><?= Html::a("<span>Configuraciones</span>", [''], ['class' => 'dropdown-item']) ?></li>
                        <li><?= Html::a("<span>Actividad</span>", [''], ['class' => 'dropdown-item']) ?></li>                    
                        <li><hr class="dropdown-divider" /></li>
                        <li><?= Html::a("<span>Cerrar Sesión</span>", [''], ['class' => 'dropdown-item']) ?></li>                        
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav"> 
                            <?php
                            if(Yii::$app->user->isGuest) {
                                echo Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Login", ['site/login'], ['class' => 'nav-link']);
                            }
                            ?>
                                 
                            <?= Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Empresas", ['company/index'], ['class' => 'nav-link']); ?>
                            <?= Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Terceros", ['thirdparties/index'], ['class' => 'nav-link']); ?>
                            <?= Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Proveedores", ['supplier/index'], ['class' => 'nav-link']); ?>
                            <?= Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Usuarios", ['users/index'], ['class' => 'nav-link']);  ?>
                            <?= Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Contactos", ['contacts/index'], ['class' => 'nav-link']); ?>                            
                            <?= Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Planes de Cuentas", ['chartaccounts/index'], ['class' => 'nav-link']); ?>
                            <?= Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Impuestos", ['retentions/index'], ['class' => 'nav-link']); ?>
                            <?= Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Facturas de Compra", ['invoices/index'], ['class' => 'nav-link']); ?>
                            <?= Html::a("<div class='sb-nav-link-icon'><i class='fas fa-table'></i></div> &nbsp Facturas de Venta", ['billofsale/index'], ['class' => 'nav-link']); ?>
                            <?php if(!Yii::$app->user->isGuest) {
                                echo Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout',
                    ['class' => 'btn btn-link logout']
                )
                            . Html::endForm(); }
                                ?>                       
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">

                <main>
                    <div class="container-fluid px-4">

                        <?php
                        echo Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);

                        echo Alert::widget();

                        echo $content;
                        ?>

                    </div>
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
