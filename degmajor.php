<?php
      
          $value = $_POST['deg'];
          
        if($value == "MS" || $value == 'PHD'){
             $host = "localhost";
        $username = "root";
        $password =  "";
        $database = "universitydb";
        $endl = "\n";
        $query = "SELECT GSpecialization FROM GraduateDegree";
        $connection =  new mysqli($host, $username, $password, $database);
        if($connection->connect_error) {
        die("Connection error: " . $connection->connect_error);    
        }
        $result = $connection->query($query);  
        if($result->num_rows > 0) {
        while($activity = $result->fetch_assoc()) {
           echo "<option>" . $activity['GSpecialization'] . "</option>,";      
           //}
           //echo $activity['extracurricularname'];
           }
         } 
        
        
        $connection->close();   
        }elseif($value == "BS"){
             
                $host = "localhost";
        $username = "root";
        $password =  "";
        $database = "universitydb";
        $endl = "\n";
        $query = "SELECT USpecialization FROM UndergraduateDegree";
        $connection =  new mysqli($host, $username, $password, $database);
        if($connection->connect_error) {
        die("Connection error: " . $connection->connect_error);    
        }
        $result = $connection->query($query);  
        if($result->num_rows > 0) {
        while($activity = $result->fetch_assoc()) {
           echo "<option>" . $activity['USpecialization'] . "</option>,";      
           //}
           //echo $activity['extracurricularname'];
           }
         } 
        
        
        $connection->close();  
                
        }
        
        
        
        
      ?>