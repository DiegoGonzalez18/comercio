<ul class="pgwSlider">
<?php
require_once 'app/Controllers/SliderController.php';

$a=new SliderController();
$sliders=  $a->listarS();

?>
</ul>
