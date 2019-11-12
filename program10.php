<!--Before executing this program, open phpmyadmin from localhost and create a table student usn varchar(10), name varchar(20), branch varchar(3), sem int, address varchar(20)...dont initialize primary key or anything cuz the it'll sort the records while inserting itself..Insert 4-5 rows of random data and then execute the program -->

<!DOCTYPE html>
<html>
	<body>
		<style>
			table, td, th
			{
				border: 1px solid black;
				width: 33%;
				text-align: center;
				border-collapse:collapse;
				background-color:lightblue;
			}
			table { margin: auto; }
		</style>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "web_lab_a3";
			$a=[ ];
			// Create connection
			// Opens a new connection to the MySQL server
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection and return an error description from the last connection error, if any
			if ($conn->connect_error)
				die("Connection failed: " . $conn->connect_error);
			$sql = "SELECT * FROM student";
			// performs a query against the database
			$result = $conn->query($sql);
			echo "<br>";
			echo "<center> BEFORE SORTING </center>";
			echo "<table border='2'>";
			echo "<tr>";
			echo "<th>USN</th><th>NAME</th><th>Branch</th><th>Sem</th><th>Address</th></tr>";
			if ($result->num_rows> 0)
			{
				// output data of each row and fetches a result row as an associative array
				while($row = $result->fetch_assoc())
				{
					echo "<tr>";
					echo "<td>". $row["USN"]."</td>";
					echo "<td>". $row["NAME"]."</td>";
					echo "<td>". $row["branch"]."</td>";
					echo "<td>". $row["sem"]."</td>";
					echo "<td>". $row["ADDRESS"]."</td>";
					array_push($a,$row["USN"]);
				}
			}
			else
				echo "Table is Empty";
			echo "</table>";
			$n=count($a);
			$b=$a;
			for ( $i = 0 ; $i< ($n - 1) ; $i++ )
			{
				$pos= $i;
				for ( $j = $i + 1 ; $j < $n ; $j++ )
				{
					if ( $a[$pos] > $a[$j] )
						$pos= $j;
				}
				if ( $pos!= $i )
				{
					$temp=$a[$i];
					$a[$i] = $a[$pos];
					$a[$pos] = $temp;
				}
			}
			$c=[];
			$d=[];
			$e=[];
			$f=[];
			$result = $conn->query($sql);
			if ($result->num_rows> 0)// output data of each row
			{
				while($row = $result->fetch_assoc())
				{
					for($i=0;$i<$n;$i++)
					{
						if($row["USN"]== $a[$i])
						{
							$c[$i]=$row["NAME"];
							$d[$i]=$row["branch"];
							$e[$i]=$row["sem"];
							$f[$i]=$row["ADDRESS"];
						}
					}
				}
			}
			echo "<br>";
			echo "<center> AFTER SORTING <center>";
			echo "<table border='2'>";
			echo "<tr>";
			echo "<th>USN</th><th>NAME</th><th>Branch</th><th>Sem</th><th>Address</th></tr>";
			for($i=0;$i<$n;$i++)
			{
				echo "<tr>";
				echo "<td>". $a[$i]."</td>";
				echo "<td>". $c[$i]."</td>";
				echo "<td>". $d[$i]."</td>";
				echo "<td>". $e[$i]."</td>";
				echo "<td>". $f[$i]."</td></tr>";
			}
			echo "</table>";
			$conn->close();
		?>
	</body>
</html>