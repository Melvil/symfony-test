!function ($)
{
	$(function ()
	{
		"use strict";

		$('.jsBad, .jsGood').click(function()
		{
			var context = $(this).closest('.jsVote');

			if (!context) return false;

			var rating = parseInt($('.jsRating', context).text(), 10);

			if ($(this).hasClass('jsGood')) rating++; else rating--;

			$('.jsGood i, .jsBad i', context).addClass('icon-white').unwrap();

			$.ajax({ url: this.href}).
				done(function()
				{
					$('.jsRating', context).text(rating);
				});

			return false;
		});
	})
}(window.jQuery);