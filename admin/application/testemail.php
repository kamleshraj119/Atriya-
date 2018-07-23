<?php
require ("Mailer.class.php");
$mailer = new Mailer;
$email="siddharthitpro@gmail.com";
$emailfrom = "admin@skillchamps.in";
$fromname = "Skill Champs";
$subject = "Skill Champs- You have successfully Registered";
$message = "<table style='width: 100%;' cellpadding='0' cellspacing='0'>".
"        <tr>".
"            <td style='background: #fff; height: 100px;' align='center'><img width='400px;' src='http://skillchamps.in/assets/images/mailer/logo.png'></td>".
"        </tr>".
"        <tr>".
"            <td style='background:#4d4d4d;'><img width='100%;' src='http://skillchamps.in/assets/images/mailer/banner.jpg'></td>".
"        </tr>".
"        <tr>".
"            <td style='background:radial-gradient(#757474 5%, #4d4d4d 60%); padding:150px 100px 150px 100px;'>".
"                <h1 style='color: #fff;'>Hi XYZ,</h1>".
"                <br>".
"                <p style='color: #fff; font-size: 38px; text-align: justify;'>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>".
"                <br>".
"                <br>".
"                <p style='color: #fff; font-size: 38px;'>Sincerely</p>".
"            </td>".
"        </tr>".
"        <tr>".
"            <td style=''>".
"                <a href='http://skillchamps.in/index.php?action=register-candidate' target='_blank'>".
"                           <img width='100%' src='http://skillchamps.in/assets/images/mailer/mobilize.png'>".
"                           </a>".
"            </td>".
"        </tr>".
"        <tr>".
"            <td style=''>".
"                <a href='http://skillchamps.in/skill-mitra.php?action=videos&status=Pending' target='_blank'>".
"                           <img width='100%' src='http://skillchamps.in/assets/images/mailer/verify.png'>".
"                           </a>".
"            </td>".
"        </tr>".
"        <tr>".
"            <td style=''>".
"                <a href='http://skillchamps.in/skill-mitra.php?action=connected-candidates' target='_blank'>".
"                           <img width='100%' src='http://skillchamps.in/assets/images/mailer/profile-completion.png'>".
"                           </a>".
"            </td>".
"        </tr>".
"        <tr style='background-color: #fcc512;'>".
"            <td style='padding: 50px;' align='center'>".
"                <a href='http://skillchamps.in/skill-mitra.php' target='_blank'>".
"                           <img style='width: 250px;' src='http://skillchamps.in/assets/images/mailer/start-btn.png'>".
"                           </a>".
"            </td>".
"        </tr>".
"    </table>";
$mailer -> sendMail($email, $emailfrom, $subject, $message, "", "");
?>