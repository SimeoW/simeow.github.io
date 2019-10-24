var width = 1000000;
var body= document.body;
var nav = document.getElementById("toggler");
var gallery = document.getElementById("gallery");
var bingCited = document.getElementById("bingCited");

document.body.onresize=windowResized;
//nav.onchange=navToggled;

windowResized();
navToggled();
fillGallery();

function windowResized(){
	var w=window.innerWidth || window.clientWidth || window.clientWidth;
	if(w<736&&width>=736){
		nav.checked=false;
		navToggled();
	}
	if(w>736&&width<=736){
		nav.checked=true;
		navToggled();
	}
	width=w;
}

function navToggled(){
	nav = document.getElementById("toggler");
	//only animate blur on desktop computers
	if (typeof window.orientation === "undefined"){
		if(nav.checked){
			body.className="blur";
			bingCited.style.opacity="0";
			bingCited.style.padding="0";
		}else{
			body.className="noblur";
			bingCited.style.opacity="1";
			bingCited.style.padding="inherit";
		}
	}
}
function fillGallery(){
	if(gallery!==null){
		for (var i = 0; i < thumbnailImages.length; i++) {
		var thumbnailWrapper = document.createElement("div");
		thumbnailWrapper.className = "thumbnail-wrapper";
		
		var thumbnail = document.createElement("a");
		thumbnail.className = "thumbnail";
		thumbnail.setAttribute('style', 'background-image:url(\"' + thumbnailImages[i] + '\");');
		thumbnail.setAttribute('href', galleryLinks[i]);
		thumbnail.setAttribute('target', '_blank');
		
		thumbnailWrapper.appendChild(thumbnail);
		gallery.appendChild(thumbnailWrapper);
		}
	}
}