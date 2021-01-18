<?php defined('APPNAME') or exit ('Forbidden'); ?>

<ul class="pagination">
	<li>
		<button type="submit" name="page" value="1"><<</button>
	</li>
	<li>
		<button type="submit" name="page" value="<?= $prev = $page - 1 ?>" <?= $prev < 1 ? 'disabled' : '' ?>><</button>
	</li>
	<li>
		<?= $page ?>
	</li>
	<li>
		<button type="submit" name="page" value="<?= $next = $page + 1 ?>" <?= ( $next > $last = ceil( $count / $limit ) ) ? 'disabled' : '' ?>>></button>
	</li>
	<li>
		<button type="submit" name="page" value="<?= $last ?>">>></button>
	</li>
</ul>