<?php
    require('checkCredentials.php');

    $sql = "select * from requests where CustUserName = '$username' and status = 'A' order by CustSeen asc, date desc";
    $result = $conn -> query($sql);
    

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Owner</title>
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="requests.css"
    </head>
    <body>
        <!-- Doing the header -->
        <?php
            require('../template/headerNoSearch.php');
        ?>

        <div id="central">
            <?php
                require('customerNav.php');
            ?>
            <!-- The main contents -->
            <main>
                <ul id="accepted-requests">
                    <h1>Accepted Requests</h1>
                    <?php if ($result -> num_rows == 0){
                        echo "You don't have accepted requests";
                    }
                    ?>
                    <?php while ($row = $result -> fetch_assoc()){ ?>
                        <li onclick="acceptedDetails('<?php echo $username ?>', '<?php echo $row['TechUserName'] ?>', '<?php echo $row['Date'] ?>', '<?php echo $row['Skill Title'] ?>')">
                            <?php 
                                $date = $row['Date'];
                                $formattedDate = DateTime :: createFromFormat('Y-m-d H:i:s', $date);
                                $formattedDate = $formattedDate -> format('F d Y h:i A');

                                $jobTitle = $row['Skill Title'];
                                $techUserName = $row['TechUserName'];
                                $sql = "select * from Technician where UserName = '$techUserName'";
                                $subResult = $conn -> query($sql);
                                $details = $subResult -> fetch_assoc();
                                // print_r($details);
                                $firstName = $details['First Name'];
                                $fatherName = $details['Father Name'];
                                $gfName = $details['Grand Father Name'];
                                $phone = $details['Phone Number'];
                            ?>
                            <div class="left-detail">
                                <p class="name"><?php echo $firstName ." ". $fatherName ." ". $gfName ?></p>
                                <p class="job-date">
                                    <span class="job-title"><?php echo $jobTitle ?></span>
                                    <span>&middot;</span>
                                    <span class="date">
                                        <!-- March&nbsp;4&nbsp;2016 -->
                                        <?php 
                                            echo $formattedDate;
                                        ?>
                                    </span>   
                                </p>
                            </div>
                            <div class="right-detail">
                                <span class="contact">
                                    Contact
                                    <button class="phone"><?php echo $phone ?></button>
                                </span>
                                <?php if ($row["CustSeen"] == "N"){
                                    echo '<button class=new-request-btn>N</button>';
                                }
                                ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </main>
        </div>

        <?php
            require('../template/footer.php');
        ?>
        
        <script src="requests.js"></script>
    </body>
</html>