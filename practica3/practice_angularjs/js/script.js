(function() {
    var app = angular.module('AttractionsModule', []);
    var controller = app.controller('AttractionsController', ($scope) => {
        $scope.productsChosen = []
        $scope.attractions = [
            {
                id:1,
                price:100,
                show : false,
                quantity : 0,
                image: "images/tiwanaku.jpg",
                description : "Viaje a Tiwanku",
                name : "Tiwnaku"
            },
            {
                id:2,
                price:200,
                show : false,
                quantity : 0,
                image: "images/uyuni.webp",
                description : "Viaje a Uyuni",
                name : "Uyuni"
            },
            {
                id:3,
                price:300,
                show : false,
                quantity : 0,
                image: "images/villa_tunari.jpg",
                description : "Viaje a Villa Tunari",
                name : "Villa Tunari"
            }
        ]
        $scope.chooseAttraction = (id) => {
            $scope.attractions[id-1].show = true

        }
        $scope.scojido = []
        $scope.addAttraction = (id)=>{
            if(!($scope.contains(id, $scope.scojido)) && $scope.attractions[id-1].quantity>0){
            console.log($scope.scojido)
            let choice = $scope.attractions[id-1]
            // Este obj se crea para no hacer referencia a ningun objecto de la lista attractions
            // agregar multiples viajes del mismo tipo a los viajes  elejidos 
            let insert = {
                id : choice.id,
                price: choice.price,
                quantity : choice.quantity,
                image: choice.image,
                description : choice.description,
                name : choice.name,
                subtotal : choice.quantity * choice.price
            }
            console.table(insert)
            $scope.total += insert.subtotal
            $scope.productsChosen.push(
                insert
            )
            $scope.scojido.push(id)
            console.log($scope.scojido)
            }
            else{
                alert("El producto ya ha sido escojido o no se ha agregado un valor valido")
            }
            $scope.cancelAttraction(id)
            

        }
        $scope.cancelAttraction = (id) => {
            $scope.attractions[id-1].show = false
        }
        $scope.deleteAttraction = (obj)=>{
            let index = Array.prototype.indexOf($scope.productsChosen, obj)
            $scope.total -= obj.subtotal
            $scope.productsChosen.splice(index, 1)
            $scope.scojido.splice($scope.scojido.indexOf(obj.id),1)
            $

        }
    $scope.contains = function(id, arr){
        for( let i of arr)
            {if(i==id) return true}
        return false
        } 
    
    });
}());
