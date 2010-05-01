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

<div class="column span-3">	<?=form_label(lang('EMPLOYEER').required_field(), 'emp_name')?></div>
<div class="column span-21 last">
	<?=get_employeers_vp(set_value('_employeers_rid', $ds->_employeers_rid))?>
</div>


<div class="column span-3" style="white-space: nowrap;">
	<?=form_label(lang('USER_LOGIN').required_field(), 'user_login')?>
</div>
<div class="column span-21 last">
	<?=form_input('user_login', set_value('user_login', $ds->user_login), 'id="user_login" class="text part-5"')?>
</div>
<div class="column span-3" style="white-space: nowrap;">
	<?=form_label(lang('USER_PASSWORD').required_field(), 'user_passwd')?>
</div>
<div class="column span-21 last">
	<?=form_password('user_passwd', set_value('user_passwd', $ds->user_passwd), 'id="user_passwd" class="text part-5"')?>
</div>

<div class="column span-3" style="white-space: nowrap;">
	<?=form_label(lang('END_PASSWD_DATE').required_field(), 'edate_passwd')?>
</div>
<div class="column span-21 last">
	<?=form_input('edate_passwd', set_value('edate_passwd', $ds->edate_passwd), 'id="edate_passwd" class="text date-entry "')?>
	<script type="text/javascript">
		$('#edate_passwd').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>
<div class="column span-3" style="white-space: nowrap;">
	<?=form_label(lang('CHANGE_PASSWD_DATE').required_field(), 'chdate_passwd')?>
</div>
<div class="column span-21 last">
	<?=form_input('chdate_passwd', set_value('chdate_passwd', $ds->chdate_passwd), 'id="chdate_passwd" class="text date-entry"')?>
	<script type="text/javascript">
		$('#chdate_passwd').dateEntry({dateFormat: '<?=$this->config->item('crm_date_entry_format')?>', spinnerImage:''});
	</script>
</div>

<div class="column span-3">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-21 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:300px; height: 50px;"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-21 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
