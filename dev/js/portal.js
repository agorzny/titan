function  createTask(){
  var data = {};
  var contacts = getSelectedContacts();
  data.title = document.getElementById("eventTitle").value;
  data.date = document.getElementById("taskWhen").value;
  data.description = document.getElementById("message").value;
  data.contacts = contacts;
  var d = JSON.stringfy(data);
  $.ajax({
            url: 'http://crypticcode.ca/cti/dev/ct_createTask.php',
            data: d,
            method: 'GET',
            success: function(data) {
              window.location="ct_createTask.php";
              console.log("success");
            }

  });
}