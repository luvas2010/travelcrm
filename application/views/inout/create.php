<div class="grid fieldscontainer"><h3><?=$title?></h3><?= form_open(get_currcontroller()."/create/go", array('id'=>'create_'.$orid, 'autocomplete'=>'off'))?><div class="container editform"><?if(validation_errors()){?><div class="error">	<?=validation_errors('<div>', '</div>');?></div>	<?}?><?if($success===False){?><div class="error">	<?=lang('SAVE_SYSTEM_ERROR')?></div><?}?><?if($success===True){?><div class="success">	<?=lang('SAVE_SYSTEM_SUCCESS')?></div><?}?><fieldset>	<legend><?=lang('DOCUMENT')?></legend>	<div class="column span-3">		<?=form_label(lang('DATE_DOC').required_field(), 'date_doc')?>	</div>	<div class="column span-21 last">		<?=form_input('date_doc', date_conv(set_value('date_doc', date('Y-m-d'))), 'id="date_doc" class="text date-entry"')?>		<script type="text/javascript">			$('#date_doc').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});		</script>	</div>	</fieldset><div class="column span-3">	<?=form_label(lang('ARCHIVE'), 'archive')?></div><div class="column span-21 last">	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', ''), 'id="archive" class="text" ')?></div><div class="column span-3">	<?=form_label(lang('DESCR'), 'descr')?></div><div class="column span-21 last">	<?=form_textarea('descr', set_value('descr', ''), 'id="descr" class="text" style="width:200px; height: 50px;"')?></div></div>
<div class="column span-24 last controls">	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset"></div><?= form_close(); ?></div>