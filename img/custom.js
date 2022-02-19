$(document).ready(function() {
$(".answer").hide();
$('.question.active').addClass('active').next().show();
$(".question").click(function() {
$(this).toggleClass("active").next().slideToggle("fast");
return false;
});
});