    <?php
    // Be sure to include the file you've just downloaded
    require_once('AfricasTalkingGateway.php');
    // Specify your login credentials
    $username   = "erickwarui28";
    $apikey     = "3daefe2ecc9e8143e43187228f8a1d371bf7876aa455782315f1343066b21ce0";
    // Specify the numbers that you want to send to in a comma-separated list
    // Please ensure you include the country code (+254 for Kenya in this case)
    $recipients = "+254700223146";
    // And of course we want our recipients to know what we really do
    $message    = "Dear customer, we have found an item that resembles your lost item. Visit our webpage for more information.";
    // Create a new instance of our awesome gateway class
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    // Any gateway error will be captured by our custom Exception class below, 
    // so wrap the call in a try-catch block
    try 
    { 
      // Thats it, hit send and we'll take care of the rest. 
      $results = $gateway->sendMessage($recipients, $message);
                
      foreach($results as $result) {
        echo "O";
        // status is either "Success" or "error message"
        //echo " Number: " .$result->number;
        //echo " Status: " .$result->status;
        //echo " MessageId: " .$result->messageId;
        //echo " Cost: "   .$result->cost."\n";
      }
    }
    catch ( AfricasTalkingGatewayException $e )
    {
        echo "X";
      //echo "Encountered an error while sending: ".$e->getMessage();
    }
    // DONE!!! 