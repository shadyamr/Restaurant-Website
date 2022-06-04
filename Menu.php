<html>
	<head>
		<style>
			.topnav{
				background-color: black;
				overflow:hidden;
				color: white;
				font-size: 17px;
				padding: 14px 16px;
			}
			.topnav a{
				float:left;
				display:block;
				color: white;
				text-align: center;
				padding: 0px 16px;
				text-decoration: none;
				font-size: 17px;
			}
			.topnav a:hover{
				background-color: green;
				color: white;
			}
		</style>
	</head>
	<body>		
		<div class="topnav">
			<?php
				if(!empty($_SESSION['ID'])) 
				{
					echo "Welcome ".$_SESSION['Name'];
					echo"<a href='QCHome.php'>Home</a>";
					echo"<a href='Delete.php'>'Delete User</a>";
                    echo"<a href='Update.php'>Update User</a>";
                    echo"<a href='ViewAll.php'>View All Users</a>";
                    echo"<a href='Search.php'>Search</a>";
				}
				else
				{
					echo"<a href='QCHome.php'>Home</a>";
					echo"<a href='Delete.php'>Delete User</a>";
                    echo"<a href='Update.php'>Update User</a>";
                    echo"<a href='ViewAll.php'>View All Users</a>";
                    echo"<a href='Search.php'>Search</a>";
				}
				?>
		</div>
		<br><br>
	</body>
</html>