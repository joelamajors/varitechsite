<?php

  //form submitted
  $from_user = $_POST['name'];
  $from_phone = $_POST['phone'];
  $from_email = $_POST['email'];
  $from_address = $_POST['address'];
  $from_message = $_POST['message'];

  //verify captcha
  $recaptcha_secret = "6LerUycTAAAAAIxWknRT3WJo_DaWdUPLuHAsl1nR";
  $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
  $response = json_decode($response, true);

  if($response["success"] === true) {
    // Send Email
    $subject = "Contact Email from www.vteng.com";
    $txt = "<h3>You have a new email from Varitech's website</h3>";
    $txt = $txt."<p>User: ".$from_user."<br />";
    $txt = $txt."Phone: ".$from_phone."<br />";
    $txt = $txt."Email: ".$from_email."<br />";
    $txt = $txt."Address: ".$from_address."<br />";
    if(isset($_POST['iGenerator']) && $_POST['iGenerator'] == '1') {
      $txt = $txt."  I am interested in learning more about Generator Systems <br />";
    }
    if(isset($_POST['iCNG']) && $_POST['iCNG'] == '1') {
      $txt = $txt."  I am interested in learning more about CNG / Compressed Natural Gas <br />";
    }
    if(isset($_POST['iOther']) && $_POST['iOther'] == '1') {
      $txt = $txt."  I am interested in learning more about Other Topics <br />";
    }
    $txt = $txt."Message: ".$from_message."</p>";
    $txt = $txt."<p>Thanks,<br /> Vteng Website </p>";

    $to = "info@vteng.com";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: postmaster@vteng.com";
    //echo $txt;
    mail($to,$subject,$txt,$headers);
    echo "<script type='text/javascript'>window.location='/thankyou.html'</script>";
  } else {
    // Failed Request
    echo "<script type='text/javascript'>window.location='/contact.html'</script>";
  }

?>
