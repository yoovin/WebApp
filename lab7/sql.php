<!DOCTYPE html>
<html>
	<head> 
        <meta charset="UTF-8">    
		<title>Running query on PHP</title>
	</head>

	<body>
		<form action="sql.php" method="post">
		
			<div>
				DB name:<input type="text" name="db_name"/>
				SQL query: <input type="text" name="query"/>

				<input type="submit" value="SUBMIT"/>
			</div>

		</form>

		<?php
            $db_name = $_POST["db_name"]; $query = $_POST["query"];
            $var_check = (strcmp("", $db_name) == 0) || (strcmp("", $query) == 0);
            if($var_check){
        ?>

        <h1>Fill in the blanks.</h1>
        <p>You didn't fill out the form completely. Try again!</p>

        <?php
            }else{
                $pdo = null; $rows = null; $db_error = false;
                try{
                    $db = new PDO("mysql:dbname=$db_name;host=localhost", "root","root");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $db->exec("set names utf8");
                    $rows = $db->query($query);
                }
                catch(PDOException $e) {
                    $db_error = true;
                    echo $e->getMessage();
                }

        ?>
        <?php   if($db_error){ ?>

        <h1>Error occured.</h1>
        <p>Enter correct value. Try again!</p>

        <?php   }else{ ?>

        <h1>QUERY RESULT</h1>
        <?= $rows->rowCount() ." row(s) in set"?>
        <ul>
            <?php foreach($rows as $row){ ?>
			<li><?php for($i = 0; $i < count($row); $i++){ print $row[$i]."\t";} ?></li>
            <?php } ?>
        </ul>

        <?php   }
                $pdo = null;
            }
        ?>
	</body>
</html>
