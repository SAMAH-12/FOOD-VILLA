<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>

		<br><br>

		<from action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">

				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Title of the Food">
					</td>
				</tr>

				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="10" placeholder="Description of the Food."></textarea>
					</td>
				</tr>

				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price">
					</td>
			   	</tr>
				
				<tr>
					<td>Select Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				
				<tr>
					<td>Category: </td>
					<td>
						<select name="Category">
							
							<?php
								//Create PHP Code to display categories from Database
								//1. CReate SQL to get all active categories from database
								$sql = "SELECT * FROM tbl_category WHERE active='Yes'";

								//Executing qUery
								$res = mysqli_query($conn1, $sql);

								//Count Rows to check whether we have categories or not
								$count = mysqli_num_rows($res);

								//IF Count is greater than zero, we have categories else we donot have categories
								if($count>0)
								{
									//WE have categories
									while($row=mysqli_fetch_assoc($res))
									{
										//get the details of categories
										$id = $row['id']; 
										$title=$row['title'];
										
										?>


										<option value="<?php echo $id; ?>"><?php echo $title; ?></option>

										<?php
									}
								}
								else
								{
									//WE do not have category
									?>
									<option value="0">No Category Found</option>
									<?php
								}

								//2. Display on Drpopdown
							?>

						</select>
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes">Yes
						<input type="radio" name="featured" value="No">No
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
                    <td>
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">

                    </td>
                </tr>

			</table>

		</form>
		
		<?php
		
		//Check whether the button is clicked or not
		if(isset($_POST['submit']))
		{
			//Add the Food in Database
			//echo "clicked";

			//1. Get the DAta from Form
			$title = $_POST['title']; 
			$description = $_POST['description'];
			$price = $_POST['price']; 
			$category = $_POST['category'];

			//check whether radion button for featured and active are checked or not
			if(isset($_POST['featured']))
			{
				$featured = $_POST['featured'];
			}
			else
			{
				$featured = "No"; //Setting the Default value
			}

			if(isset($_POST['active']))
			{
				$active = $_POST['active'];
			}
			else
			{
				$active = "No"; //Setting Default value
			}

			//2. Upload the Image if selected
            if(isset($_FILES['image']['name'])){
                $image_name=$FILE['image']['name'];

                if($image_name!=""){
                    $ext= end(explode('.',$image_name));

                    $image_name="Food-Name-".rand(0000,9999).".".$ext;

                    $src=$_FILES['image']['tmp_name'];
                    $dst="../images/food/".$image_name;

                    $upload =move_uploaded_file($src,$dst);

                    if($upload==false){
                        $_SESSION['upload']="<div class='error'>Failed to upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();
                    }
                }
               
            }
            else{
                    $image_name="";
            }

			//3. Insert Into Database

            $sql2="INSERT INTO tbl_food SET 
                  title='$title',
                  description='$description',
                  price=$price,
                  imahe_name='$image_name',
                  category_id=$category,
                  featured='$featured',
                  active='$active'

            
            ";

            $res2=mysqli_query($conn1,$sql2);
            if($res2==true){
                $_SESSION['add']="<div class='sucess'> Food Successfully.</div>";
                header('location:'.SITEURL.'/admin/manage-food.php');

            }
            else{
                $_SESSION['add']="<div class='error'> Failed to add food.</div>";
                header('location:'.SITEURL.'/admin/manage-food.php');
            }

			//4. Redirect with Message to Manage Food page
        }
		?>

	</div>
</div>

<?php include('partials/footer.php'); ?>
