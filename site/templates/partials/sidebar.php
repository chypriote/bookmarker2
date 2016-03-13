<aside class="sidebar">
	<header class="sidebar--logo">
		<div class="logo--title">Bookmarker <span>2</span></div>
		<span class="logo--subtitle">A massive database of things</span>
	</header>
	<div class="sidebar--nav">
		<nav class="sidebar--category" id="categories-selector">
			<?php foreach ($categories as $id => $category) { ?>
				<a
					class="category-selector"
					data-category="<?= $id; ?>"
					data-filter=".<?= $category->slug; ?>">
					<i class="fa fa-<?= $category->icon; ?>"></i>
					<?= $category->name; ?>
				</a>
			<?php } ?>
		</nav>
		<nav class="sidebar--tag" id="tags-selector">
			<?php foreach ($categories as $id => $category) { ?>
				<a
					class="tag-selector <?= $category->slug; ?>"
					href="#!/<?= $category->slug; ?>/everything/"
					data-tag="-1"
					data-category="<?= $id; ?>"
					>
					everything
					<span><?= $category->count; ?></span>
				</a>
				<?php }
				foreach ($tags as $id => $tag) { ?>
				<a
					class="tag-selector <?= $tag->category->slug; ?>"
					href="#!/<?= $tag->category->slug; ?>/<?= $tag->slug; ?>/"
					data-tag="<?php $id; ?>"
					data-category="<?= $tag->category->id; ?>"
					>
					<?= strtolower($tag->name); ?>
					<span><?= $tag->count; ?></span>
				</a>
			<?php } ?>
		</nav>
	</div>
	<footer class="sidebar--footer">
		by <a href="cv.chypriote.me">ChypRiotE</a>
	</footer>
</aside>
