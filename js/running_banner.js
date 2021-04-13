/*
	to make banner run automatically every 3 seconds
*/

var secs = 5000;

$(function()
{
	setTimeout(function(){
		banner_auto_run()
	},secs);
});

function banner_auto_run()
{
	setInterval(function(){
		$(".rightArrow").trigger("click");
	},secs);
}