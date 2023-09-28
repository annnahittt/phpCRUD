<?php
include "./config/connect.php";
global $connect;
$name = $age = $rank = "";
$sql = "SELECT *  FROM `heroes`";
$query = mysqli_query($connect, $sql);
for ( $user = array(); $row= $query->fetch_assoc(); $user[] = $row);
$last = count($user) -1;
$last_id = $user[$last]['id']+1;
$connect->close();


if(isset($_POST['add'])){
$name = $_POST['name'] ?? "";
$age = $_POST['age'] ?? "";
$rank = $_POST['rank'] ?? "";
$connect= new mysqli("localhost", "root", "", "GoldWeb");
$sql = "INSERT INTO `heroes` (`id`, `name`, `age`, `rank`)  VALUES ('$last_id','$name', '$age', '$rank' )";
$connect->query($sql);
$connect->close();
header("Location:/");}


if (isset($_GET['select'])){
    $id = $_GET['select'];
    $name = $user[$id]['name'] ?? "";
    $age =$user[$id]['age'] ?? "";
    $rank = $user[$id]['rank']  ?? "";
    $id_heroes = $user[$id]['id'] ?? "";
}
if (isset($_POST['delete'])){
$connect= new mysqli("localhost", "root", "", "GoldWeb");
$sql = "DELETE FROM `heroes` WHERE `id` = '$id_heroes'";
$connect->query($sql);
$connect->close();
$name = $age=$rank="";
header("Location:/");
}

if (isset($_POST['edit'])){
    $name = $_POST['name'] ?? "";
    $age = $_POST['age'] ?? "";
    $rank = $_POST['rank'] ?? "";
    $connect= new mysqli("localhost", "root", "", "GoldWeb");
    $sql = "UPDATE `heroes` SET `name`='$name', `age`='$age', `rank`= '$rank'  WHERE `id`= '$id_heroes'";
    $connect->query($sql);
    $connect->close();
    $name = $age=$rank="";
    header("Location:/");


}










?>


    <link rel="stylesheet" type="text/css" href="index.css">
     <form action="#" method="post" >

    <input name="name" value="<?=$name?>" placeholder="name" >
    <input name="age" value="<?=$age?>" placeholder="age">
    <input name="rank" value="<?=$rank?>" placeholder="rank">


    <input name="add" type="submit"  value="Add">
<?php if(isset($_GET['select'])): ?>
    <input name="edit" type="submit"   value="Edit">
    <input name="delete" type="submit"  value="Delete">
<?php endif;?>


</form>

    <div class="crud">
<?php
foreach ($user as $i=> $val){
    $n = $i+1;
    echo "<div class='hero'><div class='num'> $n) </div> <div class='rowEl'>Name: $val[name] </div> <div class='rowEl'>Age: $val[age]</div> <div class='rowEl'> Rank: $val[rank]</div> <a href='?select=$i' class='select' > <button>Select</button> </a>

</div>";
} ?>
</div>