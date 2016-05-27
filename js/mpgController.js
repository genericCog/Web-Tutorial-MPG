angular.module('angularTable', ['angularUtils.directives.dirPagination']);

app.controller('mpgDataCtrl', function($scope, $http) {
    $http.get("js/mpg.json").success(function (response) {
		$scope.mpgData = response;});
});

$scope.sort = function(keyname){
    $scope.sortKey = keyname;   //set the sortKey to the param passed
    $scope.reverse = !$scope.reverse; //if true make it false and vice versa
}


// /**/
// app.controller('theController', function ($scope, $http) {
    // $http.get('first.json').success(function(response){
        // $scope.firstData = response; 
    // });
    // $http.get('second.json').success(function(response1){
        // $scope.secondData = response1;
    // });
    // //add any other logic you need in functions here to compare & contrast
    // //and add those functions to $scope and call those functions from gui
    // //only enabling once both firstData and secondData have content
// });