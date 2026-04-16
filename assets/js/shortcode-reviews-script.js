(function ($) {
	// Loop through all sliders
	$(".wpmsat-reviews-slider").each(function () {
		var container = $(this),
			track = container.find(".wpmsat-reviews"),
			items = container.find(".wpmsat-review"),
			nextBtn = container.find(".wpmsat-reviews-next"),
			prevBtn = container.find(".wpmsat-reviews-prev");

		if (track.length === 0 || items.length === 0) return;

		var index = 0;

		// get slides per view
		var perView = parseInt(container.data("slides-per-view")) || 1;

		var total = items.length;

		// prevent empty slides
		var maxIndex = Math.max(0, total - perView);

		function updateSlider() {
			var movePercent = 100 / perView;
			track.css("transform", "translateX(-" + index * movePercent + "%)");
		}

		// Move to next slide on next button
		nextBtn.on("click", function () {
			index++;

			if (index > maxIndex) {
				index = 0;
			}

			updateSlider();
		});

		// Move to previous slide on previous button
		prevBtn.on("click", function () {
			index--;

			if (index < 0) {
				index = maxIndex;
			}

			updateSlider();
		});
	});
})(jQuery);
