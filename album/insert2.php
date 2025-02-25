<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>เพิ่มข้อมูลสินค้า</title>
</head>

<body>
<h1>ฟอร์มเพิ่มข้อมูลสินค้า</h1>

<form method="post" action="" enctype="multipart/form-data">
    ชื่อสินค้า: <input type="text" name="pname" required autofocus> <br>
    ราคา: <input type="text" name="pprice" required> <br>
    รายละเอียดสินค้า: <textarea name="pdetail" rows="4" cols="50" required></textarea> <br>
    หมวดหมู่สินค้า: 
    <select name="cid" required>
        <option value="" disabled selected>-- เลือกหมวดหมู่ --</option>
        <option value="1">ขนม</option>
        <option value="2">เครื่องดื่ม</option>
        <option value="3">ของใช้</option>
    </select> <br>
    รูปภาพสินค้า: <input type="file" name="pimage" required> <br>
    <button type="submit">บันทึก</button>
</form>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("../connectdb.php");
    
    // รับค่าจากฟอร์ม
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pdetail = $_POST['pdetail'];
    $cid = $_POST['cid'];
    $imageName = "";

    // จัดการการอัปโหลดรูปภาพ
    if (isset($_FILES['pimage']) && $_FILES['pimage']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['pimage']['tmp_name'];
        $imageName = $_FILES['pimage']['name'];
        $imageDestination = "../images/" . $imageName;

        // ย้ายรูปภาพไปยังโฟลเดอร์ปลายทาง
        if (!move_uploaded_file($imageTmpPath, $imageDestination)) {
            die("เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ");
        }
    }

    // ตรวจสอบค่าที่รับมา
    if (empty($pname) || empty($pprice) || empty($pdetail) || empty($cid) || empty($imageName)) {
        die("กรุณากรอกข้อมูลให้ครบถ้วน");
    }

    // คำสั่ง SQL สำหรับเพิ่มข้อมูลสินค้า
    $sql = "INSERT INTO products (p_name, p_price, p_detail, p_ext, c_id) 
            VALUES ('$pname', '$pprice', '$pdetail', '$imageName', '$cid')";

    // บันทึกข้อมูลลงฐานข้อมูล
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ');</script>";
    } else {
        die("เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn));
    }
}

?>
</body>
</html>
