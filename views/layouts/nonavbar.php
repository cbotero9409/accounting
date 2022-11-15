<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Html;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="body_login">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="body_login">
        
        <?php $this->beginBody() ?>                

                        <?php
                        
                        echo Alert::widget();

                        echo $content;
                        ?>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
