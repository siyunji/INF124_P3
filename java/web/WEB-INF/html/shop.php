<?php
	require_once "dbconnect.php";
	$pdo = connectToDB();
?>

<html>

<head>
	<title>ChocoBooth-Shop</title>
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="stylesheet" type="text/css" href="../css/shop.css">
</head>

<body>
	<script type="text/javascript">
		function openItemPage( num ){
			if (location.href[location.href.length - 1]!=='?')
				location.href = location.href.replace('shop','item')+"?num="+num;
			else
				location.href = location.href.replace('shop','item')+"num="+num;
		}	
	</script>
	<header>
		<center><p>ChocoBooth</p></center>
	</header>
	<div class="main">
		<div class="overview">
			<div class="head-text">
				<h1>Our shop provides you the best taste of Chocolate snacks from Japan</h1>
			</div>
		</div>

		<div id="item-list">
		<?php
    		$stmt = $pdo->query("SELECT * FROM chocolate");
    		while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        		echo(
		"<div class = \"item-block\">".
        "<table>".
            "<tbody >".
                "<tr>".
                    "<td><img class = \" enlarge-pic \" onclick=\" openItemPage(".$row['id']. ") \" src=\" ".$row['img']." \" /></td> ".
                "</tr>".
                "<tr>".
                    "<td><h3 class=\" item-title \"> ".$row['name']."</h3> </td> ".
                "</tr>".
                "<tr>".
                    "<td><h1> $".$row['price']."</h1> </td>".
                "</tr>".
            "</tbody> ".
        "</table>".
        "</div>");
    	}
    ?> <br>
		</div>

		
	</div>
	<div class ="team">
		<center><p> Team Dama</p></center>
		<center><p> Team Member : Siyun JI & Zhaomin LI & Sunjun Ahn</p></center>
		  
	</div>
</body>

</html>

<?php
$pdo->close();
?>