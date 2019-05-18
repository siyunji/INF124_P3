<?php
    require_once "dbconnect.php";
    $pdo = connectToDB();

    
    if (isset($_POST['quantity']) && isset($_POST['firstName']) && isset($_POST['lastName']) && 
    isset($_POST['phoneNumber']) && isset($_POST['streetNumber']) && isset($_POST['streetName']) && 
    isset($_POST['city']) && isset($_POST['state']) && isset($_POST['email']) &&
    isset($_POST['creditCard']) && isset($_POST['selection']) && isset($_POST['zipCode']) ){
                    $Quantity = $_POST["quantity"];
                    $FirstName = $_POST["firstName"];
                    $LastName = $_POST["lastName" ];
                    $Phone = $_POST["phoneNumber" ];
                    $streetNumber = $_POST["streetNumber" ];
                    $streetName = $_POST["streetName"];
                    if (isset($_POST['unitNumber'])){
                        $Apartmentunit = $_POST["unitNumber"];
                    }else{
                        $Apartmentunit = NULL;
                    }
                    $city = $_POST["city"];
                    $state = $_POST["state" ];
                    $email = $_POST["email"];
                    $creditCard = $_POST["creditCard"];
                    $shipping = $_POST["selection"];
                    $zip = $_POST["zipCode"];
                    
                    $sql = "INSERT INTO CustInfo (Quantity,FirstName,LastName,Phone,streetNumber,streetName,Apartmentunit,city,email,creditCard,state,zip,shipping)
                    VALUES (:Quantity,:FirstName,:LastName,:Phone,:streetNumber,:streetName,:Apartmentunit,:city,:email,:creditCard,:stata,:zip,:shipping)";
                    $stm = $pdo->prepare($sql);
                    $stm->execute(array(':Quantity'=> $Quantity,
                    ':FirstName'=> $FirstName,
                    ':LastName'=> $LastName,
                    ':Phone'=>$Phone,
                    ':streetNumber'=>$streetNumber,
                    ':streetName'=>$streetName,
                    ':Apartmentunit'=>$Apartmentunit,
                    ':city'=>$city,
                    ':email'=>$email,
                    ':creditCard'=>$creditCard,
                    ':stata'=>$state,
                    ':zip'=>$zip,
                    ':shipping'=>$shipping));
    }
    if (isset($_POST['price'])){
        $price = $_POST['price'];
    }
?>

<html>
<div id = "container">
<head>
    <title>ChocoBooth</title>
    <header>
        <center> <p>ChocoBooth</p></center>


    </header>
    <link rel = "stylesheet" type = "text/css" href = "../css/Info.css">
</head>

<body>
<?php
    $id = $_GET["num"];
    $stmt = $pdo->query('SELECT * FROM chocolate WHERE id=\''.$id.'\'');
    $result = $stmt->fetch();
?>
<div class = "main">
    <div class = "overview"  >
            <div class="head-text">
                <center>
                <img class = "strawberry" src="straberry.png">
                <h4>Thank you for purchasing<br><?php
                    echo($result['name']);
                ?><br></h4>
                <h6>Total price: <?php
                    echo(floatval($price)*floatval($Quantity));
                ?><br></h6>
                </center>
            </div>

      <div class = "Info">

          <?php

                  echo "Quantity: ".$Quantity. "<br><br> First Name: ".$FirstName."<br><br> Last Name: ".$LastName.
                  "<br><br> Phone: ".$Phone."<br><br> Street Number: ".$streetNumber. "<br><br> Street Name: ".$streetName."<br><br> Apartment Unit: "
                  .$Apartmentunit."<br><br> City: ".$city."<br><br> State: ".$state."<br><br> Zip Code: ".$zip."<br><br> Email: ".$email;

          ?>

      </div>
      <button onclick="location.href = location.href.replace('confirm','shop').split('?')[0]" class="shop-button">BACK TO SHOP</button>

    </div>
   <div class ="team">
        <center><p> Team Member : Siyun JI & Zhaomin LI & Aiden</p></center>
    </div>

</body>

</html>

<?php
$pdo->close();
?>
