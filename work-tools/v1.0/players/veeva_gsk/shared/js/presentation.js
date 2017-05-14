// --- presentation.js --- //
// --- CUSTOM TO THIS PRESENTATION --- //
$( document ).ready(function() {
	    
	// --- SET TEXT ON HOME PAGE BUTTON --- //
	if (window.sessionStorage.getItem('mtgskAnimations') === '1'){
		$('#setAnimations').text("Animations are On");
	} else {
		$('#setAnimations').text("Animations are Off");
	}
	
	$('#setAnimations').bind(myevent, function() {	
		if (window.sessionStorage.getItem('mtgskAnimations') === '1') {
			window.sessionStorage.setItem('mtgskAnimations', '0');
			$('#setAnimations').text("Animations are Off");
		} else {
			window.sessionStorage.setItem('mtgskAnimations', '1');
			$('#setAnimations').text("Animations are On");
		}
	});
	
});