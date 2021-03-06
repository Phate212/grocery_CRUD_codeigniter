<?php
	header('Content-type: text/html; charset=utf-8');
	
	$this->set_css($this->default_theme_path.'/datatables/css/datatables.css');
	$this->set_js_lib($this->default_theme_path.'/flexigrid/js/jquery.form.js');
	$this->set_js_config($this->default_theme_path.'/datatables/js/datatables-edit.js');
	$this->set_css($this->default_css_path.'/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);

	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
?>
<div class='ui-widget-content ui-corner-all datatables'>
	<h3 class="ui-accordion-header ui-helper-reset ui-state-default form-title">
		<div class='floatL form-title-left'>
			<a href="#"><?php echo $this->l('list_record'); ?> <?php echo $subject?></a>
		</div>
		<div class='clear'></div>
	</h3>
<div class='form-content form-div'>
	<?php echo form_open( $read_url, 'method="post" id="crudForm"  enctype="multipart/form-data"'); ?>
		<div>
		<?php
			$counter = 0;
			foreach($fields as $field)
			{
				$even_odd = $counter % 2 == 0 ? 'odd' : 'even';
				$counter++;
		?>
			<div class='form-field-box <?php echo $even_odd?>' id="<?php echo $field->field_name; ?>_field_box">
				<div class='form-display-as-box' id="<?php echo $field->field_name; ?>_display_as_box">
					<?php echo $input_fields[$field->field_name]->display_as?><?php echo ($input_fields[$field->field_name]->required)? "<span class='required'>*</span> " : ""?> :
				</div>
				<div class='form-input-box' id="<?php echo $field->field_name; ?>_input_box">
					<?php echo $input_fields[$field->field_name]->input?>
				</div>
				<div class='clear'></div>
			</div>
		<?php }?>
			<!-- Start of hidden inputs -->
				<?php
					foreach($hidden_fields as $hidden_field){
						echo $hidden_field->input;
					}
				?>
			<!-- End of hidden inputs -->
			<?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
			<div class='line-1px'></div>
			<div id='report-error' class='report-div error'></div>
			<div id='report-success' class='report-div success'></div>
		</div>
		<div class='buttons-box'>
			<div class='form-button-box'>
				<input type='button' value='<?php echo $this->l('form_back_to_list'); ?>' class='ui-input-button back-to-list' id="cancel-button" />
			</div>
			<div class='form-button-box'>
				<input type='button' value='<?php echo $this->l('form_edit'); ?>' class='ui-input-button back-to-list' id="edit-button" />
			</div>
			<div class='clear'></div>
		</div>
	</form>
</div>
</div>
<script>
	var validation_url = '<?php echo $validation_url?>';
	var list_url = '<?php echo $list_url?>';

	var message_alert_edit_form = "<?php echo $this->l('alert_edit_form')?>";
	var message_update_error = "<?php echo $this->l('update_error')?>";
</script>
<script type="text/javascript">
	$(function(){
		$("#edit-button").on('click', function(){
		// var pathname = window.location.pathname; // Returns path only
		var url      = window.location.href;     // Returns full URL or $(location).attr('href')
		var value = url.substring(url.lastIndexOf('/') + 1); // return entry(row) number
		
		var base_url = url.substring(0,url.lastIndexOf('/')-5) + '/edit/';
		window.location = base_url + value;
	});
	});
</script>
<link rel="stylesheet" href="../../../../assets/grocery_crud/texteditor/ckeditor/plugins/spoiler/css/spoiler.css" type="text/css" />

<!--(function(){
src="jquery.min.js"
src="jquery.mobile-1.4.5.min.js"
src="key.js"
   window.onload = function(){
      var URL = "http://www.flysfo.com/api/airlines.json?limit=100&key="
      URL += KEY;

      $.ajax({
         dataType: "json",
         url: URL,
         success: success
      });
   }

   function success(e){
      var result ="";
      $.each(e, function(i,v){
         result += "<p><img src ='http:" + value.image + "'/></p>";
         result += "<p>" + value.phone + "</p>";
         result += value.body;
         result += "<div style = ' border-bottom: 1px solid black;'></div>";
      });
      $('#result').html(result);
})();-->