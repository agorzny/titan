var data= [
{name:"Sweep Isle 14", assigned: ["Auto"]},
{name:"Move boxes from emergency exit", assigned: ["Ryan Webber"]},
{name:"Total money in regeisters", assigned: ["Auto", "Home", "Garden Center"]},
{name:"Restock basketballs", assigned: ["Tiger Woods"]},
{name:"Empty cashier garbage", assigned: ["Auto", "Home", "Garden Center", "Plumbing"]}
];

function onLoadProject(){
  console.log("TEST");

  var list = document.getElementById("list");
  list.innerHTML="";
  for(var i=0;i<data.length;i++){
    var assgn = "Assigned to: ";
    for(var j=0;j<data[i].assigned.length;j++){
      assgn += data[i].assigned[j];
      if(j<(data[i].assigned.length-1)){
        assgn+=", ";
      }
    }
    var html = '<li><a href="#">'+data[i].name+'<br/><span style="color:white;font-size:12px">'+assgn+'</span></a></li>';
    list.innerHTML+=html;
    $('#list').listview('refresh');
  }


}