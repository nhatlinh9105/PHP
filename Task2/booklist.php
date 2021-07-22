<?php
$myDB = new mysqli('localhost', 'root', '', 'library');
if ($myDB->connect_error)
{
    die('Connect Error (' .$myDB->connect_errno . ') '.$myDB->connect_error);
}

$sql = "SELECT * FROM author INNER JOIN books ON author.authorid = books.authorid ORDER by Name";
//$sql = "SELECT * FROM books WHERE available = 1 ORDER BY ISBN";
//
$result =  $myDB->query($sql);



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
