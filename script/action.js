function resentOTPCodeButton(){
  var element = document.getElementsByName("resentOTPCode")[0] ;
  element.disabled = true;  
  var timeleft = 30;
  var downloadTimer = setInterval(function(){
    timeleft -= 1;
    element.value = timeleft +" စက္ကန့်စောင့်ပေးပါ";
    if(timeleft <= 0){
      clearInterval(downloadTimer);
      element.value = "ကုဒ် မရရှိပါ ထပ်ပို့ပါ";
      element.disabled = false;
    }
  },1000);
}
// for cart plus minus
function InDe(number,elementId){
  var theElement = document.querySelectorAll("#"+elementId);
  for (var i = 0; i < theElement.length; i++) {
    theElement[i].value=parseInt(theElement[i].value,10)+number;
  }
}
function startUpload(){
    document.getElementById('uploadForm').style.display = 'none';
        document.getElementById('theMessage').innerHTML='uploading...';
    return true;
}

function stopUpload(success,theMessage){
    var result = '';
    if (success == 1){
        document.getElementById('theMessage').innerHTML=theMessage;
    }else {
       document.getElementById('theMessage').innerHTML= '<span>There was an error during file upload!<\/span><br/><br/>';
    }
    return true;   
}

function showHint(theText,where){
  if (theText.length < 3) { 
    document.getElementById(where).innerHTML = "";
    return false;
  }
  else {
    loadBigContent('searchHint='+theText,where);
    return false;
  }
}

// function likeThisItem(id){
//   var hr = new XMLHttpRequest();
//   hr.open("POST", "include.php", true);
//   hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   hr.onreadystatechange = function() {
//       if(hr.readyState == 4 && hr.status == 200) {
//           var return_data = hr.responseText;
//           // document.getElementById("favourite_status_"+id).innerHTML = return_data;
//           var theElement = document.querySelectorAll("#favourite_status_"+id);
//           for (var i = 0; i < theElement.length; i++) {
//             theElement[i].innerHTML = return_data;
//           }
//           loadSmallContent('myFav=count','favCount');
//       }
//       else{
//         document.getElementById("favourite_status"+id).innerHTML = 'bad Connection';
//       }
//   }
               
//   hr.send('fav_on_off_i_id='+id);
// }


function order_confirm(form){
  theName=form.r_name.value;
  thePhone=form.r_phone.value;
  thedeliveryId=form.deliveryId.value;
  theAddress=form.theAddress.value;
    if(thedeliveryId== ''){
        document.getElementById('selectAddressForm').className='show';
    }
    else if(theAddress== ''){
        document.getElementById('selectAddressForm').className='show';
        showAlerm("<pyi>လိပ်စာပြည့်စံုစွာရေးပါ</pyi>");
    }
    else if(theName == ''){
        showAlerm("<pyi>အမည်ရေးပါ</pyi>");
        form.r_name.focus();
    }
    else if (thePhone==''){
        showAlerm("<pyi>ဖုန်းနံပါတ်ရေးသွင်းပါ</pyi>");
        form.r_phone.focus();
    }
    else if(thePhone.search(/^[0-9]{8,14}$/)==-1){
        showAlerm("<pyi>ဖုန်းနံပါတ် အားမှန်ကန်စွာရေးသွင်းပါ</pyi>");
        form.r_phone.focus();
    }
    else{
      var hr = new XMLHttpRequest();
      hr.open("POST", "include.php", true);
      hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
          if (hr.responseText==1) {
            loadSmallContent('ajx=yes&myCart=count','cartCount');
            loadBigContent('ajx=yes&myCart=small_cart','small_cart');
            showNoti('<pyi>အော်ဒါအား လက်ခံရရှိြပီးဖြစ်ပါသည်</pyi>');
            removePopUP();
            topFunction();
          }
          else{
            showNoti(hr.responseText);
          }
        }
        else if(hr.status !== 200 ) {
          showNoti("Bad Connection");
        }
      }           
      hr.send('order_confirm=yes&r_name='+form.r_name.value+'&r_phone='+form.r_phone.value+'&deliveryId='+form.deliveryId.value+'&theAddress='+form.theAddress.value);
    } 
  return false; 
}