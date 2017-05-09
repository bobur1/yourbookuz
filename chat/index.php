<?php
    date_default_timezone_set('Asia/Tashkent');
    include 'db.php';
    include 'comments.php';
?>
<html>
<head>
<title>Comment!</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<script>
            function lettersOnly(input)
            {
                var regex = /[^a-z,^A-Z,^0-9, ]/gi;
                input.value = input.value.replace(regex, "");
            }
        </script>
<?php
echo "<form method='POST' action='".setComments($conn)."'>
    <input type='hidden' name='uid' value='User'>
    <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
    <textarea onkeyup='lettersOnly(this)' name='message'></textarea><br>
    <button type='submit' name='commentSubmit'>Comment</button>
</form>";

getComments($conn);

?>
</body>
</html>