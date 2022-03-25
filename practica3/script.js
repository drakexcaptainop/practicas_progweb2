var app = angular.module("app", [])
app.controller('cont', ($scope, $http)=>{
    $scope.data = {
        "first_name" : "Jhon",
        "last_name" : "Q",
        "birth_date" : null,
        "city" : null
    }
    $scope.cities = [
        "Madrid",
        "Nigeria",
        "London",
        "Moscow"
    ]
    $scope.changeCity = ()=>{
        $scope.data.city = $scope.city
    }
    $scope.submit = ()=>{
        $scope.data.birth_date = new Date($scope.data.birth_date)
        console.log($scope.data)
        $http.post("/customer_post.php", $scope.data).then(
            (res)=>{
                alert("Status: " + res.status)
                console.log(res)
            }
        ).catch(
            (err)=>{
                console.log(err)
                alert(err)
            }
        )
    }
})