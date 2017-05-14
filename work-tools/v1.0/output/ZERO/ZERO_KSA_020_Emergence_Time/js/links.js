 $(document).ready(function(){
	
	$('#Main_Container').append('<div style="position: absolute; left: 926px; top: 630px; width: 40px; height: 40px;" id="btnA"></div>')
	
	$('#btnA,#btnB,#btnC,#btnD,#btnE').bind('mousedown',function(e)
	{
		$('#Main_Container').append('<img id="popup"style="position: absolute;z-index:111111;" src="images/popup_'+this.id+'.png" />');
		$('#popup').bind('mousedown', function(e) {
			$("#popup").remove();
		});
	});
});
