<?php
/* --------
Filename: inc_paginationend.php
Author: Tracy Johnson
Purpose: Paginate list of results
--------  */
?>
<?php 
if ($pages >1) {
    echo "<div class='container w-50'>"; // start container

    // determine starting page
    $currentpage = ($start/$display) + 1;

    // if not first page include previous link
    if ($currentpage != 1) {
        echo '<a href="list_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Prev</a>';
    } 
    
    // make numbered links
    for ($i = 1; $i <= $pages; $i++) {
        if ($currentpage != 1) {
            echo '<a href="list_users.php?s=' . (($display * ($i -1))) . '&p=' . $pages  . '&sort=' . $sort . '">' . $i . '</a> ';
        } else {
            echo $i . '  ';
        }
    }

    // if not last page include next link
    if ($currentpage != $pages) {
        echo '<a href="list_users.php?s=' . ($start = $display) . '&p=' . $pages  . '&sort=' . $sort . '">Next</a>';
    } 

    echo "<div>"; // close container
}
?>