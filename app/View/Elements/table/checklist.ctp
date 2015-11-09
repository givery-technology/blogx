<thead>
	<tr role="row">
		<th class='tbl0'><?php echo __('Id'); ?></th>
		<th class='tbl2'><?php echo __('Keyword'); ?></th>
		<th class='tbl2'><?php echo __('Link'); ?></th>
		<th class='tbl0'><?php echo __('Type'); ?></th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo __('Keyword in Url'); ?>" data-original-title="<?php echo __('Keyword / Url'); ?>">
			<?php echo __('1'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo __('Title started with Keyword'); ?>" data-original-title="<?php echo __('Title'); ?>">
			<?php echo __('2'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo __('Meta Keyword started with Keyword'); ?>" data-original-title="<?php echo __('Meta Keyword'); ?>">
			<?php echo __('3'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo __('Meta Description started with Keyword'); ?>" data-original-title="<?php echo __('Meta Description'); ?>">
			<?php echo __('4'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo  __('H1 Tag started with Keyword'); ?>" data-original-title="<?php echo __('H1 Tag'); ?>">
			<?php echo __('5'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo  __('Keyword Density in Source'); ?>" data-original-title="<?php echo __('Keyword Density'); ?>">
			<?php echo __('6'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo  __('Character of all density keyword divide character of contents'); ?>" data-original-title="<?php echo __('Keyword Frequency'); ?>">
			<?php echo __('7'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo  __('All outlink set'); ?>" data-original-title="<?php echo __('Link Set'); ?>">
			<?php echo __('8'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo  __('Page is redirecting or not?'); ?>" data-original-title="<?php echo __('Redirect'); ?>">
			<?php echo __('9'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover" data-content="<?php echo  __('The Canonical tag is put on page or not?'); ?>" data-original-title="<?php echo __('Canonical'); ?>">
			<?php echo __('10'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover_left" data-content="<?php echo  __('Unique Title within the same domain'); ?>" data-original-title="<?php echo __('Unique Title'); ?>">
			<?php echo __('11'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover_left" data-content="<?php echo  __('Unique Meta Keyword within the same domain'); ?>" data-original-title="<?php echo __('Unique Meta Keyword'); ?>">
			<?php echo __('12'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<a href="#" rel="popover_left" data-content="<?php echo  __('Unique Meta Description within the same domain'); ?>" data-original-title="<?php echo __('Unique Meta Description'); ?>">
			<?php echo __('13'); ?>
			</a>
		</th>
		<th class='tbl0'>
			<?php echo __('Actions'); ?>
		</th>
	</tr>
</thead>

<script type="text/javascript">
	$(document).ready(function() {
		// popover
		$("a[rel=popover]").popover().click(function(e) {
			e.preventDefault()
		})
		
		// popover
		$("a[rel=popover_left]").popover({placement:'left'}).click(function(e) {
			e.preventDefault()
		})
	})
</script>