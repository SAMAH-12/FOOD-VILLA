<?php
    //Include Constants File
   include('../config2/constants.php');
    //echo "Delete Page";
    //Check whether the id and image_name value is set or not
   if(isset($_GET['id']) AND isset($_GET['image_name']))
   {  
     //Get the Value and Delete
     //echo "Get Value and Delete";
     $id=$_GET['id'];
     $image_name=$_GET['image_name'];
     //Remove the physical image file is available
     if($image_name !="")
     {
        //Image is available.so remove it
        $path="../images/category/".$image_name;
        $remove=unlink($path);
        //if failed to remove image then add an error message and stop the process
        if($remove==false)
        {
              $_SESSION['remove']="<div class='error'>Failed to Remove Category Image.</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
              die();


        }
     }
     //delete data from database
     //SQL quuery to delete data from database
     $sql ="DELETE FROM tbl_category WHERE id=$id";
     //execute query
     $res=mysqli_query($conn1,$sql);
     //check whether the data is deleted from database or not
     if($res==true)
     {
        //set sucess message and redirect
        $_SESSION['delete']="<div class='sucess'>Category Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
     }
     else
     {
       //set fail message and redirect
        $_SESSION['delete']="<div class='error'>Failed to Delete Category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
     }
     
   }
   else
   {
     //redirect to manage Category Page
      header('location:'.SITEURL.'admin/manage-category.php');
   }
?>

