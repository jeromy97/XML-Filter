<?php defined('APPNAME') or exit ('Forbidden'); ?>

<!DOCTYPE html>
<html>
<head>
	<title><?= APPNAME ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	
	<form id="filter_form">
		<div class="product-page">
			<div class="filter">
				
				<div>
					<div class="big">Prijs</div>
					<div>
						<label for="min">Min</label>
						<input id="min" type="number" name="min" step="any" value="<?= isset($_GET['min']) ? htmlspecialchars($_GET['min']) : '' ?>">
					</div>
					<div>
						<label for="max">Max</label>
						<input id="max" type="number" name="max" step="any" value="<?= isset($_GET['max']) ? htmlspecialchars($_GET['max']) : '' ?>">
					</div>
				</div>
				
				<?php if (!empty($filterOptions['brand'])): ?>
					<div>
						<div class="big">Merk</div>
						<?php foreach ($filterOptions['brand'] as $brand): ?>
							<div>
								<label>
									<input type="checkbox" name="brand" value="<?= htmlspecialchars($brand) ?>" <?= isset($_GET['brand']) && $_GET['brand'] == $brand ? 'checked' : '' ?>>
									<?= htmlspecialchars($brand) ?>
								</label>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif ?>
				
				<?php if (!empty($filterOptions['product_type'])): ?>
					<div>
						<div class="big">Product type</div>
						<?php foreach ($filterOptions['product_type'] as $product_type): ?>
							<div>
								<label>
									<input type="checkbox" name="product_type" value="<?= htmlspecialchars($product_type) ?>" <?= isset($_GET['product_type']) && $_GET['product_type'] == $product_type ? 'checked' : '' ?>>
									<?= htmlspecialchars($product_type) ?>
								</label>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif ?>
				
				<?php if (!empty($filterOptions['condition'])): ?>
					<div>
						<div class="big">Conditie</div>
						<?php foreach ($filterOptions['condition'] as $condition): ?>
							<div>
								<label>
									<input type="checkbox" name="condition" value="<?= htmlspecialchars($condition) ?>" <?= isset($_GET['condition']) && $_GET['condition'] == $condition ? 'checked' : '' ?>>
									<?= htmlspecialchars($condition) ?>
								</label>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif ?>
				
				<?php if (!empty($filterOptions['availability'])): ?>
					<div>
						<div class="big">Beschikbaarheid</div>
						<?php foreach ($filterOptions['availability'] as $availability): ?>
							<div>
								<label>
									<input type="checkbox" name="availability" value="<?= htmlspecialchars($availability) ?>" <?= isset($_GET['availability']) && $_GET['availability'] == $availability ? 'checked' : '' ?>>
									<?= htmlspecialchars($availability) ?>
								</label>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif ?>
			
				<div>
					<input type="submit" value="Filter" form="filter_form" class="filter-button">
					<input type="submit" value="Reset filter" form="reset_form" class="filter-button">
				</div>
					
			</div>
			<div>
				
				<?php if (!empty($items)): ?>
					
					<p>
						<select id="limit" name="limit">
							<option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5 items</option>
							<option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10 items</option>
							<option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50 items</option>
							<option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100 items</option>
						</select>
						<input type="submit" value="Limiteer">
						<?= count($items) ?> van <?= $count ?> artikelen
					</p>
					
					<p>
						<?php include 'views/pagination.php'; ?>
					</p>
					
					<ul>
						<?php foreach ($items as $item): ?>
							<li>
								<h2><?= htmlspecialchars($item->title) ?></h2>
								<ul>
									<li>Merk: <?= htmlspecialchars(getProperties($item)->brand) ?></li>
									<li>Producttype: <?= htmlspecialchars(getProperties($item)->product_type) ?></li>
									<li>Conditie: <?= htmlspecialchars(getProperties($item)->condition) ?></li>
									<li>Beschikbaarheid: <?= htmlspecialchars(getProperties($item)->availability) ?></li>
									<li>Prijs: <?= htmlspecialchars(formatPrice(getProperties($item)->price)) ?></li>
								</ul>
							</li>
						<?php endforeach ?>
					</ul>
					
					<p>
						<?php include 'views/pagination.php'; ?>
					</p>
				
				<?php else: ?>
					
					<p>Er zijn geen artikelen gevonden.</p>
				
				<?php endif ?>
				
			</div>
		</div>
	</form>
	<form id="reset_form"></form>
	
</body>
</html>