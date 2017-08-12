<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Bootstrap Stateful Buttons Bug">
<script src="//code.jquery.com/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <title>JS Bin</title>
</head>
<body>
  
<div class="container">
  <h3>Bootstrap Stateful Buttons</h3>
  <p>It appears as though data-loading-text has some built in behavior that is not documented.  Bug or feature?</p>
  
<button type="button" 
        id="myButton1" 
        data-end-text="The End" 
        data-load-text="Loading..."  
        class="btn btn-primary" 
        autocomplete="off">Start</button>
    
<button type="button" 
        id="myButton2" 
        data-end-text="The End" 
        data-loading-text="Loading..."  
        class="btn btn-primary" 
        autocomplete="off">Start</button>
  
</div>
  <script>
    $(function(){
  
  
  $('#myButton1').on("click", function() {
    $('#myButton1').button("load"); 
    setTimeout(function() {
      $('#myButton1').button("end");
      $('#myButton1').attr('disabled', 'disabled');
    }, 1000);
  });
  
  
  $('#myButton2').on("click", function() {
    $('#myButton2').button("loading"); 
    setTimeout(function() {
      $('#myButton2').button("end");
      $('#myButton2').attr('disabled', 'disabled');
    }, 1000);
  });
  
  
});  

  </script>
</body>
</html>