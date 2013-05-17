var phonebook = {};
phonebook.results = [

  {name: "Automotive", type:"group"},
  {name: "Bobby Ore", type:"person"},
  {name: "Charlie Sheen", type:"person"},
  {name: "Christopher Columbus", type:"person"},
  {name: "Garden", type:"group"},
  {name: "Home", type:"group"},
  {name: "Lincon O'Cirus", type:"person"},
  {name: "Office", type:"group"},
  {name: "Ryan Webber", type:"person"},
  {name: "Sports", type:"group"},
  {name: "Teddy Rosevelt", type:"person"},
  {name: "Tiger Woods", type:"person"}
];
phonebook.total = phonebook.results.length;




function getContacts(div) {

  //Throws this function into body onload functoion

          $('#dropdown').flexbox(phonebook, {
            resultTemplate: '<div class="col1"><img src="FlexBox/img/{type}.png"/> {name}',
            showArrow: false,
            paging: false,
            maxVisibleRows: 5,
            noResultsText: 'No Contacts Found',
            watermark: 'Enter Recipients',
            onSelect: function(){
              // select code here
            }
          });
}

