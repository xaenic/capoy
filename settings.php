<?php

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./login.php");
}
$id = $_SESSION['id'];
$servername = "localhost";
$username = "root";
$password = "";
$database = "sitin";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection === false) {
    die("connection error");
}
$students = [];
$query = "SELECT * FROM sessions INNER JOIN students ON students.id = sessions.student_id WHERE id = '$id' ORDER BY time_out";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }
$student = "";
$query = "SELECT * FROM students WHERE id = '$id' LIMIT 1";
$result = mysqli_query($connection, $query);
if($result && mysqli_num_rows($result) > 0)
{
        $student = mysqli_fetch_assoc($result);
}

$message = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){


    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $midname = $_POST['midname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $password = $_POST['password'];
    if($student['password'] == $password){
       $query = "UPDATE students 
          SET firstname = '$firstname', 
              lastname = '$lastname', 
              midname = '$midname',
              age = '$age',
              gender = '$gender',
              email = '$email',
              address = '$address',
              contactno = '$contactno' 
          WHERE id = '$id'";


        
        $result = $connection->query($query);
            $student['firstname'] = $firstname;
            $student['lastname'] = $lastname;
            $student['midname'] = $midname;
            $student['age'] = $age;
            $student['gender'] = $gender;
            $student['address'] = $address;
            $student['contactno'] = $contactno;
            $student['email'] = $email;
        $message = '<span class="text-green-500 text-center">Updated Successfully!</span>';
    }else {
         $message =  '<span class="text-red-500 text-center">Incorrect Password</span>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home</title>
</head>
<body style="background-image: url('./background.jpg'); background-repeat: no-repeat; background-size: cover;">
    

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">U-Sitin</span>
      </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-200 dark:border-gray-100" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-200">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="./home.php" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-[#2672E3] dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ms-3 hover:text-white ">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="./history.php" class="flex items-center text-[#2672E3] p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
               </svg>
               <span class="flex-1 ms-3 hover:text-white text-gray-700 whitespace-nowrap">History</span>
            </a>
         </li>
          <li>
            <a href="./report.php" class="flex items-center text-[#2672E3] p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
               </svg>
               <span class="flex-1 ms-3 hover:text-white text-gray-700 whitespace-nowrap">Report</span>
            </a>
         </li>
         <li>
            <a href="./settings.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                  <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
               </svg>
               <span class="flex-1 ms-3 hover:text-white text-gray-700 whitespace-nowrap">Settings</span>
            </a>
         </li>
         <li>
            <a href="./logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
               </svg>
               <span class="flex-1 ms-3 hover:text-white text-gray-700 whitespace-nowrap">Sign-Out</span>
            </a>
         </li>
      </ul>
   </div>
</aside>
<main class="flex justify-center ml-72 text-black mt-20 ">
    <div class="flex flex-col">
      <span class="text-xl text-gray-700 text-left">Profile Settings</span>
      <?php echo $message;?>
      <div class="flex justify-start mt-5">
        <form action="" method="post" class="border border-gray-400 rounded-md p-10 grid grid-cols-2 gap-4">
        <div class="flex justify-between items-center">
            <label>First Name</label>
            <input  name="firstname"class="border border-gray-400 px-3 p-2 rounded-md " type="text" value="<?php echo $student['firstname'];?>" />
        </div>
        <div class="flex justify-between items-center">
            <label>First Name</label>
            <input  name="lastname"class="border border-gray-400 px-3 p-2 rounded-md " type="text" value="<?php echo $student['lastname'];?>" />
        </div class="flex justify-between items-center">
         <div>
            <label>Middle Name</label>
            <input  name="midname"class="border border-gray-400 px-3 p-2 rounded-md " type="text" value="<?php echo $student['midname'];?>" />
        </div>
         <div class="flex justify-between items-center">
            <label>Age</label>
            <input  name="age"class="border border-gray-400 px-3 p-2 rounded-md " type="text" value="<?php echo $student['age'];?>" />
        </div>
         <div class="flex justify-between items-center">
            <label>Gender</label>
            <input  name="gender"class="border border-gray-400 px-3 p-2 rounded-md " type="text" value="<?php echo $student['gender'];?>" />
        </div>
         <div class="flex justify-between items-center">
            <label>Contact</label>
            <input  name="contactno"class="border border-gray-400 px-3 p-2 rounded-md " type="text" value="<?php echo $student['contactno'];?>" />
        </div>
         <div class="flex justify-between items-center">
            <label>Enail</label>
            <input  name="email" class="border border-gray-400 px-3 p-2 rounded-md " type="text" value="<?php echo $student['email'];?>" />
        </div>
         <div class="flex justify-between items-center">
            <label>Address</label>
            <input name="address" class="border border-gray-400 px-3 p-2 rounded-md " type="text" value="<?php echo $student['address'];?>" />
        </div>
        <div class="flex gap-2 items-center col-span-2">
            <label>Password</label>
            <input class="w-full border border-gray-400 px-3 p-2 rounded-md " type="password" name="password" />
        </div>
        <div></div>
        <div class="flex justify-end">
            <button class="bg-green-600 text-white px-3 p-2 rounded-md">Update Profile</button>
        </div>
      </form>
      </div>
    </div>
</main>
</body>
</html>