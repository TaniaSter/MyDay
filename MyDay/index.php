<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html>
<head>  
<meta charset="utf-8">
<title>MYDAYapp</title>  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="scripts/main.js"></script>
<link type="text/css" rel="stylesheet" href="style.css" /> 
<link rel="stylesheet" type="text/css" media="all" href="styles/animate.css"> 
<link rel="stylesheet" type="text/css" href="styles/stylesheet.css">
</head> 
<body>
<?php
    session_start();  
    function loginForm(){  
        echo' 
        <div id="loginform"  class="animated flipInY"> 
		<h2> WELCOME TO MYDAY WORK AND LEISURE SPACE</h2>
		</br>
        <form method="post"> 
            <label for="name">Name:</label> 
            <input type="text" name="name" id="name" /> 
            <input type="submit" name="enter" id="enter" value="Enter" /> 
        </form> 
        </div> 
		       ';  
    }  
    if(isset($_POST['enter'])){  
        if($_POST['name'] != ""){  
            $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));  
        }  
        else{  
            echo '<span class="error">Please type in a name</span>';  
        }  
    }  
    
    if(!isset($_SESSION['name'])){  
        loginForm();  
    }  
    else{  
    ?> 
	
<h2 class="welcome">WELCOME, <b><?php echo $_SESSION['name']; ?></b></h2> 
			<button class="logout" id="exit"><b>EXIT</b></button>  
			
	
	<div id="wrapper">
    <div id="menu">
        <h2 class="welcome" id="chatWelcome">Chat, <b><?php echo $_SESSION['name']; ?></b></h2>
         </div>    
    <div id="chatbox"><?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
     
    echo $contents;
}
?></div>
     
    <form name="message" action="" id="chatForm">
        <input name="usermsg" type="text" id="usermsg" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>

<!--- Date/Time -->
<div id="myDiv1" ng-controller="MyControllerA">
            <h2 id="div1">Date/Time</h2>
           
	<button ng-click="showClock=!showClock"> My Date and Time</button>
	<div ng-hide="showClock">
	  <h3> Date: {{ clock | date:'dd-MM-yyyy' }}</h3>
      <h3> Time: {{ clock | date:'H:mm:ss' }}</h3>
  </div>
   </div>
            
<!--- Things to do -->
 <div id="myDiv2"  ng-controller="MyControllerB">
            <h2 id="div2">Don't Forget to Do:</h2>          
  
     
	<table id="itemtable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Date</th>
          <th>Done</th>
		  <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="item in data track by $index">
          <td width="80"><div id="name">{{item.name}}</div></td>
          <td width="150"><div id="description">{{item.description}}</div></td>
          <td>{{item.date}}</td>
          <td>{{item.completed}}</td>
		  <td><button id="clearButton"ng-click="clear($index)">CLEAR</button></td>
        </tr>
      </tbody>
	  </table>
	

    <form>
	<fieldset id="form">
	<table>
      <tr><td><b> Name</b><input type="text" ng-model="doName"></td></tr>
	   <tr><td><b> Date</b><input type="text" ng-model="doDate" placeholder="dd-mm-yyyy"></td></tr>
	   <tr><td><b>Description</b><br/>
        <div id="scroll"><textarea rows="3" ng-model="doDescription"></textarea></div></td></tr>
        <tr><td><input type="checkbox" ng-model="doComplete"> Done</td></tr>
      </table>
      <button ng-click="add()">ADD</button>
	 	  </fieldset>
    </form>
	
  </div>
       
      
<!--- Weather -->
	
<div id="myDiv3"  ng-controller="MyControllerC">
            <h2 class="city">{{city}}</h2>
  <div class="current">
    <div class="temp">{{weather.condition.temp}}&deg;</div>
    <div class="image">
      <img ng-src={{image}} />
      <div>{{condition}}</div>
    </div>
  </div>
  <div class="forecast">
    <ul>
      <li ng-repeat="day in forecast">
        <div>{{day.day}}</div>
        <div>{{day.high}}&deg; / {{day.low}}&deg;</div>
      </li>
    </ul>
  </div>
	</div> 

<!------ Editor -->
<div id="myDiv4"  ng-controller="MyControllerD" ng-click="hideEdit()">
<h2 id="div4">MY EDITOR</h2>   
<div class="edit" ng-click="$event.stopPropagation()" ng-show="showEdit">
	   <input type="text" ng-model="value"/>
    </div>
    <p id="editor" ng-click="toggleEdit($event)">{{value}}</p>
</div>    

	<?php
	if(isset($_GET['logout'])){  
	session_destroy();
      }
    }  
    ?>
	
	
</body>  
</html>