<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<h3>注册新用户</h3>

<?php
if (Yii::$app->session->hasFlash('info')) {
    echo Yii::$app->session->getFlash('info');
    echo '<br><br>';
}
?>

<?php
$form = ActiveForm::begin([
    'fieldConfig' => [
        'template' => '<div>{label}:<br>{input}{error}-----------------------<br></div>',
    ],
]);
?>

<?php echo $form->field($model, 'name')->textInput(); ?>
<?php echo $form->field($model, 'email')->textInput(); ?>
<?php echo $form->field($model, 'password')->passwordInput(); ?>
<?php echo $form->field($model, 'repassword')->passwordInput(); ?>

<?php echo Html::submitButton('注册'); ?>
<?php echo '   '; ?>
<?php echo Html::resetButton('重置'); ?>

<?php ActiveForm::end(); ?>
