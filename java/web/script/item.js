
var urlParams = new URLSearchParams(window.location.search);

var num = urlParams.get("num");

var quantity, firstName, lastName, phoneNumber, streetNumber,streetName, unitNumber, zip, city, state, creditCard, email, Shipping;

function getItemInfo(num) {
        var xhr = new XMLHttpRequest(); 
        xhr.onreadystatechange = function () { 
                // 4 means finished, and 200 means okay.
                if (xhr.readyState == 4 && xhr.status == 200) 
                {
                        console.log(xhr.responseText);
                        var jsResult = JSON.parse(xhr.responseText);
                        
                        document.getElementById("main-picture").src = jsResult.img;
                        document.getElementById("add-picture-1").src = jsResult.pic_1;
                        document.getElementById("add-picture-2").src = jsResult.pic_2;
                        document.getElementById("name").innerHTML = jsResult.name;
                        document.getElementById("price").innerHTML += jsResult.price;
                        document.getElementById("origin").innerHTML += jsResult.origin;
                        document.getElementById("direction").innerHTML += jsResult.direction;
                        
                        document.getElementById("item_num").value += jsResult.id;
                        document.getElementById("total_price").value = jsResult.price;
                }
         }
        xhr.open("GET", "/java/item?num=" + num, true);
        xhr.send();
}
     
window.onload = function (){
        getItemInfo(num);
}
