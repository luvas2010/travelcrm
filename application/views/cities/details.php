<div class="grid fieldscontainer">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">
	<?=form_label(lang('COUNTRY'), '_countries_rid')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" class="text part-5" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('NAME'), 'city_name')?>
</div>
<div class="column span-20 last">
	<?=form_input('city_name', set_value('city_name', $ds->city_name), 'id="city_name" class="text part-5" readonly="readonly"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('NAME_LAT'), 'city_name_lat')?>
</div>
<div class="column span-20 last">
	<?=form_input('city_name_lat', set_value('city_name_lat', $ds->city_name_lat), 'id="city_name_lat" class="text part-5" readonly="readonly"')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-20 last">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-20 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly="readonly"')?>
</div>

</div>
<div class="column span-24 last controls">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller()) ?>';" id="reset" name="reset">
</div>

</div>