<!-- import * as data from *../script/data"; -->
<!--  const CHOCH_DATA = data.CHOCOLATE_DATA; -->
<?php
	require_once "dbconnect.php";
    $pdo = connectToDB();                    
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Chocolate Shopping Page - ITEM </title>
    <link rel="stylesheet" href="../css/Item.css">
    <script type="module" src="../script/item.js"></script>

</head>

<body>
    <?php
        $id = $_GET["num"];
        $stmt = $pdo->query('SELECT * FROM chocolate WHERE id=\''.$id.'\'');
        $result = $stmt->fetch();
    ?>
    <!-- took the code below from Siyun's in oder to unify the OVERVIEW(top part) of our website -->
    <header>
        <center>
            <p>ChocoBooth </p>
        </center>
        <div class="overview">
            <img class="head-img" src="homepage_chocolate.png">
            <div class="head-text">
                <h3>Our shop provides you the best taste of Chocolate snacks from Asia</h3>
                <h4>Most of food on our website is made by chocolate</h4>
                <button onclick="location.href = location.href.replace('home','shop')" class="shop-button">Shop
                    Now!</button>
            </div>
        </div>
    </header>
    <!-- The OVERVIEW Function ends here  -->

    <section>
        <main>
            <!-- TOP LEFT Section to represent the selected item from the HOME PAGE  -->
            <div class="container1">
                <div class="itemImage">
                    <img id="main-picture" src=<?php
                    echo("\"".$result['img']."\"");
                    ?> alt="main picture">
                    <div class="itemName">
                    </div>
                </div>
            </div>
            <!-- TOP LEFTSection to represent the selected item from the HOME PAGE ends here  -->


            <!-- TOP RIGHT Section to represent the auxiliary image1 and image2 && detailed Description  -->
            <div class="container2">

                <div class="extraImage1">
                    <img id="add-picture-1" src=<?php
                    echo("\"".$result['pic_1']."\"");
                    ?> alt="add-on picture one">
                </div>

                <div class="extraImage2">
                    <img id="add-picture-2" src=
                    <?php
                    echo("\"".$result['pic_2']."\"");
                    ?> 
                    alt="add-on picture two">
                </div>

                <div class="Descriptions">
                    <h5 class="item-info" id="name">
                        <?php
                            echo($result['name']);
                        ?>
                    </h5>
                    <h2 class="item-info" id="price">
                        Price: $<?php
                        echo($result['price']);
                        ?>
                    </h2>
                    <h5 class="item-info" id="tax"></h5>
                    <h5 class="item-info" id="total"></h5>
                    <h6 class="item-info" id="origin"><b>Origin: 
                        <?php
                    echo($result['origin']);
                    ?></b></h6>
                    <h6 class="item-info" id="direction"><b>Direction: 
                    <?php
                    echo($result['direction']);
                    ?>
                    </b></h6>
                    
                </div>
            </div>
            

            <!-- TOP RIGHT Section to represent the auxiliary image1 and image2 && detailed Description ends here -->

            <div class="container3">
                <div class="template">
                </div>
            </div>

            <div class="container4">
                <form class="form" name="myForm" id="user-form" method="post">

                    <h31 class = "template-item"> Quantity : </h31><br>
                    <input type="text" name="quantity" id="quantity"  placeholder="*ex) 500" /><br>
                    <h32 class = "template-item"> First Mame : </h32><br>
                    <input type="text" name="firstName" id="firstName" placeholder="*ex) Chuck" /><br>
                    <h32 class = "template-item"> Last Mame : </h32><br>
                    <input type="text" name="lastName" id="lastName"  placeholder="*ex) Noris" /><br>
                    <h33 class = "template-item"> Phone Number : </h33><br>
                    <input type="text" name="phoneNumber" id="phoneNumber"  placeholder="*ex) (Area Code)-xxx-xxxx" /><br>
                    <h34 class = "template-item"> Street Number : </h34><br>
                    <input type="text" name="streetNumber" id="streetNumber"  placeholder="*ex) 14800" /><br>
                    <h35 class = "template-item"> Street Name : </h35><br>
                    <input type="text" name="streetName" id="streetName" placeholder="*ex) Culver" /><br>
                    <h37 class = "template-item"> Apartment / Unit Number (optional) : </h37><br>
                    <input type="text" name="unitNumber" id="unitNumber" placeholder="ex) 45A" /><br>

                    <h40 class = "template-item"> Zip Code : </h40><br>
                    <input type="text" name="zipCode" id="zipCode" placeholder="*ex) 10001" /><br>

                    <h38 class = "template-item"> City : </h38><br>
                    <input type="text" name="city" id="city" placeholder="*ex) Irvine" /><br>
                    <h39 class = "template-item"> State : </h39><br>
                    <input type="text" name="state" id="state" placeholder="*ex) CA" /><br>
                    <h40 class = "template-item"> Credit Card Number : </h40><br>
                    <input type="text" name="creditCard" id="creditCard" placeholder="*ex) xxxx-xxxx-xxxx-xxxx" /><br>
                    
                    <h41 class = "template-item"> Your Email Address : </h41><br>
                    <input type="text" name="email" id="email" placeholder="*ex) HelloWorld@ucie.edu" /><br><br/>
                    <div class="box">
                        <select name="selection" id="selection">
                            <option value="default"> *Click to select your shipping option </option>
                            <option value="2days"> 2-days shipping </option>
                            <option value="7days"> 5 to 7 days shipping </option>
                        </select>
                    </div><br/>
                    <input type="hidden" name="price" id="total_price"/>
                    <button>
                        <imput type="submit" class="P-button" value="submit" >PURCHASE</imput>
                    </button>
                </form>
            </div>

        </main>

    </section>

</body>

<!-- took the code below from Siyun's in oder to unify the ABOUT US of our website -->
<footer>
    <div class="about">
        <h5><br>Our company aims to provide various kinds of snack from Aisa made by chocolate. <br> We want to bring
            enjoyable and delightful experience with different tastes with chocolate
            <br>You can find lots of delicious food here!</h5>
    </div>
    <div class="team">
        <center>
            <p> Team Dama</p>
        </center>
        <center>
            <p> Team Member : Siyun JI & Zhaomin LI & Sunjun Ahn</p>
        </center>
    </div>
</footer>
<!-- The ABOUT US Function ends here  -->


</html>
<?php
    $pdo->close();
?>