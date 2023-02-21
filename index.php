<?php
namespace Htlw3r\PaaQrCode;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PA-QR-CodeForm</title>
</head>
<body>
        
    <form action="." method="post">    
        <label for="name">Owner's Name:</label>
        <input type="text" name="name" placeholder="Maxine Mustermann"><br>
            
        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" placeholder="+4312345678" required><br>
            
        <input type="submit" value="Create QR-Code">
    </form>


    <?php     
        require('vendor/autoload.php');
        use Endroid\QrCode\Builder\Builder;
        use Endroid\QrCode\Encoding\Encoding;
        use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
        use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
        use Endroid\QrCode\Label\Font\NotoSans;
        use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
        use Endroid\QrCode\Writer\PngWriter;

        // if(isset($_POST["name"]) && isset($_POST["phone"])){
        //     echo "<br>";
        //     echo "Owner's Name: " . $_POST["name"];
        //         echo "<br>";
        //         echo "Phone Number: " . $_POST["phone"]; 
        //     } 

        
        if(isset($_POST["name"]) && isset($_POST["phone"])){
            $result = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data('tel:'.$_POST['phone'])
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(600)
                ->margin(10)
                ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->labelText($_POST['name'])
                ->labelFont(new NotoSans(20))
                ->labelAlignment(new LabelAlignmentCenter())
                ->validateResult(false)
                ->build();

            $dataUri = $result->getDataUri();            
            echo '<img src="'. $dataUri .'"alt="Dynamc Generated QR Code">';
        }
    ?>
        


</body>
</html>