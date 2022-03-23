<?php
require_once 'controller.php';
require_once 'validator.php';

class Users extends Controller
{
    public function __construct()
    {

        echo "<h1>inside users controller construct</h1>";
    }
    function index()
    {

        echo "<h1>index of users</h1>";
    }
    function show($id)
    {


        $user = $this->model('user');
        $userName = $user->select($id);
        $this->view('user_view', $userName);
    }
    function add()
    {

        echo "<h1>add of users</h1>";
    }

    function add_user()
    {
        // print_r($_POST);
        if(isset($_POST['submit']))
        {
            $phoneNumber=$_POST['phoneNumber'];
            $firstName=$_POST['firstName'];
            $lastName=$_POST['lastName'];
            $password=$_POST['password'];
            $email=$_POST['email'];
           if($firstName!=""&&$lastName!=""&&$password!=""&&$email!=""&&$phoneNumber!="")
           {
            
               $user_data =array(
                   'first_name'=>$firstName,
                   'last_name'=>$lastName,
                   'phone_number'=>$phoneNumber,
                   'password'=>md5($password),
                   'email'=>$email
                   
               );
               $u=$this->model('user');
               $message="";
               if($u->insert($user_data)){
                   $type='تم!';
                    $message="تم إضافة مستخدم جديد ,<br>
                    تسجيل الدخول ؟
                    ";
                    $this->view('login',array('type'=>$type,'message'=>$message));

                }
        
               else  {
                   $type='خطأ';
                   $message="لايمكن إضافة مستخدم جديد ! <br>
                   تحقق من البيانات
                   ";
               
                   $this->view('register',array('type'=>$type,'message'=>$message,'form_values'=>$_POST));

                }

                   //validating inputs


           } 
        
           $validtorObj=new Validator();
           $message=[];
           
           if($validtorObj->validateName($firstName)==false){
           $message[]=" خطأ في الاسم الاول";
   
           }
            
           if($validtorObj->validateName($lastName)==false){
            $message[]=" خطأ في الاسم الاخير";
    
            }
           if($validtorObj->validateEmail($email)==false){
           $message[]="خطأ في الايميل";
   
           }
           if($validtorObj->validatePhoneNumber($phoneNumber)==false){
           $message[]="خطأ في رقم الهاتف";
   
           }
           if($validtorObj->validatePassword($password)==false){
               $message[]="خطأ في كلمة السر";
       
               }
               $this->view('register',$message);
               

    }}
    function register()
    {
        $this->view('register');
    }

    function list_all()
    { $users=$this->model("user");
        $result=$users->select();
        $this->view('users_table',$result);

    }
    function status($id){
    $user=$this->model("user");
        $user->changeStatus($id);
        $this->list_all();

//        header('location:users/list_all');
        
    }




}
