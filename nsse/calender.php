<title>jQuery UI Datepicker - Default functionality</title>
  
 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
       rel = "stylesheet">
 <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
 <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
 
 <div class="container text-center">
  <h2>Jquery - Datepicker Example using jquery ui</h2>
  <strong>Select Date:</strong> <input type="text" id="datepicker" class="">
 </div> 

 <script type="text/javascript">
  $('#datepicker').datepicker({
  dateFormat: 'yy/mm/dd',
   // altField: '#thealtdate',
    //altFormat: 'yy-mm-dd'
  });
 </script>
