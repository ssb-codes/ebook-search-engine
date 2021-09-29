<?php
    include "includes/config.php";
    $query = $_GET['q'];
    $starttime = microtime(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$query?> - eBook Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/search.css">
</head>
<body>
    <div class="header">
        <div class="menu">
            <div class="logo"><h1>eBook</h1></div>
            <div class="search">
                <form action="search" method="GET">
                    <input type="search" name="q" value="<?=$query?>" placeholder="Search for a eBook" id="">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <?php
    $queryr = "SELECT * FROM books WHERE title LIKE '%$query%'" ;
    $nquery = mysqli_query($conn, $queryr);
    $row = mysqli_num_rows($nquery);
    $endtime = microtime(true);
    $duration = $endtime - $starttime;
?>
    <div class="searchinfo">
        <div class="left">
            <p>About <?=$row?> Results In <?php echo substr($duration, 0, 8); ?> Seconds</p>
        </div>
    </div>
    <?php
    while ($result=mysqli_fetch_assoc($nquery)) { 
    ?>
    <div class="result">
        <div class="ebooks">
                <div class="image">
                    <img src="images/content/<?=$result['thumbnail']?>" alt="">
                </div>
                <div class="bookdetails">
                    <a href="download/book.pdf"><?=$result['title']?></a><br><br>
                    <p><?=$result['description']?></p><br>
                    <p><?=$result['pages']?> Pages - <?=$result['size']?></p>
                </div>
            </div>            
            </div>
        </div>
    </div>
    <?php } ?>
    <?php
        if($row==0){
            ?><br><br><center><p style="color: gray;">No result found for "<?=$query?>"</p></center><?php }
    ?>
</body>
</html>