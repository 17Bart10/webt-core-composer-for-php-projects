<?php
namespace Htlw3r\PaaQrCode;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PA-QR-CodeForm</title>
    <link href="./dist/output.css" rel="stylesheet">
</head>
<body>
        
    <div class="bg-blue-600">
        <h1 class="p-8 font-bold text-4xl text-center">The PAA (Pet Appreciation Association) Information-detail QR Code generator</h1>
    </div>


<div class="flex justify-center content-center mt-[9rem]">     

    <div class="flex flex-col rounded-xl bg-gray-500">
        <form action="." method="post">
            <div class="flex justify-center mt-10 mx-10">
                <p class="text-xl text-white">Please enter your Details:</p>
            </div>
            <div class="flex justify-center mt-3 mb-2 mx-10 relative">
                <input type="text" name="name" id="name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-2 border-black appearance-none dark:text-white dark:border-gray-600 dark:focus:border-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="name" class="absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-500 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Owner's Name</label>
            </div>

            <div class="flex justify-center mt-2 mb-5 mx-10 relative">
                <input type="tel" name="phone" id="phone" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-2 border-black appearance-none dark:text-white dark:border-gray-600 dark:focus:border-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="phone" class="absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-500 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Phone Number</label>
            </div>
                
            <div class="flex justify-center mb-10">
                <button class="w-50 pl-4 pr-4 text rounded-full bg-sky-400 hover:bg-sky-500">Generate QR-Code</button>
            </div>
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
                ->size(200)
                ->margin(0)
                ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->labelText($_POST['name'])
                ->labelFont(new NotoSans(20))
                ->labelAlignment(new LabelAlignmentCenter())
                ->validateResult(false)
                ->build();

            $dataUri = $result->getDataUri();
            echo '<div class="flex justify-center mb-10 mx-10 relative">';
            echo '<img src="'. $dataUri .'"alt="Dynamc Generated QR Code">';
            echo '</div>';
        }
    ?>
        

    </div>


</div>


</body>
</html>