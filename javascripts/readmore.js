/* jQuery Expanding Read More - https://codepen.io/mickeykay/pen/vADrw */

jQuery(document).ready(function() {
    var closeHeight = '10em'; /* Default "closed" height */
	var moreText 	= 'Continue Reading'; /* Default "Read More" text */
	var lessText	= 'Collapse'; /* Default "Read Less" text */
	var duration	= '1000'; /* Animation duration */
    var easing = 'linear'; /* Animation easing option */

	// Limit height of .entry-content div
	jQuery('.read-more-content').each(function() {

		// Set data attribute to record original height
		var current = jQuery(this);
		current.data('fullHeight', current.height()).css('height', closeHeight);

		// Insert "Read More" link
		current.after('<a href="javascript:void(0);" class="more-link closed">' + moreText + '</a>');

	});

  // Link functinoality
	var openSlider = function() {
		link = jQuery(this);
		var openHeight = link.prev('.read-more-content').data('fullHeight') + 'px';
		link.prev('.read-more-content').animate({'height': openHeight}, {duration: duration }, easing);
		link.text(lessText).addClass('open').removeClass('closed');
    	link.unbind('click', openSlider);
		link.bind('click', closeSlider);
	}

	var closeSlider = function() {
		link = jQuery(this);
    	link.prev('.read-more-content').animate({'height': closeHeight}, {duration: duration }, easing);
		link.text(moreText).addClass('closed').removeClass('open');
		link.unbind('click');
		link.bind('click', openSlider);
	}

  	// Attach link click functionality
	jQuery('.more-link').bind('click', openSlider);

});
