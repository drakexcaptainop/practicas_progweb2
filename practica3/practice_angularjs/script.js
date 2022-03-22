var main_li = []
async function f(){
    let res = await fetch(
        "https://api.fbi.gov/wanted/v1/list"
    )
    res = await res.json()
    return res
}

f().then(
    (res)=>{
        console.log(res)
        main_li = res.items
        console.log(main_li)
    }
).catch(
    (err)=>console.log(err)
)

var app = angular.module('app', [])
var cont = app.controller('mainController', ($scope)=>{
    $scope.criminals = []
    $scope.add = ()=>{
        if (main_li.length>0){
            $scope.criminals.push(main_li[Math.floor(Math.random()*(main_li.length-1))])
        }
        else{
            alert('Getting data')
        }
    }
})
