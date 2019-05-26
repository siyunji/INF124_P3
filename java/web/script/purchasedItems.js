/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var urlParams = new URLSearchParams(window.location.search);

var num = urlParams.get("num");

//var quantity, firstName, lastName, phoneNumber, streetNumber,streetName, unitNumber, zip, city, state, creditCard, email, Shipping;

function CheckItems(num) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            
            
            //var res = xhr.responseText;
            // document.getElementById("name").innerHTML =
            // document.getElementById("total_price").innerHTML = 
            // document.getElementById("quantity").innerHTML =
            console.log(xhr.responseText);
            var jsResult = JSON.parse(xhr.responseText);
            document.getElementById("item_num").innerHTML = jsResult.id;
            document.getElementById("total_price").innerHTML = jsResult.price;
            document.getElementById("quantity").innerHTML += jsResult.quantity;
            
 
        }
        
      
    }
    xhr.open("GET", "/java/item?num=" + num, true);
    xhr.send();
}
window.onload = function(){
    getItemInfo(num);
}
