<div class="container findform"><?= form_open(get_currcontroller()."/vfind/go", array('id'=>'find_'.$orid, 'autocomplete'=>'off'))?><?=form_hidden('obj_rid', $orid)?><div class="column span-4">	<h6><?=lang('SEARCH_TITLE')?></h6></div><div class="column span-10">	<?=form_label(lang('NUM'), 'num')?>	<br>	<?=form_input('num', element('_dcarts.num', $search, ''), 'id="num" class="text part-3"')?></div><div class="column span-10 last">	<?=form_label(lang('DISCOUNT'), 'discount')?>	<br>	<?=form_input('discount', element('_dcarts.discount', $search, ''), 'id="discount" class="text part"')?></div><?= form_close(); ?><div class="column span-24 last find-tools">	<input type="button" value="<?=lang('GOFIND')?>" onclick="" class="button" id="find_submit" name="find_submit"> <input type="button" value="<?=lang('GOCLEAR')?>" onclick="" class="button"  id="find_reset" name="find_reset"></div></div><script type="text/javascript">$(document).ready(		function(){			$('#find_submit').click(function(){$('#find_<?=$orid?>').submit();});			$('#find_reset').click(function(){					$('#num').val('');					$('#discount').val('');					$('#find_<?=$orid?>').submit();				});		})	</script>
