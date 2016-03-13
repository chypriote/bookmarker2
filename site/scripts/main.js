var count = 0;

$('#tags-selector').mixItUp({
	animation: {
		effects: 'translateY fade'
	},
	load: {
		filter: '.web'
	},
	selectors: {
		target: '.tag-selector',
		filter: '.category-selector'
	},
	layout: {
		display: 'block'
	}
})
