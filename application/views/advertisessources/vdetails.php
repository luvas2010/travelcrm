<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">	<?=form_label(lang('SOURCE'), 'source_name')?></div><div class="column span-20 last">	<?=form_input('source_name', set_value('source_name', $ds->source_name), 'id="source_name" class="text part-5" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('TYPE'), '_advertisestypes_rid')?></div><div class="column span-20 last">	<?=form_dropdown('_advertisestypes_rid', get_advertisestypes_list(), set_value('_advertisestypes_rid', $ds->_advertisestypes_rid), 'id="_advertisestypes_rid" class="text" readonly="readonly"')?></div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly="readonly"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:200px; height: 50px;"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/vjournal/go/') ?>';" id="reset" name="reset">
	<button onclick="joinToParent('<?=$ds->$jtp['val']?>', '<?=$ds->$jtp['scr']?>')" class="button"><?=lang('SELECT')?></button>
</div>

</div>
<script type="text/javascript">
function joinToParent(val, scr){
	$("input[name='<?=$jtp['val_p']?>']", window.opener.document).val(val);
	$('#<?=$jtp['scr_p']?>', window.opener.document).val(scr);
	this.close();
	return;
}	
</script>