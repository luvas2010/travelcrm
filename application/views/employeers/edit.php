<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/edit/{$rid}", array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
<?=form_hidden('rid', $rid)?>
<?if(validation_errors()){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>
<?if($success===False){?>
<div class="error">
	<?=lang('SAVE_SYSTEM_ERROR')?>
</div>
<?}?>
<?if($success===True){?>
<div class="success">
	<?=lang('SAVE_SYSTEM_SUCCESS')?>
</div>
<?}?>
<div class="column span-4">	<?=form_label(lang('F_NAME').required_field(), 'f_name')?></div><div class="column span-8">	<?=form_input('f_name', set_value('f_name', $ds->f_name), 'id="f_name" class="text part-5"')?></div><div class="column span-4">	<?=form_label(lang('F_NAME_LAT').required_field(), 'f_name_lat')?></div><div class="column span-8 lat">	<?=form_input('f_name_lat', set_value('f_name_lat', $ds->f_name_lat), 'id="f_name_lat" class="text part-5"')?></div><div class="column span-4">	<?=form_label(lang('S_NAME').required_field(), 's_name')?></div><div class="column span-8">	<?=form_input('s_name', set_value('s_name', $ds->s_name), 'id="s_name" class="text part-5"')?></div><div class="column span-4">	<?=form_label(lang('L_NAME_LAT').required_field(), 'l_name_lat')?></div><div class="column span-8 last">	<?=form_input('l_name_lat', set_value('l_name_lat', $ds->l_name_lat), 'id="l_name_lat" class="text part-5"')?></div><div class="column span-4">	<?=form_label(lang('L_NAME').required_field(), 'l_name')?></div><div class="column span-20 last">	<?=form_input('l_name', set_value('l_name', $ds->l_name), 'id="l_name" class="text part-5"')?></div><div class="column span-4">	<?=form_label(lang('BIRTHDAY').required_field(), 'birthday')?></div><div class="column span-20 last">	<?=form_input('birthday', set_value('birthday', $ds->birthday), 'id="birthday" class="text date-entry"')?>	<script type="text/javascript">		$('#birthday').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});	</script></div><div class="column span-4">	<?=form_label(lang('BDATE').required_field(), 'bdate')?></div><div class="column span-20 last">	<?=form_input('bdate', set_value('bdate', $ds->bdate), 'id="bdate" class="text date-entry"')?>	<script type="text/javascript">
		$('#bdate').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});	</script></div><div class="column span-4">	<?=form_label(lang('EDATE'), 'edate')?></div><div class="column span-20 last">	<?=form_input('edate', set_value('edate', $ds->edate), 'id="edate" class="text date-entry"')?>	<script type="text/javascript">
		$('#edate').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});	</script></div><div class="column span-4">	<?=form_label(lang('NAL_NUM'), 'nal_number')?></div><div class="column span-20">	<?=form_input('nal_number', set_value('nal_number', $ds->nal_number), 'id="nal_number" class="text part-2"')?></div><fieldset><legend><?=lang('CITIZEN_PASSPORT')?></legend><div class="column span-4">	<?=form_label(lang('PASSP_SERIA').required_field(), 'passp_seria')?></div><div class="column span-8">	<?=form_input('passp_seria', set_value('passp_seria', $ds->passp_seria), 'id="passp_seria" class="text part"')?></div><div class="column span-4">	<?=form_label(lang('PASSP_NUM').required_field(), 'passp_num')?></div><div class="column span-8 last">	<?=form_input('passp_num', set_value('passp_num', $ds->passp_num), 'id="passp_num" class="text part-2"')?></div></fieldset><fieldset><legend><?=lang('FOREIGN_PASSPORT')?></legend><div class="column span-4">	<?=form_label(lang('FPASSP_SERIA'), 'fpassp_seria')?></div><div class="column span-8">	<?=form_input('fpassp_seria', set_value('fpassp_seria', $ds->fpassp_seria), 'id="fpassp_seria" class="text part"')?></div><div class="column span-4">	<?=form_label(lang('FPASSP_NUM'), 'fpassp_num')?></div><div class="column span-8 last">	<?=form_input('fpassp_num', set_value('fpassp_num', $ds->fpassp_num), 'id="fpassp_num" class="text part-2"')?></div></fieldset><div class="column span-4">	<?=form_label(lang('EMAIL').required_field(), 'email')?></div><div class="column span-20 last">	<?=form_input('email', set_value('email', $ds->email), 'id="email" class="text part-5" ')?></div>


<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-8">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" ')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
