/*
	to make text indent when user use icon
*/

$(function(){
	check_link_indent();
});

// CHECK IF LINK USED ICON WHEN PAGE OPENED, IF USE THEN CALL FUNCTION SET_TEXT_INDENT
function check_text_indent()
{
	$(".image_icon_link_btn").each(function(index){
		var len = $(".focuslink-update").eq(index).val().length;
		set_text_indent(len,index);
	});
}

//  SET TEXT INDEX ON PREVIEW
function preview_text_index(len,number_id,selector,status)
{
	if(len <= 16)
	{
		$("#"+selector+"-"+number_id+"").css({'text-indent':'0','font-size':'.9rem'});
	}
	else if(len > 16 && len < 22)
	{
		$("#"+selector+"-"+number_id+"").css({'text-indent':'25px','font-size':'.9rem'});
	}
	else
	{
		if(status == 'new')
		{
			$("#"+selector+"-"+number_id+"").css({'text-indent':'40px','font-size':'12px'});
		}
		else
		{
			$("#"+selector+"-"+number_id+"").css({'text-indent':'50px','font-size':'12px'});
		}
	}
}

//SET TEXT INDENT FOR LINK IF USED ICON
function set_text_indent(len,index)
{
	if(len > 16)
	{
		$(".image_icon_link_btn").eq(index).css({'text-indent':'50px','font-size':'12px'});
	}
	else
	{
		$(".image_icon_link_btn").eq(index).css({'text-indent':'0','font-size':'.9rem'});
	}
}

// CHECK IF LINK ON PAGE LINK IF USED ICON, IF USE THEN CALL FUNCTION SET_TEXT_INDENT
function check_link_indent()
{
	$(".textbutton").each(function(index){
		var len = $(".textbutton").eq(index).attr('data-len');
		var icon = $(".textbutton").eq(index).attr('data-icon');
		if(len > 16 && icon == 1)
		{
		$(".textbutton").eq(index).css({'padding-left':'32px'});
		}
		else
		{
		$(".textbutton").eq(index).css({'padding-left':'0'});
		}
	});
}