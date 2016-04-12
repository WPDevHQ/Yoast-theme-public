(function(){if(!/*@cc_on!@*/0)return;var e = "abbr,article,aside,audio,canvas,details,figure,figcaption,footer,header,hgroup,main,mark,menu,meter,nav,output,progress,section,summary,time,video".split(','),i=e.length;while(i--){document.createElement(e[i])}})()

loadCSS('https://fonts.googleapis.com/css?family=Merriweather:300,700,300italic|Open+Sans:400italic,400,300');
loadCSS('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');


document.onreadystatechange = function () {
  if (document.readyState == "complete" && document.querySelector) {
	
	if( testFilter() ) {
		document.querySelector('html').classList.add('supports-filter');
	}

	// Make sure the top banner on the homepage has the right height
	if(document.querySelector('[data-header-home]')) {
		setHomeBannerHeight();	
	}

	initStickyElements();
	initToggle();


	document.addEventListener('click', function() {
		if(document.querySelector('body[data-show-mobile-search]')) {
			document.querySelector('[data-mobile-search] input').focus();
		}
	});
  }
}


function initStickyElements() {

	window.stickyEls = document.querySelectorAll('[data-sticky]');

	// Insert an anchor for margins and determining the sticky state
	for (var i = 0; i < stickyEls.length; i++) {
		stickyEl= stickyEls[i];
		if(stickyEl.hasAttribute('data-sticky-keep')) {
			continue;
		}
		stickyEl.insertAdjacentHTML('beforebegin', '<div data-sticky-anchor></div>');
	}

	if(window.addEventListener) {
		// Initialize
		setStickyElements();

		// And of course do it on scroll
		window.addEventListener('scroll', function() {
			setStickyElements();
		});	

		window.addEventListener('resize', function() {
			setStickyElements(false);
		});	
	}
}

function initToggle() {
	window.toggleEls = document.querySelectorAll('[data-toggle]');

	for (var i = 0; i < window.toggleEls.length; i++) {
		window.toggleEls[i].addEventListener('click', function(event) {
			this.classList.toggle('is-active');

			event.preventDefault();
			toggleElement(this.getAttribute('data-toggle'));
		});
	}
}

(function($) {

	$(document).ready(function() {
		$('.js-random-show-items').each( function() {
			var $this = $(this);
			var items = $this.data('show-items');
			
			for( var i = 0; i < items; i++ ) {
				var $items = $this.find('.js-random-show-item.hidden');
				var index = Math.floor( Math.random() * $items.length );
				$items.eq(index).removeClass('hidden');
			}
		});
	});

})(jQuery);