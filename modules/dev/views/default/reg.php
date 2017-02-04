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
        'template' => '<div>{label}:<br>{input}{error}</div>',
    ],
]);
?>

<?php echo $form->field($model, 'name')->textInput(); ?>
<?php echo $form->field($model, 'phone')->textInput(); ?>
<?php echo $form->field($model, 'password')->passwordInput(); ?>
<?php echo $form->field($model, 'repassword')->passwordInput(); ?>

<?php echo Html::submitButton('注册'); ?>

<?php ActiveForm::end(); ?>

<h3>AJAX调用</h3>

<input type="button" id="testBtn" value="AJAX">

<?php
/*
$this->registerJS('$("#testBtn").click(function(){
    $.ajax({
        type:"POST",
        dataType:"json",
        data:{"id":"1","value":"2"},
        url:"http://nx.dev/index.php?r=dev/default/ajax", 
        success: function(data, status){alert(data.id);alert(data.value); alert(status);},
        error: function() {alert("NO");}
    });
})');
*/

$jsTestBtn = <<<JS
$("#testBtn").click(function(){
    $.ajax({
        type:"POST",
        dataType:"json",
        data:{"id":"1","value":"2"},
        url:"http://nx.dev/index.php?r=dev/default/ajax", 
        success: function(data, status){alert(data.id);alert(data.value); alert(status);},
        error: function() {alert("NO");}
    });
});
JS;
$this->registerJS($jsTestBtn);

?>

