<div class="callbacks_container">
	<ul class="rslides" id="slider">
	<?php
	//var_dump($view->result[0]->field_field_image_slider);
	//echo drupal_realpath($view->result[0]->field_field_image_slider[0]['render']['uri']);
	foreach ($view->result[0]->field_field_image_slider as $key => $value) {?>
       <li><img src="<?php print $GLOBALS['base_path']."sites/default/files/Homepage Slider/".$value['raw']['filename']; ?>" class="img-responsive" alt="" /></li>
      <?php }?>
	</ul>
</div>
<style>
	.rslides {
	  position: relative;
	  list-style: none;
	  overflow: hidden;
	  width: 100%;
	  padding: 0;
	  margin: 0;
	  }

	.rslides li {
	  -webkit-backface-visibility: hidden;
	  position: absolute;
	  display: none;
	  width: 100%;
	  left: 0;
	  top: 0;
	  }

	.rslides li:first-child {
	  position: relative;
	  display: block;
	  float: left;
	  }

	.rslides img {
	  display: block;
	  height: auto;
	  float: left;
	  width: 100%;
	  border: 0;
	  }
	  .callbacks_container .prev{
		left:1.3%;
		display:block;
		position:absolute;
		top:50%;
		z-index:20;
	  }
	  .callbacks_container .next{
		right:1.3%;
		display:block;
		position:absolute;
		top:50%;
		z-index:20;
	  }
</style>