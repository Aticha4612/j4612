<?php
 include_once("../connectdb.php");
 $sql = "SELECT * FROM products WHERE p_id = '{$_GET['id']}' ";
 $rs = mysqli_query($conn, $sql);
 $data = mysqli_fetch_array ($rs);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>แก้ไขข้อมูลสินค้า</title>
</head>

<body>
<h1>ฟอร์มแก้ไขข้อมูลสินค้า</h1>

<form method="post" action="" enctype="multipart/ form-data">
ชื่อสินค้า: <input type="text" name="pname" value="<?php echo
$data['p_name'];?>" required autofocus> <br>
ราคา: <input type="text" name="pprice" value="<?php echo
$data['p_price'];?>" required> <br>
รายละเอียดสินค้า: <textarea name="pdetail" rows="5" cols="40"
required><?php echo $data['p_detail'];?></textarea> <br>
รูปภาพสินค้า: <input type="file" name="pimage" accept="image/*"
required> <br>

<button type="submit">บันทึก</button>
</form>
 
 <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once("../connectdb.php");
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
  
    $sql = "Update products SET p_name='{$pname}',p_price='{$pprice}'
    where p_id='{$_GET['id']}' ";
    mysqli_query($conn, $sql) or die ('update error');
    
    echo "<script>";
    echo "alert('Edit success!');window.location = 'update.php";
    echo "</script>";
 }
?>
</body>
</html>
