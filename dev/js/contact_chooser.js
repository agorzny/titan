var phonebook = {};
phonebook.results = [

  {index: 0, name: "Automotive", type:"group"},
  {index: 1, name: "Bobby Ore", type:"person"},
  {index: 2, name: "Charlie Sheen", type:"person"},
  {index: 3, name: "Christopher Columbus", type:"person"},
  {index: 4, name: "Garden", type:"group"},
  {index: 5, name: "Home", type:"group"},
  {index: 6, name: "Lincon O'Cirus", type:"person"},
  {index: 7, name: "Office", type:"group"},
  {index: 8, name: "Ryan Webber", type:"person"},
  {index: 9, name: "Sports", type:"group"},
  {index: 10, name: "Teddy Rosevelt", type:"person"},
  {index: 11, name: "Tiger Woods", type:"person"}
];
phonebook.total = phonebook.results.length;

var selected=[];
var div="";

function loadContacts(){
  reset();
  $.ajax({
            url: 'http://crypticcode.ca/cti/dev/ct_getContacts.php',
            success: function(data) {
                var d = JSON.parse(data);
                for(var i=0;i<d.length;i++){
                  d[i].index = i;
                }
                phonebook.results = d;
                phonebook.total = phonebook.results.length;
            }
  });
}




function getContacts(seldiv) {

  div=seldiv;
  //Throws this function into body onload functoion
      var cc = document.getElementById(div);
      cc.innerHTML="";

          $('#dropdown').flexbox(phonebook, {
            resultTemplate: '<div class="col1"><img src="js/FlexBox/img/{type}.png"/> {name}',
            showArrow: false,
            paging: false,
            hiddenValue: "index",
            maxVisibleRows: 5,
            noResultsText: 'No Contacts Found',
            watermark: 'Name or Department',
            onSelect: function(){

              var item = $('input[name=dropdown]').val();
              selected.push(phonebook.results[item]);
              this.value="";
              showContacts();
            }
          });
}

function showContacts(){
  var contacts = document.getElementById(div);
  contacts.innerHTML="";
  for(var i=0;i<selected.length;i++){
    var button = document.createElement("input");
    button.setAttribute("type","button");
    button.className="remove";
    button.value="X";
    button.alt=i;
    button.id="remove"+i;
    var cur = document.createElement("div");
    cur.className="contactBubble";
    cur.innerHTML='<span class="contactText">'+selected[i].name+'</span>';
    cur.appendChild(button)
    contacts.appendChild(cur);
    button.onclick = function(){
      var j = this.alt;
      console.log("ID: "+j);
      selected.splice(j,1);
      showContacts();
    };
    var str = JSON.stringify(selected);
    document.getElementById("data").value=str;
  }
}

function getSelectedContacts(){
  return selected;
}
 function reset(){
   selected=[];
   showContacts();
 }


