<?php
    include('../config2/constants.php');
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {  $id=$_GET['id'];
       $image_name=$_GET['image_name'];
       if($image_name !="")
       {        $path="../image/food/".$image_name;
                $remove=unlink($path);
                if($remove==false)
                {
                  $_SESSION['upload']="<div class='error'>Failed to Remove Image File.</div>";
                  header('location:'.SITEURL.'admin/manage-food.php');
                  die();
                }
       }
       $sql='DELETE FROM tbl_food WHERE id=$id';
       $res=mysqli_query($conn1,$sql);
       if($res==true)
       {
         $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
         header('location:'.SITEURL.'admin/manage-food.php');
       }
       else
       {
         $_SESSION['delete']="<div class='error'>Failed to Deleted Food.</div>";
         header('location:'.SITEURL.'admin/manage-food.php');  
       }

    }
    else
    {
         $_SESSION['unauthorized']="<div class='error'>Unauthorized Acess.</div>";
         header('location:'.SITEURL.'admin/manage-food.php');
    }

?>
