$(document).ready(function($) {
	$('.result_msg,.error_msg').delay(3000).slideUp();
});
function xacNhanXoa(msg){
	if(window.confirm(msg)){
		return true;
	}else{
		return false;
	}
}