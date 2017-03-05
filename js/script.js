$(document).ready(function(){
    displaydata();
   $("#submit").click(function(){
      var firstname = $('#firstname').val();
      var lastname = $('#lastname').val();
      var city = $('#city').val();
      var dataString = 'firstname='+firstname+'&lastname='+lastname+'&city='+city;
      if(firstname == '' || lastname == '' || city == ''){
          alert('Please fill all the fields');
      }else{
          $.ajax({
             type: "POST",
             url: "ajaxsubmit.php",
             data: dataString,
             success: function(data){
                 displaydata();
             }
          });
      }
   });
   function displaydata(){
       $.ajax({
          type: "POST",
          url: "ajaxdisplay.php",
          success: function(data){
              $('#displaydata').html(data);
              $('#firstname').val('');
              $('#lastname').val('');
              $('#city').val('');
          }
       });
   }
});