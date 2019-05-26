function getItemList() {
        var xhr = new XMLHttpRequest(); 
        xhr.onreadystatechange = function () { 
                // 4 means finished, and 200 means okay.
                if (xhr.readyState == 4 && xhr.status == 200) 
                {
                        var res = xhr.responseText;
                        document.getElementById("item-list").innerHTML = res;
                }
         }
        xhr.open("GET", "/java/itemlist", true);
        xhr.send();
}
     
window.onload = function (){
        getItemList();
}