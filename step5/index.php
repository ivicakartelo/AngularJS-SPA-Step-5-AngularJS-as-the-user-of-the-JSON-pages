<!DOCTYPE html>
<html lang="en-us" ng-app="myFoo">
<head>
  <script src="//code.angularjs.org/1.3.0-rc.1/angular.min.js"></script>
  <script src="//code.angularjs.org/1.3.0-rc.1/angular-route.min.js"></script>

<script>
  var myFoo = angular.module('myFoo', ['ngRoute']);

  myFoo.config(function ($routeProvider) {
    
    $routeProvider
    
    .when('/', {
        templateUrl: 'a.php',
        controller: 'mainController'
    })
    .when('/second/:num', {
    
        templateUrl: 'b.php',
        controller: 'secondController'
    })   
});

myFoo.controller('mainController', ['$scope', '$log', '$http', function($scope, $log, $http) {
    
    $http.get("control/select_control.php")
   .then(function (response) {$scope.json = response.data.records});
    
}]);

myFoo.controller('secondController', ['$scope', '$log', '$http', '$routeParams', 
function($scope, $log, $http, $routeParams) {
    
    $scope.num = $routeParams.num;
    $http.get("control/select_onerow_control_for_post_view.php?menu_id=" + $scope.num)
   .then(function (response) {$scope.json = response.data.records});
   
}]);
</script>
</head>

<body>
  <a href="#">Home</a>
  <?php
    define("DB_HOST", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "cmsoop");

    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = "SELECT menu_id, name,
				CONCAT(LEFT(content,400))
				AS content, published
			  	FROM menu ORDER BY menu_id DESC";
    $result = mysqli_query($link, $sql);
    print '<ul>';

    While ($row = mysqli_fetch_assoc($result))
    {
    print '<li>';
    print "<a href='#/second/" . $row["menu_id"] . "'>" . $row["name"] . "</a>";
    print "</li>";
    }
    print "</ul>";
?>
<div ng-view></div>
</body>
</html>