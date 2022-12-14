<?php include('partials/menu.php');?>
<div class="main-content">
<div class="wrapper">
<h1>Add Category</h1>
<br><br>
<?php

       if(isset($_SESSION['add']))
       {
          echo $_SESSION['add'];
          unset($_SESSION['add']);
       }

       if(isset($_SESSION['upload']))
       {
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
       }
?>

<br><br>

                <!--Add Category Form Starts-->
                <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                             <tr>
                                  <td>Title: </td>
                                  <td>
                                       <input type="text" name="title" placeholder="Category Title">
                                  </td>  
                             </tr>
                             <tr>
                                   <td>Select Image: </td>
                                   <td>
                                        <input type="file" name="image">
                                   </td>

                             </tr>
                             <tr>
                                  <td>Featured: </td>
                                  <td>
                                       <input type="radio" name="featured" value="Yes"> Yes
                                       <input type="radio" name="featured" value="No"> No
                                  </td>  
                             </tr>
                             <tr>
                                  <td>Active: </td>
                                  <td>
                                       <input type="radio" name="active" value="Yes">Yes
                                       <input type="radio" name="active" value="No">No
                                  </td>  
                             </tr>
                             <tr>
                                  <td colspan="2">
                                       <input type="submit" name="submit" value="Add category" class="btn-secondary">  
                                  </td>  
                             </tr>                        
                </table>
               
                </form>
                <!--Add Category Form Ends-->  
               <?php
                      //check whether the submit button is clicked or not
                      if(isset($_POST['submit']))
                      {
                          //1. Get the value from category form
                          $title=$_POST['title'];
                          //for radio input,we need to check whether the button is clicked or not
                          if(isset($_POST['featured']))
                          {       //Get the value from form
                                  $featured=$_POST['featured'];

                                 
                          }
                          else
                          {      //set default value
                                  $featured="No";
                          }
                          if(isset($_POST['active']))
                          {       //Get the value from form
                                  $active=$_POST['active'];
                                  
                          }
                          else
                          {      //set default value
                                  $active="No";
                                 
                          }

                          //check whether the image is selected or not and set value for image name accordingly
                         //  print_r($_FILES['image']);

                         //  die();
                         //break the code here
                         if(isset($_FILES['image']['name'])){
                              //upload the image

                              //Upload image if image is selected
                              if($image_name!=""){

                              
                              //to upload the image we need image name and source path and destination path
                              $image_name=$_FILES['image']['name'];
                              // auto rename our image
                              //get the extension of our image (jpg,png,gif,etc) eg :"food.jpg"
                              
                              $ext=end(explode('.',$image_name));

                              //rename the image
                              $image_name="Food_Category_".rand(000,999).'.'.$ext;
                              
                              $source_pat=$_FILES['image']['tmp_name'];
                              $destination_path="../images/category/".$image_name;

                              //finally upload image
                              $upload=move_uploaded_file($source_pat,$destination_path);

                              //check whether the image is uploaded or not and if the image is not uploaded then we will stop the process and redirect with error message
                              if($upload==false){
                                   //set message
                                   $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                                   //redirect to add category page
                                   header('location:'.SITEURL.'admin/add-category.php');
                                   //STOP PROCESS
                                   die();
                              }
                         }
                         }
                         else{ 
                              $image_name="";
                              //don't upload image and set the image name value as blank
                         }
                          //2. crate SQL Query to insert into Data Base
                          $sql ="INSERT INTO tbl_category SET
                               title='$title',
                               image_name='$image_name',
                               featured='$featured',
                               active='$active'";
                          //3. execute the query and save in database

                          $res=mysqli_query($conn1,$sql);

                          
                          //4. checxk whether the query is executed or not and data is added or not
                          if($res==true){
                              //query executed and category added
                              $_SESSION['add']="<div class='success'>Category Added Successfully.</div>";
                              //Redirect to manage Category page
                              header('location:'.SITEURL.'admin/manage-category.php');
                          }
                          else{
                              //fail to add caregory
                              $_SESSION['add']="<div class='error'>Failed to add Category</div>";
                              //Redirect to manage Category page
                              header('location:'.SITEURL.'admin/add-category.php');
                          }
                       }

               ?>
             
</div>
</div>

<?php include('partials/footer.php');?>


