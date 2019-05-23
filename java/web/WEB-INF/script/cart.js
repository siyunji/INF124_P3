
var urlParams = new URLSearchParams(window.location.search);

var num = urlParams.get("num");

var quantity, firstName, lastName, phoneNumber, streetNumber,streetName, unitNumber, zip, city, state, creditCard, email, Shipping;

/* function to check if the user-input for email address is in the email template */
function emailValidation(){
    var emailformat = /^([A-Za-z0-9_\-\.]){1,}\@([A-Za-z0-9_\-\.]){1,}\.([A-Za-z]{2,4})$/;
    if (  email.value.match(emailformat)   ){
            return true;
    }
    
}

function validation() {
    quantity = document.getElementById("quantity");
    firstName = document.getElementById("firstName");
    lastName = document.getElementById("lastName");
    
    phoneNumber = document.getElementById("phoneNumber");
    var phoneNumberLength = phoneNumber.value.length;

    streetNumber = document.getElementById("streetNumber");
    var streetNumberLength = streetNumber.value.length;

    streetName = document.getElementById("streetName");
    unitNumber = document.getElementById("unitNumber");
    zip = document.getElementById("zipCode");
    
    city = document.getElementById("city");
    state = document.getElementById("state");    
    creditCard = document.getElementById("creditCard");
    var creditCardLength = creditCard.value.length;


    email = document.getElementById("email");


    /* var Shipping gets the value of shipping by its getElementById */
    Shipping = document.getElementById("selection").value;


    /* basic validation if user inputs blank space(s) */
    if( quantity.value.trim() == "") {
            alert("Please provide a number of quantity");
            return false;
    }
    if( firstName.value.trim() == "") {
            alert("Please provide your first name");
            return false;
    }
    if( lastName.value.trim() == "") {
            alert("Please provide your last lname");
            return false;
    }
    if( phoneNumber.value.trim() == "") {
            alert("Please provide your phoneNumber");
            return false;
    }
    if( streetNumber.value.trim() == "") {
            alert("Please provide your streetNumber");
            return false;
    }
    if( streetName.value.trim() == "") {
            alert("Please provide your streetName");
            return false;
    }
    if( zip.value.trim() == "") {
        alert("Please provide your Zip Code");
        return false;
    }
    if( city.value.trim() == "") {
            alert("Please provide your city");
            return false;
    }
    if( state.value.trim() == "") {
            alert("Please provide your state");
            return false;
    }
    if( creditCard.value.trim() == "") {
            alert("Please provide your creditCard numbers");
            return false;
    }
    if( email.value.trim() == "") {
            alert("Please provide your email address");
            return false;
    }
    if( Shipping == "default") {
            alert("Please select a shipping method");
            return false;
    }
    /* Basic validation ends */

    /* checks if user inputs Number and the Iteger is != < 1 */
    if(isNaN(quantity.value)){
            alert("Please provide a valid number of quantity")
            return false;
    }
    if(quantity.value < 1){
            alert("Please provide a valid number of quantity")
            return false;
    }

    /* checks if user inputs Number and the Iteger is 10 digits */
    if(isNaN(phoneNumber.value)){
            alert("Please provide a valid phoneNumber")
            return false;
    }
    if(phoneNumberLength != 10){
            alert("Please provide a valid phoneNumber")
            return false;
    }

    /* checks if user inputs Number and the Iteger is 1-5 digits */
    if(isNaN(streetNumber.value)){
            alert("Please provide a valid streetNumber")
            return false;
    }
    if(streetNumberLength < 0 ){
            alert("Please provide a valid streetNumber")
            return false;
    }
    if(streetNumberLength > 5 ){
            alert("Please provide a valid streetNumber")
            return false;
    }

    /* checks if state is written in 2 char */
    if( state.value.length != 2){

            alert("Please provide a valid state name in 2 letters")
            return false;
    }

    /******************************** */
    /* CHECKS if Zip Code is 5 digits */
    /******************************** */
    if( zip.value.length != 5){

        alert("Please provide a valid zip code")
        return false;
    }

    /* checks if user inputs Number and the Iteger is 16 digits */
    if(isNaN(creditCardLength)){
            alert("Please provide a valid creditCard number")
            return false;
    }
    if(creditCardLength != 16){
            alert("Please provide a valid creditCard number")
            return false;
    }

    /* wrapper function to check email validation */
    if(  emailValidation() != true  ){
            alert("Please provide a valid email address")
            return false;
    }

    /* checks for the shipping method */
    if( Shipping == "2days") {

            return true;
    }

    if( Shipping == "7days") {

            return true;
    } 
    /* checks for the shipping method ends here */

    return true;
};

function purchase_item(e){
    if (validation()){
        send_email(document.getElementById("email").value);
    }else{
        e.preventDefault();
    }
}

function send_email(user_email){
    var email_url = "mailto:";
    email_url += user_email + "?subject=" + encodeURIComponent("Order Confirmation") +
        "&body=" + encodeURIComponent(
        "Thank you, " + firstName.value +" "+ lastName.value + ", for purchase \n"+document.getElementById("name").innerHTML+"\nat Choco Booth!\n" +
        "The sweet is mailed to the following address: \n  "+
        streetNumber.value + " " +
        streetName.value + " \n  " +
        city.value + "\n  " +
        state.value + "\nUsing following shipment: " +
        Shipping
        );
    
    window.open(email_url,'popUpWindow','height=400,width=600,left=10,top=10,,scrollbars=yes,menubar=no');
}

function getState(zip) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() 
  {
    if(xhr.readyState == 4 && xhr.status == 200)
    {
      var result =xhr.responseText;
      var place =result.split(',');
      document.getElementById("city").value = place[0];
      document.getElementById("state").value = place[1];
      
    }
  
  }
  xhr.open("GET","/script/php/zip.php?zip=" + zip,true);
  xhr.send() 
}

function getTax(zip) {
        var xhr = new XMLHttpRequest(); 
        xhr.onreadystatechange = function () { 
                // 4 means finished, and 200 means okay.
                if (xhr.readyState == 4 && xhr.status == 200) 
                {
                        var result = xhr.responseText;
                        document.getElementById("tax").innerHTML = "Tax ratio: " + parseFloat(result).toFixed(3);
                        document.getElementById("total").innerHTML = "Price after tax: $" + 
                                ((1+parseFloat(result))*parseFloat(document.getElementById("price").innerHTML.split('$')[1])).toFixed(2);
                        document.getElementById("total_price").value = parseFloat(document.getElementById("total").innerHTML.split('$')[1]).toFixed(2);
                }
         }
        xhr.open("GET", "/script/php/tax.php?zip=" + zip, true);
        xhr.send();
}
     
window.onload = function (){
        document.getElementById("user-form").action = "../html/confirm.php?num="+num;
}

document.getElementById('user-form').onsubmit = function(e){
    purchase_item(e);
}

document.getElementById('zipCode').addEventListener("input", function(e){
        if(document.getElementById('zipCode').value.length == 5){
                getState(document.getElementById('zipCode').value);
                getTax(document.getElementById('zipCode').value);
        }
});