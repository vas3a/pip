function schimba_bg_div(image, id) 
{
		var element = document.getElementById(id);
		element.style.backgroundImage = "url("+image+")";
}