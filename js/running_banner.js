/*
	to make banner run automatically every 3 seconds
*/

$(function()
{
	setTimeout(function(){
		banner_auto_run()
	},3000);
});

function banner_auto_run()
{
	setInterval(function(){
		$(".rightArrow").trigger("click");
	},3000);
}