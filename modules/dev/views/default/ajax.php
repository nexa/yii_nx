
<h3>AJAX调用</h3>

<input type="button" id="testBtn" value="AJAX">

<?php
$this->registerJS('$("#testBtn").click(function(){
    $.ajax({
        type:"POST",
        dataType:"json",
        data:{"id":"1","value":"2"},
        url:"http://nx.dev/index.php?r=dev/default/ajax", 
        success: function(json){alert("OK");},
        error: function() {alert("NO");}
    });
})');
?>

<?php
//$this->registerJS('$("#testBtn").click(function(){alert("ajaesterJS");})');
?>
