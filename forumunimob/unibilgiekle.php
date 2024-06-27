<?

include "conn.php";

$uniid = $_POST["uniid"];
$fakid = $_POST["fakid"];
$bolid = $_POST["bolid"];
$uname = $_POST["username"];

$uniup = $conn->query("UPDATE users SET uni = '$uniid', uni_fakulte = '$fakid', uni_bolum = '$bolid' WHERE username = '$uname'");

if($uniup)
{
    echo json_encode("success");
}
else
{
    echo json_encode("error");
}

?>