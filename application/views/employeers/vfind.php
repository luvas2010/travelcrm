<div class="container findform"><?= form_open(get_currcontroller()."/vfind/go", array('id'=>'find_'.$orid, 'autocomplete'=>'off'))?><?=form_hidden('obj_rid', $orid)?><div class="column span-4">	<h6><?=lang('SEARCH_TITLE')?></h6></div><div class="column span-10 last">	<?=form_label(lang('L_NAME'), 'l_name')?>	<br>	<?=form_input('l_name', element('_employeers.l_name', $search, ''), 'id="l_name" class="text part-5"')?></div><div class="column span-10 last">	<?=form_label(lang('FILIAL'), 'filial_name')?>	<br>	<?=get_filials_vp(element('_filials_rid', $search, null), '_filials_rid', 'filial_name', False)?></div><?= form_close(); ?><div class="column span-24 find-tools">	<input type="button" value="<?=lang('GOFIND')?>" onclick="" class="button" id="find_submit" name="find_submit"> <input type="button" value="<?=lang('GOCLEAR')?>" onclick="" class="button"  id="find_reset" name="find_reset"></div></div><script type="text/javascript">$(document).ready(		function(){			$('#find_submit').click(function(){$('#find_<?=$orid?>').submit();});			$('#find_reset').click(function(){					$('#_filials_rid').val('');					$('#l_name').val('');					$('#filial_name').val('');					$('#find_<?=$orid?>').submit();				});		})	</script>
