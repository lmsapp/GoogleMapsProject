<?php
  $con = new mysqli("localhost","root","root","project 2");
  if ($con->connect_error)
  {
      echo "Failed to connect to MySQL: " . $con->connect_error;
  }
?>

<html>
<head>
<title></title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyB8oC-MxNvVSbf6rsBSnNVh1pbMjT2tuno"></script>
<script type="text/javascript" src="gmaps.js"></script>

<script type="text/javascript">

   $(document).ready(function(){
        map = new GMaps({
        div: '#coding_map',
        lat: 34.3,
        lng: -118.14,
        zoom:3,
      });



      $('#geocoding_form').submit(function(e){
        e.preventDefault();

    //  alert(total_num);

     // var total = <?php $total= 3; echo(json_encode($total)); ?>;

     <?php

     $total = 3;

  //   $addrs = array();

  //   $addrs[0] = "350 5th Ave, New York, NY 10118";               // these address values should come from user or database, I hardcoded here for test purpose

  //   $addrs[1] = "Golden Gate Bridge, San Francisco, CA 94129";

  //   $addrs[2] = "1500 N. Patterson St. Valdosta, Georgia 31698";


     for ($id =0;  $id< $total; $id++)

     {


        echo "\n\n";

       echo "var s ="."\"#\""." + ".$id.";\n";


    //  alert(addrs[id]);


        echo "GMaps.geocode({\n";
          echo "address: $(s).val().trim(),\n";
          echo "callback: function(results, status){\n";
            echo "if(status=='OK'){\n";
              echo "var latlng = results[0].geometry.location;\n";

               echo "map.addMarker({\n";
               echo "lat: latlng.lat(),\n";
               echo "lng: latlng.lng(),\n";
               echo "title: "."\""."address ".$id."\",\n";


               echo "infoWindow: {\n";

               echo "content: '<p>lat: ' + latlng.lat() + '</p><p>lng: ' + latlng.lng() + '</p>' }\n";


              echo "});\n";


            echo "}\n";
          echo "}\n";
        echo "});\n";



        echo "\n\n";


     } // end of "for" loop in php


    ?>   // end of php




      });


 });



 </script>



</head>
<body>

 <p></p>

<form method="post" id="geocoding_form">
            <p>Address 1:<input type="text" id="0" name="address 0" value="" /><br></p>
            <p>Address 2:<input type="text" id="1" name="address 1" value="" /><br></p>
            <p>Address 3:<input type="text" id="2" name="address 2" value="" /><br></p>
            <p>Description:</p>
			      <textarea name="description" cols="54" rows="5"></textarea>
            <br>
            <br>
            <input type="submit" name="Submit" value="Submit" />
</form>

      <div id="coding_map" style="width: 600px; height: 400px"></div>

      <?php
        if(isset($_POST["Submit"]))
        {
            $Address = $_POST["Address"];
            $Latitude = $_POST["Latitude"];
            $Longitude = $_POST["Longitude"];
            $Description = $_POST["Description"];

            $sql = "INSERT INTO address (Address,Latitude,Longitude,Description) VALUES ('$Address','$Latitude','$Longitude','$Description')";
            unset($_POST);

            if ($con->query($sql) == false)
            {
                echo $con->error."<br>";
            }
            else
            {
              echo 'all good'."<br>";
            }
          }
   ?>






</body>
</html>
