var base = ["message", "task", "event", "project"];
var index = 0;

var confirmed ="";

function addToHash(piece){
  var box = document.getElementById("script");
  box.value=confirmed+ piece;
  document.getElementById("output").value=work;
}

function smartHash(event) {
  var box = document.getElementById("script");
  var key = event.which;
  if(key==38){
    index -=1;
    if(index<0)index = base.length-1;
    box.value+=base[index];
    updateHash();
  }else if(key==40){
    index+=1;
    if(index>=base.length)index = 0;
    box.value+=base[index];
    updateHash();
  }else if(key==13 && work!=""){
    confirmed += box.value.substring(confirmed.length,box.value.length) + " ";
  }else{
    work=box.value.substring(confirmed.length,box.value.length);
  }
}