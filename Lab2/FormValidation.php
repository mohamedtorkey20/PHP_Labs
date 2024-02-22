<?php
 require_once "vendor/autoload.php";

$ErrorName=$ErrorEmail=$ErrorMessage='';
$flag_name=$flag_email=true;
$flag=false;
$data=[];

$name = isset($_POST['name']) ? $_POST['name'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$message = isset($_POST['message']) ? $_POST['message'] : "";


if (isset($_POST['submit'])) {

    foreach ($_POST as $key => $value)
    {
// -----------check on empty Fields--------------------------------------
       if(empty($value))
       {
           if($key=="name")
           {
            $ErrorName="*Name is Required!";
           }elseif($key=="email")
           {
            $ErrorEmail="*Email is Required!";
           }elseif($key=="message")
           {
            $ErrorMessage="*Message is Optaion";
           }
       }else{
  // -----------check on Valiate Fields--------------------------------------
      
          if(($key=="name"&& strlen($value)>=MAX_LENGTH )|| ($key=="name"&& (is_numeric($value))))
          {
            $ErrorName="*Invalid Name!";
            $flag_name=false;
          }elseif($key=="email" && !(filter_var($value,FILTER_VALIDATE_EMAIL)))
          {
            $ErrorEmail="*Invalid Email!";
            $flag_email=false;
          }else{
            array_push($data,"$value");
            
            
            
          }
       }
    }
}

if(count($data)==4){
    store_data($email,$name);
}
//---------------------Clear Fields------------------------------------------- 
if(isset($_POST['clear']))
{
    $name=$email=$message=" ";
}

?>
<html>
    <head>
        <title> contact form </title>

   <link rel="stylesheet" href="style.css">
    </head>

    <body>


    <?php
    
    if(count($data)<4){
    ?>
       
       
       <form id="contact_form" class="container" method="POST" enctype="multipart/form-data">
            <h3> Contact Form </h3>

            <div class="row">
                <label class="required" for="name">Your name:</label><br />
                <input id="name" class="input" name="name" type="text" value="<?php if($flag_name){echo $name;}else{echo " ";}?>" size="30" /><br />
                <p style="color:red"><?=$ErrorName?></p>
            </div>
            <div class="row">
                <label class="required" for="email">Your email:</label><br />
                <input id="email" class="input" name="email" type="text" value="<?php if($flag_email){echo $email;}else{echo " ";}?>" size="30" /><br />
                <p style="color:red"><?=$ErrorEmail?></p>
            </div>
            <div class="row">
                <label class="required" for="message">Your message:</label><br />
                <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />
                <p style="color:red"><?=$ErrorMessage?></p>
            </div>

            <input id="submit" name="submit" type="submit" value="Send email" />
            <input id="clear" name="clear" type="reset" value="clear form" />

        </form>
        <?php
        }
        else
        {
          
        ?>

        <div id="after_submit">
            <h3><?=MESSAGE_THANK?></h3>
            <p>Name:<span><?=$data[0];?></span></p>
            <p>Email:<span><?=$data[1];?></span></p>
            <p>Message:<span><?=$data[2];?></span></p>
            <a href="show_data.php">See All Data</a>
        </div>
        <?php }
        ?>
    </body>

</html>