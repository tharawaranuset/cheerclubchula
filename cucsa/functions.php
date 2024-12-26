<?php

	// แยกค่าต่าง ๆ ออกเป็นตัวแปร
	$host = "localhost";       // ชื่อโฮสต์ เช่น localhost หรือ IP Address
	$username = "root";        // ชื่อผู้ใช้งาน MySQL
	$password = ""; // รหัสผ่านของผู้ใช้งาน
	$database = "my_database"; // ชื่อฐานข้อมูลที่ต้องการเชื่อมต่อ

	// ใช้ตัวแปรในการเชื่อมต่อกับฐานข้อมูล
	$link = mysqli_connect($host, $username, $password, $database);

?>
โ