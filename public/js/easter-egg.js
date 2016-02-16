$( document ).ready(function() {
	
if(QueryS.ref_aff){
$.cookie('__trueh', QueryS.ref_aff, { path: '/'});
}	
//tinyPopup(); 
var logged="";var viewpopup="";
if($.cookie('__tueh')){
logged=$.cookie('__tueh');
}
if($.cookie('__vpup')){
viewpopup=$.cookie('__vpup');
}

if(QueryS.esignup==1){
//alert('forced');
tinyPopup();
}
else if(logged==''){
if(viewpopup==''){

tinyPopup();
}
	
}



});


function tinyPopup(){
var date = new Date();
//set for two hours
date.setTime(date.getTime() + (2*60 * 60 * 1000));
$.cookie('__vpup', '1', { path: '/', expires: date });
TINY.box.show({iframe:popuphref, boxid:'frameless',width:popupwidth,height:popupheight,fixed:true,maskid:'blackmask',maskopacity:40}); return false;

}


var QueryS = function () {
  // This function is anonymous, is executed immediately and 
  // the return value is assigned to QueryString!
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    	// If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = pair[1];
    	// If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]], pair[1] ];
      query_string[pair[0]] = arr;
    	// If third or later entry with this name
    } else {
      query_string[pair[0]].push(pair[1]);
    }
  } 
    return query_string;
} ();