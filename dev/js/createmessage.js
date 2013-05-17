function onLoadChooser() {

  //TODO replace 'phonebook' with page that returns contacts

  $('div[rel*=dropdown]').flexbox(phonebook, {
            resultTemplate: '<div class="col1"><img src="img/{type}.png"/> {name}',
            showArrow: false,
            paging: false,
            maxVisibleRows: 5,
            noResultsText: 'No Contacts Found',
            watermark: 'Enter Recipients',
            onSelect: function(){
              // select code here
              document.getElementById("sendlist").value+=this.value+", ";
              this.value="";
            }
  });
}

