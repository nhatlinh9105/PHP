<html>
<head>
    <title>Personalized Greeting Form</title>
</head>

<body>
<?php
$bookId = 0;
$authorId = 0;
$title = "";
$ISBN = "";
$pub_year = 1999;
$available = 1;

if (!empty($_POST['bookId '])) {
    $bookID = $_POST['bookId '];
}

if (!empty($_POST['authorId'])) {
    $authorId = $_POST['authorId'];
}

if (!empty($_POST['title'])) {
    $title = $_POST['title'];
}

if (!empty($_POST['ISBN'])) {
    $ISBN = $_POST['ISBN'];
}

if (!empty($_POST['pub_year '])) {
    $pub_year = $_POST['pub_year'];
}

if (!empty($_POST['available'])) {
    $available = $_POST['available'];
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Book id: <input type="text" name="bookId"/>
    Author id: <input type="text" name="authorId"/>
    Title: <input type="text" name="title"/>
    ISBN: <input type="text" name="ISBN"/>
    Public Year: <input type="text" name="pub_year"/>
    Available: <input type="text" name="available"/>
    <input type="submit" value="Add Book">
</form>

<?php
$myDB = new mysqli('localhost', 'root', '', 'library');

if ($myDB->connect_error) {
    die('Connect Error (' . $myDB->connect_errno . ') '
        . $myDB->connect_error);
}


if ($title != '' && $ISBN != ''){
    $insert = "INSERT INTO books (bookid, authorid, title, ISBN, pub_year, available) VALUES 
            ($bookId, $authorId, '$title', '$ISBN', $pub_year, $available)";
    echo $insert;
    $myDB->query($insert);
    echo "New record created successfully";
}

if ($title != '') {
    $sql = "SELECT * FROM books 
        WHERE available = 1 AND title Like '%{$title}%'
        ORDER BY title";
} else {
    $sql = "SELECT * FROM author INNER JOIN books ON author.authorid = books.authorid ORDER by Name";
}

$result = $myDB->query($sql);
?>

<table cellspacing="2" cellpadding="6" align="center" border="1">
    <tr>
        <td colspan="5">
            <h3 align="center">These Books are currently available</h3>
        </td>
    </tr>
    <tr>
        <td align="center">Title</td>
        <td align="center">Year Published</td>
        <td align="center">ISBN</td>
        <td align="center">AuthorID</td>
        <td align="center">AuthorName</td>

    </tr>
    <?php
    while ($row = $result->fetch_assoc() ) {
        echo "<tr>";
        echo "<td>";
        echo $row["title"];
        echo "</td><td align='center'>";
        echo $row["pub_year"];
        echo "</td><td>";
        echo $row["ISBN"];
        echo "</td><td>";
        echo $row["authorid"];
        echo "</td><td>";
        echo $row["Name"];
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
