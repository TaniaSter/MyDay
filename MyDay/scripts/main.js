

var moduleA = angular.module("MyModuleA", []);
          moduleA.controller("MyControllerA", function($scope) {
              $scope.showClock="true";
   var updateClock=function() {
   $scope.clock=new Date();
   };
  
   var timer=setInterval(function() {
   $scope.$apply(updateClock);
   }, 1000);
   updateClock();
          });

          var moduleB = angular.module("MyModuleB", []);
          moduleB.controller("MyControllerB", function($scope) {
           var model = [{
    		name:'', 
                description: "", 
                date: '', 
                completed: ""
    		    	}];
					
            $scope.data = model;
			
			 
            $scope.add = function() {
			$scope.data = localStorage.getItem('Data');
$scope.data = $scope.data ? JSON.parse($scope.data) : []; 
            	$scope.data.push({
                    name: $scope.doName,
                    description: $scope.doDescription,
        		date: $scope.doDate,
        		completed: $scope.doComplete
                });
				localStorage.setItem('Data', JSON.stringify($scope.data));
            };
			
        $scope.clear = function(){ 
            $scope.data.splice(this.$index, 1);			
		   localStorage.clear("MyModuleB", JSON.stringify($scope.data.item)); 
	};
          });
		  
		   
		  
		  
	
var url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%3D729028%20and%20u%3D'c'&format=json&callback=JSON_CALLBACK";	
	var moduleC = angular.module("MyModuleC", []);
          moduleC.controller("MyControllerC", function($scope, $http) {
             $http.jsonp(url).success(function(data){
    $scope.weather = data.query.results.channel.item;
    $scope.title = $scope.weather.title.split(" ");
    $scope.city = $scope.title.splice(2,1) + " " + $scope.title.splice(2,1);
    $scope.image = "http://l.yimg.com/a/i/us/we/52/" + $scope.weather.condition.code + ".gif";
    $scope.condition = $scope.weather.condition.text;
    $scope.forecast = $scope.weather.forecast;
    console.log($scope.forecast);
  });
          });


var moduleD = angular.module("MyModuleD", []);
          moduleD.controller("MyControllerD", function($scope) {
              $scope.showedit = false;
	$scope.value = 'Edit here...';
	$scope.hideEdit = function(){
	$scope.showEdit = false;
	}

	$scope.toggleEdit = function(e){
		e.stopPropagation();
		$scope.showEdit = !$scope.showEdit;
	}
          });		  


          angular.element(document).ready(function() {
              var myDiv1 = document.getElementById("myDiv1");
              angular.bootstrap(myDiv1, ["MyModuleA"]);

              var myDiv2 = document.getElementById("myDiv2");
              angular.bootstrap(myDiv2, ["MyModuleB"]);
			  
			  var myDiv3 = document.getElementById("myDiv3");
              angular.bootstrap(myDiv3, ["MyModuleC"]);
			  
			  var myDiv4 = document.getElementById("myDiv4");
              angular.bootstrap(myDiv4, ["MyModuleD"]);
			   			  
			  		  
			   
          });		

 
 $(document).ready(function(){  
        //If user wants to end session  
        $("#exit").click(function(){  
            var exit = confirm("Are you sure you want to end the session?");  
            if(exit==true){window.location = 'index.php?logout=true';}  
        }); 

$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	
	
	function loadLog(){		

		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); 		
		  	},
		});
	}
	
	setInterval (loadLog, 1500);	
	
			
   	$("#chatWelcome").click(function() {
		$("#chatbox").toggle();
	})
		
	})
	
	