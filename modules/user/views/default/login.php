<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<h3>用户登陆</h3>

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
<?php echo $form->field($model, 'password')->passwordInput(); ?>

<?php echo Html::submitButton('登陆'); ?>
<?php echo '   '; ?>
<?php echo Html::resetButton('重置'); ?>

<?php ActiveForm::end(); ?>
