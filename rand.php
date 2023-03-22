<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
               <h3 class="text-center">Sending OTP to phone</h3>
                    <form action="rand.php" method="POST" class="form-control shadow">
                        <div class="mb-2">
                            <label for="">Enter Phonenumber:</label>
                            <input type="number" placeholder="Enter phone number" name="phone" class="form-control">
                        </div>
                       
                        <div class="mb-2">
                        <label for="">Enter Yourname:</label>
                        <input type="text" placeholder="Enter firstname" name="fname" class="form-control">
                        </div>

                        <div class="mb-2">
                            <button class="btn btn-success" name="sendotp">Send Otp</button>
                        </div>
                    </form>
            
            </div>
        </div>
    </div>
    
</body>
</html>
<?php
$apiKey="";
$sendeName="";

if(isset($_POST["sendotp"]) && isset($_POST['fname']))
{
    $phone = $_POST['phone'];
    $name = $_POST['fname'];
    $otp = rand(100000,999999);
    $message = "Hello " .$name. " , welcome to jonathans enterprises, your otp is :  ".$otp;
    $bodyRequest =array(
        "mobile" =>$phone,
        "response_type"=>"json",
        "sender_name"=>$sendeName,
        "service_id"=>0,
        "message"=>$message
    );
    $url = 'https://api.mobitechtechnologies.com/sms/sendsms';
    $payload = json_encode($bodyRequest);
    $curl = curl_init($url);
    curl_setopt_array($curl, array(
    // CURLOPT_URL => 'https://api.mobitechtechnologies.com/sms/sendsms',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 15,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>$payload,
    CURLOPT_HTTPHEADER => array(
        'h_api_key: '.$apiKey,
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);
   curl_close($curl);
   if($response){
    echo "<script>
    alert('You OTP send successfully to  ".$name."  of this phone number ".$phone."')
    window.location('rand.php')
    </script>";
    }
}
?>