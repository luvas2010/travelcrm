<div class="grid fieldscontainer">
<script src="<?=base_url()?>public/js/jquery.timeentry.package-1.4.6/jquery.timeentry.min.js" type="text/javascript"></script>
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

<fieldset>
	<legend><?=lang('DOCUMENT')?></legend>
	<div class="column span-4">
		<?=form_label('Id', 'rid')?>
	</div>
	<div class="column span-4">
		<?=form_input('rid', set_value('rid', $ds->rid), 'id="rid" class="text" readonly="readonly" style="width:90px;"')?>
	</div>
	<div class="column span-4">
		<?=form_label(lang('DATE_DOC').required_field(), 'date_doc')?> 
	</div>
	<div class="column span-4">
		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" class="text" readonly="readonly" style="width:90px;"')?>
		<script type="text/javascript">
			$('#date_doc').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
		</script>
	</div>	

	<div class="column span-4">
		<?=form_label(lang('TIME_DOC').required_field(), 'time_doc')?> 
	</div>
	<div class="column span-4 last">
		<?=form_input('time_doc', date_conv(set_value('time_doc', $ds->date_doc), True), 'id="time_doc" class="text" readonly="readonly" style="width:45px;"')?>
		<script type="text/javascript">
			$('#time_doc').timeEntry({show24Hours: true, spinnerImage:''});
		</script>
	</div>	
		
</fieldset>


<div class="column span-4">
	<?=form_label(lang('ADVERTISE_SHORT').required_field(), 'source_name')?> 
</div>
<div class="column span-20 last">
	<?=get_advertisessources_vp(set_value('_advertisessources_rid', $ds->_advertisessources_rid))?>
</div>

<div class="column span-4">
	<?=form_label(lang('L_NAME'), 'l_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('l_name', set_value('l_name', $ds->l_name), 'id="l_name" class="text part-5"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('F_NAME').get_field_help('aircalls', 'CLIENT'), 'f_name')?> 
</div>
<div class="column span-20 last">
	<?=form_input('f_name', set_value('f_name', $ds->f_name), 'id="f_name" class="text part-5"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('S_NAME'), 's_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('s_name', set_value('s_name', $ds->s_name), 'id="s_name" class="text part-5"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('CLIENT').get_field_help('aircalls', 'CLIENT'), '_clients_rid')?>
</div>
<div class="column span-20 last">
	<?=get_clients_vp(set_value('_clients_rid', $ds->_clients_rid))?>
</div>

<div class="column span-4">
	<?=form_label(lang('PHONES').required_field(), 'phones')?> 
</div>
<div class="column span-20 last">
	<?=form_input('phones', set_value('phones', $ds->phones), 'id="phones" class="text part-5"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('EMAIL'), 'email')?>
</div>
<div class="column span-20 last">
	<?=form_input('email', set_value('email', $ds->email), 'id="email" class="text part-5"')?>
</div>


<fieldset>
<legend><?=lang('AIR_DETAILS')?></legend>
<div class="column span-4">
	<?=form_label(lang('COUNTRY').required_field(), '_countries_rid')?> 
</div>
<div class="column span-8">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('AIRCLASS').required_field(), 'air_class')?> 
</div>
<div class="column span-8 last">
	<?=form_dropdown('air_class', get_airclasses(), set_value('air_class', $ds->air_class), 'id="air_class" class="text"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DATE_FROM').required_field(), 'date_from')?> 
</div>
<div class="column span-8">
	<?=form_input('date_from', date_conv(set_value('date_from', $ds->date_from)), 'id="date_from" class="text date-entry"')?>
	<script type="text/javascript">
		$('#date_from').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>	
<div class="column span-4">
	<?=form_label(lang('DATE_TO').required_field(), 'date_to')?> 
</div>
<div class="column span-8 last">
	<?=form_input('date_to', date_conv(set_value('date_to', $ds->date_to)), 'id="date_to" class="text date-entry"')?>
	<script type="text/javascript">
		$('#date_to').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>

<div class="column span-4">
	<?=form_label(lang('SUM_TO').required_field(), 'sum_wanted_to')?> 
</div>
<div class="column span-8">
	<?=form_input('sum_wanted_to', set_value('sum_wanted_to', $ds->sum_wanted_to), 'id="sum_wanted_to" class="text part-2"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('CURRENCY').required_field(), '_currencies_rid')?> 
</div>
<div class="column span-8 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('TOURISTS_QUAN').required_field(), 'tourists_quan')?> 
</div>
<div class="column span-20 last">
	<?=form_input('tourists_quan', set_value('tourists_quan', $ds->tourists_quan), 'id="tourists_quan" class="text part"')?>
</div>

</fieldset>


<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>
</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
