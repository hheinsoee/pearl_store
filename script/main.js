function changeSignForm(hide,show){
  document.getElementById('signForm'+hide).className='hide';
  document.getElementById('signForm'+show).className='show';
}
window.onscroll = function() {

  if (document.body.scrollTop>document.documentElement.scrollTop) {
    var myScrollTop=document.body.scrollTop;
  }
  else{
    var myScrollTop=document.documentElement.scrollTop;
  }
}

function showHidePassword(elementId,eye){
  var thePassword = document.getElementById(elementId);
  var theType = thePassword.getAttribute("type");
  if(theType == 'pw'){
    thePassword.type = 'text';
    eye.className= 'fas fa-eye-slash';
  }
  else{
    thePassword.type = 'pw';
    eye.className= 'fas fa-eye';
  }
}

function autoScroll() {
  if (document.documentElement.scrollTop > window.innerHeight-(window.innerHeight*0.5) && document.documentElement.scrollTop < window.innerHeight + (window.innerHeight*0.5)) {
    myScroll(0,1,'');
  }
}

function myScroll(X,Y,elementId) {
  if (elementId=='') {
    window.scroll({
      top:Y*window.innerHeight - 90,
      left:X*window.innerLeft, 
      behavior: 'smooth'
    });
  }
  else{
    var scrollIt=document.getElementById(elementId);
    scrollIt.scroll({
      top:Y*scrollIt.clientHeight + scrollIt.scrollTop,
      left:X*scrollIt.clientWidth + scrollIt.scrollLeft, 
      behavior: 'smooth'
    });
  }
}

function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (30+o.scrollHeight)+"px";
}

function menu(){
  showAlerm('<center>copyright&copy;<br>Hein&nbsp;Soe<br><a href="tel:+959252152447">call to 0925152447</a></center>');
  return false;
}

function displaySelectedImage(selected,theElementId){
  var myReader = new FileReader();
  myReader.onload= function(event){
    document.getElementById(theElementId).src= event.target.result;
  };
  myReader.readAsDataURL(selected.files[0]);
}


function showHide(button,DocumentId){
    if (document.getElementById(DocumentId).className=="show") {
      var theElement = document.querySelectorAll("#"+DocumentId);
      for (var i = 0; i < theElement.length; i++) {
        theElement[i].className="hide";
        button.className='fas fa-eye-slash';
      }
    }
    else{
      var theElement = document.querySelectorAll("#"+DocumentId);
      for (var i = 0; i < theElement.length; i++) {
        theElement[i].className="show";
        button.className='fas fa-eye';
      }
    }
}

function showNoti(elementData){
   document.getElementById("notiPanel").innerHTML = '<div onclick="hideNoti()"><div id="notiBody" class="p1010">'+elementData+'</div></div>';
}
function hideNoti(){
   document.getElementById("notiPanel").innerHTML= '';
}

function showAlerm(elementData){
  document.getElementById("alermElement").innerHTML = '<div style="position: fixed;height:0;top: 20vh;z-index: 9999;right:0;left:0" class="flex_ce">   <div style="box-shadow:0px 0px 20px rgba(0,0,0,0.5);position:absolute;" class="wbg r " id="siteAlerm" ><div class="p1010">'+elementData+'</div><div class="flex _f1"><button onclick="removeAlerm()">close</button></div></div></div>';
}
function removeAlerm(){
  document.getElementById("alermElement").innerHTML = '';
}
function showPopUpData(goThisUrl){
  document.getElementById("showPopUpLayout").innerHTML = "<div class='pop_up'><div style='position:fixed;right:0;top:0;z-index:9999;'><div style='position:relative;right:0px;top:0px;z-index:9999' onclick='removePopUP()' class='close_ico flex_ce ce fas fa-times'></div></div><div style='height:100vh;overflow:auto;width:100%;'><div id='removePopUPLayer' style='height:100vh;width:100vw;position:fixed;top:0;'  onclick='removePopUP()' ></div><div class='flex_ce ce' style='min-height:60vh;width:100%;' id='PopUpData'></div></div></div>";
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("PopUpData").innerHTML = this.responseText;
    }
    else if(xmlhttp.readyState == 3 || xmlhttp.readyState == 2 || xmlhttp.readyState == 1||xmlhttp.readyState == 0){
      ShowHttpStatus('1','PopUpData');
    }
    else if(xmlhttp.status !== 200){
      ShowHttpStatus('2','PopUpData');
    }
    document.getElementById("bodyLayer").style.filter = 'blur(2px) saturate(0)';
    document.getElementById("theBody").style.overflow = 'hidden';
    // document.documentElement.style.setProperty('--height-1', '0px');
    // document.documentElement.style.setProperty('--height-2', '0px');
  }
  xmlhttp.open("GET", "include.php?"+goThisUrl, true);
  xmlhttp.send();

  history.pushState(null, null, location.href.replace(location.hash,""));
  window.location.hash='popup';
  window.addEventListener("hashchange", function(e) {
    if(e.oldURL.length > e.newURL.length)
      removePopUP();
  });
}
function removePopUP(){
  document.getElementById("showPopUpLayout").innerHTML = "";
  document.getElementById("theBody").style.overflow = 'auto';
  document.getElementById("bodyLayer").style.filter= 'none';
  history.pushState(null, null, location.href.replace(location.hash,""));
  // document.documentElement.style.setProperty('--height-1', '50px');
  // document.documentElement.style.setProperty('--height-2', '30px');
}

function loadSmallContent(GetUrl,DocumentId){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    var theElement = document.querySelectorAll("#"+DocumentId);
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      for (var i = 0; i < theElement.length; i++) {
        theElement[i].innerHTML =  this.responseText;
      }
    }
    else {
      for (var i = 0; i < theElement.length; i++) {
        theElement[i].innerHTML = '';
      }
    }
  }
  xmlhttp.open("GET", "include.php?"+GetUrl, true);
  xmlhttp.send();
}
function loadBigContent(goThisUrl,elementId){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var theElement = document.querySelectorAll("#"+elementId);
      for (var i = 0; i < theElement.length; i++) {
        theElement[i].innerHTML =  this.responseText;
      }
    }
    else if(xmlhttp.readyState == 3 || xmlhttp.readyState == 2 || xmlhttp.readyState == 1||xmlhttp.readyState == 0){
      ShowHttpStatus('1',elementId);
    }
    else if(xmlhttp.status !== 200){
      ShowHttpStatus('2',elementId);
    }
  }
  xmlhttp.open("GET", "include.php?"+goThisUrl, true);
  xmlhttp.send();
}

function insertContent(goThisUrl,elementId,where){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById(elementId).insertAdjacentHTML(where,this.responseText);
    }
  }
  xmlhttp.open("GET", "include.php?"+goThisUrl, true);
  xmlhttp.send();
}

function ShowHttpStatus(Status,elementId){
  if (Status=='1'){
    document.getElementById(elementId).innerHTML ="<center style='padding:0px 10px;'>...Loading...</center>";
  }
  else if(Status=='2') {
    document.getElementById(elementId).innerHTML ="<center style='padding:20px 50px;' class='bg_blr gbg r p1010 shadow_l'><span class='fas fa-exclamation-triangle'>&nbsp;</span>ချိတ်ဆက်မှုအခြေအနေမကောင်းပါ။</center>";
  }
}

function plusDivs(n) {
  showDivs(slideIndex += n);
  clearInterval(autoClick);
}
function gothisDiv(n){
  showDivs(slideIndex=n+1);
  clearInterval(autoClick);
}
function autoPlus(n) {
  showDivs(slideIndex += n);
}

function startSlide(){
  var slideIndex = 0;
  showDivs(slideIndex);
  autoClick = setInterval(function(){autoPlus(1);},7000);
}

function showDivs(n) {
  var i;
  var x = document.querySelectorAll("#slide");
  // var inDi=document.querySelectorAll("#inticator");

  if (n > x.length) {
    slideIndex = 1
  }    
  if (n < 1) {
    slideIndex = x.length
  }

  for (i = 0; i < x.length; i++) {
     x[i].style.opacity = "0";
     x[i].style.zIndex = "-1";
  }
  // for (i = 0; i < inDi.length; i++) {
  //    inDi[i].style.opacity = "0.6";
  //   inDi[i].style.border = "1pt solid #fff";
  //   inDi[i].setAttribute('onclick',' gothisDiv('+i+')');
  // }


  x[slideIndex-1].style.opacity = "1";
  x[slideIndex-1].style.zIndex= "1";
  // inDi[slideIndex-1].style.opacity = "1";
  // inDi[slideIndex-1].style.border = "1pt solid #09f";
}
/*element slider end*/



// thingsInPackageSlider start

// thingsInPackageSliderEnd