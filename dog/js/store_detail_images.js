$(window).load(function(){
	$('.waku img').MyThumbnail(
	{
		'thumbWidth' :200,
		'thumbHeight' :200,
	});

	$('.user_joho img').MyThumbnail(
	{
		'thumbWidth' :100,
		'thumbHeight' :100,
		'imageDivClass' :'myPic'
	});
});
