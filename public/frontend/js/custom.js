// JavaScript Document



// LEFT COL
$('.catogory-link').click(function(){
	$('.leftcol').toggleClass('opened');
});	



const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))



$('.game-type').click(function() {
	"use strict";
	$('.game-type').removeClass('selected');
	$(this).addClass('selected');
});

$('.court-type').click(function() {
	"use strict";
	$('.court-type').removeClass('selected');
	$(this).addClass('selected');
});

$('.select-level').click(function() {
	"use strict";
	$('.select-level').removeClass('selected');
	$(this).addClass('selected');
});

$('.select-gender').click(function() {
	"use strict";
	$('.select-gender').removeClass('selected');
	$(this).addClass('selected');
});


 $(document).mouseup(function(e)
{
	"use strict";
	var sidemenu1 = $('.filter-main .filter-pane');
	var sidemenu2 = $('.filter-main .nav-link');
	if (!sidemenu1.is(e.target) && sidemenu1.has(e.target).length === 0) 
	{
		if (!sidemenu2.is(e.target) && sidemenu2.has(e.target).length === 0) 
		{
			$('.filter-main .nav-link').removeClass('active');
			$('.filter-main .filter-pane').removeClass('opened');
			$('.filter-main .filter-pane').removeClass('show');
			
		}
	}

}); 