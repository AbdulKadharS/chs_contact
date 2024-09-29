<?php
error_reporting(0);
ob_start();
session_start();
$success = '';
if (isset($_POST['send'])) {

    $success = '';
    $name = ($_POST['name']);
    $company = ($_POST['company']);
    $position = ($_POST['position']);
	$address1 = ($_POST['address1']);
	$address2 = ($_POST['address2']);
	$postcode = ($_POST['postcode']);
    $email = ($_POST['email']);
    $telephone = ($_POST['telephone']);
    $message2 = ($_POST['message']);
    $subject = ($_POST['subject']);
    $subjectN = ($_POST['subject']);

    $messageyes = "";
/*    if($subject == "Catering Equipment"){
        $messageyes = true;
        $_SESSION['error'] = "Your inquiry for catering equipment was submitted and will be responded to you shortly, thank you for contacting us.";
    }
    if($subject == "Kitchen & Duct Cleaning"){
        $messageyes = true;
        $_SESSION['error'] = "Your inquiry for kitchen and duct cleaning was submitted and will be responded to you shortly, thank you for contacting us.";
    }
    if($subject == "Fly Screens and PVC Curtains"){
        $messageyes = true;
        $_SESSION['error'] = "Your inquiry for fly screens and pvc curtains was submitted and will be responded to you shortly, thank you for contacting us.";
    }*/
    
    if(!isset($_POST['g-recaptcha-response']) || $_POST['g-recaptcha-response'] == "") {
        $_SESSION['error'] = "The capcha was completed incorrectly, please reenter the number and press send";
        header("Location:contact.php?error=1&name={$name}&company={$company}&address1={$address1}&address2={$address2}&postcode={$postcode}&email={$email}&telephone={$telephone}&message2={$message2}&subject={$subject}");
        $success = '';
        $name = ($_GET['name']);
        $company = ($_GET['company']);
        exit;
    }

    $to = 'sales@cateringhygiene.co.uk';
	//$to .= 'fazil@powerscribe.com';
    $subject = "Website Enquiry [$subject]";
    $message = "<html><body>";
    $message .= "This email was sent from the Catering Hygiene website enquiry form.<br /><br /><br />";
    $message .= "<strong>Name:</strong> $name <br /><br />";
    $message .= "<strong>Company:</strong> $company <br /><br />";
    $message .= "<strong>Position:</strong> $position <br /><br />";
	$message .= "<strong>Address 1:</strong> $address1 <br /><br />";
	$message .= "<strong>Address 2:</strong> $address2 <br /><br />";
	$message .= "<strong>Post Code:</strong> $postcode <br /><br />";
    $message .= "<strong>Email:</strong> $email <br /><br />";
    $message .= "<strong>Telephone:</strong> $telephone <br /><br />";
    $message .= "<strong>Message:</strong> $message2 <br /><br />";
    $message .= "<strong>Subject:</strong> $subject <br /><br />";
    $message .="</body></html>";
    $headers = 'MIME-Version: 1.0 \n';
    //$headers = 'From:' . $email . "\n";
	$headers = 'From: sales@cateringhygiene.co.uk' . "\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
    'Reply-To:' . $email . "\n" .
            'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    $to = $email;
    $subject = "Thank You For Your CHS Enquiry";
    $message = "<html><body>";
    $message .= "Thank you for your enquiry; we will contact you promptly.<br /><br />";
    $message .= "Kind regards,<br />";
    $message .= "CHS Sales Team<br />";
    //$message .= "Sales Manager<br /><br />";
    $message .= "Catering Hygiene Specialists Ltd<br />";
    $message .= "Tel: 01895 812117<br />";
    $message .= "Fax: 01895 259467<br />";
    $message .= "www.cateringhygiene.co.uk";
    $message .="</body></html>";
    $headers = 'MIME-Version: 1.0 \n';
    $headers = 'From: sales@cateringhygiene.co.uk' . "\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
    'Reply-To: ' . $email . "\n" .
            'X-Mailer: PHP/' . phpversion();

    mail($email, $subject, $message, $headers);
    //die('test');
    if ($subjectN == "Catering Equipment"){

      header("Location: https://www.cateringhygiene.co.uk/catering_equipment.php");
      exit();
    }
    if ($subjectN == "Kitchen & Duct Cleaning"){
      header("Location: https://www.cateringhygiene.co.uk/kitchen-duct-cleaning.php");
      exit();
    }
    if ($subjectN == "Fly Screens and PVC Curtains"){
      header("Location: https://www.cateringhygiene.co.uk/fly-screens-and-pvc-curtains.php");
      exit();
    }

    $_POST['name'] = "";
    $_POST['company'] = "";
    $_POST['position'] = "";
	$_POST['address1'] = "";
	$_POST['address2'] = "";
	$_POST['postcode'] = "";
    $_POST['email'] = "";
    $_POST['telephone'] = "";
    $_POST['message'] = "";
    $_POST['subject'] = "";

}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="jquery.js"></script>
<script  type="text/javascript">
	function validate()
	{
		
        if ((jQuery('#g-recaptcha-response').val()) === '') {
            jQuery('#error-msg').css('display', 'block');
            jQuery('#error-msg').css('color', '#df280a');
            jQuery('#error-msg').css('font-size', 13);
            return false;
        }
        else {
            jQuery('#error-msg').css('display', 'none');
        }

        var x = document.getElementById("email").value;
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		if (document.getElementById('name').value == '')
		{   alert("Please Enter Name");
			document.getElementById('name').focus();
			return false;
		}
		
        else if (document.getElementById('address1').value == '')
        {   alert("Please Enter Address 1");
            document.getElementById('address1').focus();
            return false;
        }
		else if (document.getElementById('postcode').value == '')
		{	alert("Please Enter Post Code");
			document.getElementById('postcode').focus();
			return false;
		}
		else if (document.getElementById('email').value == '')
		{   alert("Please Enter Email");
			document.getElementById('email').focus();
			return false;
		}
		else if (document.getElementById('email').value && (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length))
		{	alert("Not a valid e-mail address");
			return false;
		}
		else if (document.getElementById('telephone').value == '')
		{	alert("Please Enter Telephone");
			document.getElementById('telephone').focus();
			return false;
		}
		else if (document.getElementById('subject').value == '')
		{	alert("Please Enter Subject");
			document.getElementById('subject').focus();
			return false;
		}
		/*else if (document.getElementById('vercode').value == '')
		{   alert("Please Enter Security Code");
			document.getElementById('vercode').focus();
			return false;
		}*/
		else
		{   return true;
		}
	}
</script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" >
	<link rel="icon" href="https://cdn.cateringhygiene.co.uk/media/favicon/default/favicon.png" type="image/x-icon">
<link rel="shortcut icon" href="https://cdn.cateringhygiene.co.uk/media/favicon/default/favicon.png" type="image/x-icon">
    <title>Contact us for Canopy Cleaning, Extraction Cleaning, Kitchen Cleaning & Fly screens</title>
    <meta name="description" content="We undertake Canopy Cleaning, Ventilation Cleaning & Kitchen Cleaning throughout the UK. We are also the  Ductwork Cleaning Specialist or install Fly Screens, Insect Screens fitted all fitted Nationwide Service"/>
    <meta name="keywords" content="Canopy Cleaning Ventilation Cleaning ,Duct Cleaning, Kitchen Cleaning, Ductwork Cleaning, Extract Cleaning, Extraction Cleaning, Extract Cleaning,  Flyscreens, Fly Screens & Insect Screens"/>
    <meta name="robots" content="index, follow" />
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    <?php include 'includes/javascript.php'; ?>
    <script src="https://www.google.com/recaptcha/api.js" type="text/javascript" xml="space"></script>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="service-full contact_bg">
        <div class="col-md-7 col-sm-6">
            <div class="service-full-header"><span>Contact Us</span></div>
            <div class="service-right-tuck"></div>
            <div class="clear"></div>
            <div class="service-left-fold"></div>
        </div>
        <div class="col-md-2 col-sm-6 no-padding">
            <a style="display: inline-block;margin-top:32px;" onclick="popupCenter('https://lc.chat/now/7188411/', 'myPop1',450,450);" href="javascript:void(0);" class="chat-button">
                <img style="max-width: 60px;" class="live-chat" src="https://www.cateringhygiene.co.uk/shop/media/wysiwyg/chat.png" alt="chat">
            </a>
            
        </div>
     <div class="col-md-3 col-sm-6 no-padding">
                <div class="service-full-button" id="view-benefits">
                    <div class="clear"></div>
                </div>
            </div>
        <div class="clear" ></div>
             <div class="col-md-12 service-full-benefits" id="benefits">
            <div class="service-full-benefits-left col-md-8 no-padding">
                <strong>Just some of the benefits that come with choosing CHS:</strong>
                <ul>
                    <li>Rapid response with survey and short lead time for cleaning</li>
                    <li>Work carried out in accordance with all health and safety regulations</li>
                    <li>Method Statements, Risk Assessments and Policy Documents provided with quotation</li>
                    <li>£5,000,000 Public Liability Insurance</li>
                </ul>
            </div>
            <div class="service-full-benefits-right col-md-4 no-padding">
                <ul>
                    <li>Thoroughly trained staff.</li>
                    <li>Site Specific Risk Assessment</li>
                    <li>Certificate of Cleanliness</li>
                </ul>
            </div>
        </div>

        <div class="service-full-content">
        <div class="col-md-12 col-sm-12 padding-0">
            <div class="col-md-8 col-sm-6 padding-0">
                <h1 class="page-title"><span class="base" data-ui-id="page-title-wrapper">Contact Us</span></h1>
            	<div class="col-md-12 col-sm-12" style="float:none;">
                	<p>Use the form below to get in touch, be sure to leave your email &amp; telephone number so we can get back in touch with you!</p>
               	</div>

                <form name="contactForm" action="" method="post" onSubmit="return validate();">
                        <?php if($messageyes){ ?>
                        <div class="success" style="color: green;background-color: white;"><?= $_SESSION['error'] ?></div>
                        <?php unset($_SESSION['error']);
                        session_destroy();
                        ?>
                        <?php } elseif (isset($_SESSION['error']) && $_SESSION['error']=='The capcha was completed incorrectly, please reenter the number and press send')  { ?>
                            <div class="success" style="color: red;background-color: white; border: 1px solid red;"><?= $_SESSION['error'] ?></div>
                        <?php unset($_SESSION['error']);
                        session_destroy();
                        } ?>
                    
                    <div class="left-table col-md-6 col-sm-12">
                        <table>
                            <tr>
                                <td>Name: <span>*</span></td>
                                <td><input placeholder="Name" type="text" name="name" id="name" placeholder="" value="<?php echo isset($_GET['name']) ? urldecode($_GET['name']) : ''; ?>" required="required"/></td>
                            </tr>

                            <tr>
                                <td>Position:</td>
                                <td><input placeholder="Position" type="text" name="position" id="position" placeholder="" value="<?php echo isset($_GET['position']) ? urldecode($_GET['position']) : ''; ?>" /></td>
                            </tr>
                            <tr>
                                <td>Post Code: <span>*</span></td>
                                <td><input placeholder="Post Code" type="text" name="postcode" id="postcode" placeholder="" value="<?php echo isset($_GET['postcode']) ? urldecode($_GET['postcode']) : ''; ?>" required="required" /></td>
                            </tr>
                            <tr>
                                <td>Company:</td>
                                <td><input placeholder="Company" type="text" name="company" id="company" placeholder="" value="<?php echo isset($_GET['company']) ? urldecode($_GET['company']) : ''; ?>" /></td>
                            </tr>
							<tr>
                                <td>Address 1: <span>*</span></td>
                                <td><input placeholder="Address 1" type="text" name="address1" id="address1" placeholder="" value="<?php echo isset($_GET['address1']) ? urldecode($_GET['address1']) : ''; ?>" required="required"/></td>
                            </tr>
							<tr>
                                <td>Address 2:</td>
                                <td><input placeholder="Address 2" type="text" name="address2" id="address2" placeholder="" value="<?php echo isset($_GET['address2']) ? urldecode($_GET['address2']) : ''; ?>" /></td>
                            </tr>
							
                        </table>
                    </div>
                    <div class="right-table-from col-md-6 col-sm-12">
                    <table>
                        <tr>
                                <td>Email: <span>*</span></td>
                                <td><input placeholder="Email" type="text" name="email" id="email" placeholder="" value="<?php echo isset($_GET['email']) ? urldecode($_GET['email']) : ''; ?>" required="required" /></td>
                            </tr>
                            <tr>
                                <td>Telephone: <span>*</span></td>
                                <td><input placeholder="Telephone" type="text" name="telephone" id="telephone" placeholder="" value="<?php echo isset($_GET['telephone']) ? urldecode($_GET['telephone']) : ''; ?>" required="required" /></td>
                            </tr>
                            <tr>
                                <td>Subject: <span>*</span></td>
                                <td>
                                    <select name="subject" id="subject" required="required">
                                        <option value="">Please Choose...</option>
                                        <option value="Catering Equipment">Catering Equipment</option>
                                        <option value="Kitchen & Duct Cleaning">Kitchen & Duct Cleaning</option>
                                        <option value="Fly Screens and PVC Curtains">Fly Screens and PVC Curtains</option>
                                    </select>
                                </td>
                            </tr>
                        <tr>
                            <td style="height:20px;">Message:</td>
                        </tr>
                        <tr class="message-s">
                            <td class="text-message"><textarea name="message" id="message" rows="4" cols="33"></textarea></td>
                        </tr>
						<tr>
                                <td style="height:20px;"></td>
                                
                            </tr>
                    </table>
                
                    </div>
                    <div class="bottom-captcha">
                            <div class="form-group required">
                                <div class="g-recaptcha required" id="recaptcha"
                                    data-sitekey="6LdITSMqAAAAAE1DX0CLjcFNZ9ZIvxcxnMJ36hF5">
                                </div>
                                <div style="display:none" id="error-msg">
                                    <span>This is a required field.</span>
                                </div>
                        </div>
                        <div class="submit_btn">
                            <input type="submit" value="Send" name="send" class="submit" /> 
                        </div>
                    </div>
                </form>
                <div class="col-md-12 col-sm-12 address_part" style="margin-top:40px;">
                    <p class="OfficeOpening">
                        <strong>Head Office Information</strong>
                        <br />
                        Alternatively, you can get in touch using our contact details below: 
                        <br />
                        <table border="0" cellspacing="20" style="line-height: 25px;">
                            <tr>
                                <td width="88">Telephone:</td>
                                <td width="202"><a href="tel:01895 812117" style="color:#0000ff">01895 812117</a></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><a href="mailto:sales@cateringhygiene.co.uk" style="color:#0000ff">sales@cateringhygiene.co.uk</a></td>
                            </tr>
                        </table>
                    </p>
                    <br />
                    <p class="OfficeOpening">
                        <strong>Office Opening Hours</strong>
                        <br />Monday – Friday
                        <br />8.30am – 4.30pm
                    </p>
                    
                    <p class="social_sec">
                        <strong>We Are Social, Join Us</strong>
                        <br /><br />
                       <!-- <a class="social" href="http://www.linkedin.com/company/catering-hygiene-specialists-ltd" target="_blank">
                            <img class="social_icon" src="images/linked-in-chs.png" alt="Linked In" border="0"/> -->
                        </a>
                        <a class="social" href="https://www.facebook.com/pages/Catering-Hygiene-Specialists-Ltd/232199366962131" target="_blank">
                            <img src="images/fb-contact.png" alt="Facebook" border="0" class="fb_icon">
                        </a>
                       <!-- <a class="social" href="https://twitter.com/CateringHygiene" target="_blank">
                            <img src="images/twitter-contact.png" alt="Twitter" border="0" class="twitter"> -->
                        </a>
                        <a style="display: inline-block; float: left;" href="https://www.instagram.com/catering_hygiene_specialists/" target="_blank"><img src="https://cdn.iconscout.com/icon/free/png-256/instagram-1868978-1583142.png" alt="Instagram" border="0" style="height: 33px;margin-right:15px;vertical-align: top;margin-top: 4px;"></a>
                        <span class="required">* Required Fields</span>
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 part map_part_right">
                <div class="service-full-content-right right-table">
                <p><strong style="font-size: 18px;">Find Us</strong></p>
                <p>Unit 1 Midas Industrial Estate<br />
                    Longbridge Way<br />
                    Cowley<br />
                    Uxbridge<br />
                    Middlesex<br />
                    UB8 2YT </p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9355061.059208632!2d-11.88740737262711!3d55.07911953921102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48766e6bbc9a0975%3A0x710a80622363ea75!2sCatering+Hygiene+Specialists+Ltd!5e0!3m2!1sen!2suk!4v1477556975735"  height="250" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe>
                <br />
            </div>
            </div>
        </div>
    </div>
    </div>
    <?php include 'includes/footer.php'; ?>
<style>
.right-table-from input, .right-table-from select {
    margin: 0 0 5px;
    padding: 5px;
    box-sizing: border-box;
    width: 100%;
    height: 37px;
}
.right-table-from tr td:first-child {
    width: 95px;
}
h1.page-title {
    text-align: center;
    margin-left: 15px;
    background: #1A55AF;
    width: 120px;
    color: #fff;
    padding: 5px 0;
    font-size: 18px !important;
    margin-bottom: 10px;
}
.bottom-captcha .form-group.required {
    float: none;
    text-align: center;
    width: 100%;
}
.bottom-captcha .submit_btn input.submit {
    float: none;
    text-align: center;
    display: block;
    margin: 0 auto;
}
.bottom-captcha .form-group.required .g-recaptcha.required {
    float: none;
}



.contact_bg form .right-table-from table tr {
    display: flex;
    justify-content: space-between;
    width: 100%;
    box-sizing: border-box;
}
.contact_bg form .right-table-from table tr td:nth-child(2) {
    width: 66%;
}
.contact_bg form .right-table-from table tr td.text-message {
    width: 100%;
}

</style>

</body>
</html>
