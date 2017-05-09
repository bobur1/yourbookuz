<?php
function setComments($conn)
{
    if(isset($_POST['commentSubmit']))
    {
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];
		$name = $_POST['name'];
        $sql = "INSERT INTO comments(name,doctor,date,message) VALUE('$name','$uid','$date','$message')";
        $result = mysqli_query($conn,$sql);
    }
}

function getComments($conn)
{
    $sql = "SELECT * FROM comments";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc())
    {
        echo "<div class = 'comment-box'><p>";
            echo $row['name']."<br>";
            echo $row['date']."<br>";
            echo nl2br($row['message']);
        echo "</p></div>";

    }
}
