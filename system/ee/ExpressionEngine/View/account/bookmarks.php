<?php $this->extend('_templates/default-nav'); ?>
<div class="panel">
<?=form_open($form_url)?>
    <div class="panel-heading">
     <div class="title-bar">
			<h3 class="title-bar__title">
				<?php echo isset($cp_heading) ? $cp_heading : $cp_page_title?></br>
				<i><?=lang('bookmarklet_instructions')?></i>
			</h3>
			<?php if (isset($filters)) echo $filters; ?>
			<div class="title-bar__extra-tools">
				<a class="button button--primary" href="<?=$new?>"><?= lang('create_new') ?></a>
			</div>
		</div>
    </div>

       <?php $this->embed('_shared/table', $table); ?>

       <?php if ( ! empty($pagination)) $this->embed('_shared/pagination', $pagination); ?>

       <?php if ( ! empty($table['data'])): ?>
		<?php $this->embed('ee:_shared/form/bulk-action-bar', [
			'options' => [
				[
					'value' => "",
					'text' => '-- ' . lang('with_selected') . ' --'
				],
				[
					'value' => "remove",
					'text' => lang('delete'),
					'attrs' => ' data-confirm-trigger="selected" rel="modal-confirm-delete"'
				]
			],
			'modal' => true
		]); ?>
       <?php endif; ?>
<?=form_close()?>
</div>

<?php

$modal_vars = array(
	'name'		=> 'modal-confirm-delete',
	'form_url'	=> $form_url,
	'hidden'	=> array(
		'bulk_action'	=> 'remove'
	)
);

$modal = $this->make('ee:_shared/modal_confirm_delete')->render($modal_vars);
ee('CP/Modal')->addModal('delete', $modal);
?>
