
function ZoomInOut(imageId,event,viewerId){
  var image= document.getElementById(imageId);
  var viewer = document.getElementById(viewerId);


  image.addEventListener("mousemove", function(event){
    myZoomIn(event,event.clientX,event.clientY);
  },false);
  image.addEventListener("touchmove",  function(event){
    myZoomIn(event,event.touches[0].clientX,event.touches[0].clientY);
    document.getElementById("theBody").style.overflow= 'hidden';
  },false);

  image.addEventListener("mouseleave",  function(event){
    myZoomOut(image,'viewer');
  },false);
  image.addEventListener("touchend",  function(event){
    myZoomOut(image,'viewer');
    document.getElementById("theBody").style.overflow= 'auto';
  },false);
  
  

  function myZoomIn(event,theX,theY){
    var rect = image.getBoundingClientRect();
    var x = theX - rect.left; //x position within the element.
    var y = theY - rect.top;

    var iW=image.offsetWidth;
    var iH=image.offsetHeight;

    var vW=viewer.offsetWidth;
    var vH=viewer.offsetHeight;

    var ratioX =( x * 100 / iW).toFixed(0)+'%';
    var ratioY =( y * 100 / iH).toFixed(0)+'%';

  
    image.style.opacity=0;
    viewer.style.padding="50px";
    viewer.style.width=iW - 100 +'px';
    viewer.style.height=iH - 100 +'px';
    viewer.style.backgroundImage = "url("+ image.src+")";
    viewer.style.backgroundSize= iW*2+'px ';//+iH*2+'px';
    viewer.style.backgroundPosition = ratioX +' '+ratioY;
  }


  function myZoomOut(image,viewerId){
      var iW=image.offsetWidth;
      var iH=image.offsetHeight;
      var viewer = document.getElementById(viewerId);

      viewer.style.padding="0px";
      viewer.style.backgroundSize= iW+'px '+iH+'px';
      image.style.opacity='1';
      viewer.style.backgroundImage = "";
  }
}

