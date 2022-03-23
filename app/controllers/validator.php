<?php
//Validator calss 
class Validator{


    //method for Validating the name
function validateName($name):bool{
    if(strlen($name)>0&&$name<40)
    return true;
    else
    return false;

}
    //Validating email method
function validateEmail($email):bool{
if(filter_var($email,FILTER_VALIDATE_EMAIL))
return true;
else
return false;

}
    //Validating phonenumber method

function validatePhoneNumber($phoneNumber):bool{
    if($phoneNumber>0&&$phoneNumber<20)
    return true;
    else
    return false;
    
    }

    //Validating pass method

    
function validatePassword($pass):bool{
    if(strlen($pass)>0&&$pass<40)
    return true;
    else
    return false;

}
}

?>