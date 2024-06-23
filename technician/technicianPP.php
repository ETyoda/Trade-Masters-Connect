<?php
    require("checkCredentials.php");
    require("UpdateProfileCode.php");
?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        header('Location: logout.php');
        exit;
    }
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradeMaster</title>
    <link rel="icon" href="./images/TMIcon.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="technicianPP.css">
</head>

<body>
    <div class="Technician-container">
        <div class="profile">
            <div class="profile_picture"> 
                <img src="<?php echo $photoLink; ?>" alt="profilePIc">
            </div>
            <p id="Technician_UserName"><?php echo $techStatusRow['UserName']; ?></p>
            <br>
            <p id="Technician_skills">
                <?php while($skillRow = $skillResult -> fetch_assoc()){
                    echo "|" . $skillRow['SkillTitle'] . "|";
                }?>
            </p>
        </div>

        <div class="technician-form">
            <div class="technician-profile">
                <div class="output-box">
                    <p>Date of Birth:</p>
                    <span><?php echo $techStatusRow['DOB']; ?></span>
                </div>
                <div class="output-box">
                    <p>Gender:</p>
                    <span><?php echo $techStatusRow['Gender']; ?></span>
                </div>                
                <div class="output-box">
                    <p>Location:</p>
                    <span><?php echo $techStatusRow['Work Address']; ?></span>
                </div>
                <div class="button">
                    <button onclick="redirect()" type="submit" id="technician_update">Update</button>
                    <form action="technicianPP.php" method="post" onsubmit="confirmLogout()">
                        <button type="submit" id="technician_logout">Log Out</button>
                    </form>
                    
                </div>
            </div>
        </div>

    </div>
    <script>
        function redirect() {
            window.location.href = "technicianUPP.php";
        }
        function confirmLogout(){
            if (!window.confirm("Are you sure you want to log out?")){
                event.preventDefault();
            }
        }
    </script>
</body>