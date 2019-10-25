$(document).ready(function() {
	var h = $(window).height();
	var w = $(window).width();
	$(".content").css({"min-height":h+"px"});
	$("#bg-movie").css({"height":h-100+"px"});
	$(".nav-toggle").click(function() {
		$("#menu ul").slideToggle(400);
	});

	var Ypos = $(window).scrollTop();
	if(w>1120) {
	if(Ypos>100) {
		$("#menu").removeClass('nav-top');
		$("#menu").addClass('nav');
	}
	else {
		$("#menu").removeClass('nav');
		$("#menu").addClass('nav-top');

	}
}
else {
			$("#menu").removeClass('nav-top');
		$("#menu").addClass('nav');
				$("#bg-movie").css({
			"position":"static",
			"transform":"translateY(-75px)"
		});
}
	$(window).scroll(function() {
	var height = $(this).scrollTop();
	if(w>1120) {
	if(height>100) {
		$("#menu").removeClass('nav-top');
		$("#menu").addClass('nav');
	}
	else {
		$("#menu").removeClass('nav');
		$("#menu").addClass('nav-top');
	}

}
else {
			$("#menu").removeClass('nav-top');
		$("#menu").addClass('nav');
				$("#bg-movie").css({
			"position":"static",
			"transform":"translateY(-75px)"
		});
}
		console.log(height);
		if(height>150) {
			$("#menu").addClass('.aya-shadow');
		}

	});
});