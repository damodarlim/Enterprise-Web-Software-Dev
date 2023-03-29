<?php
include('includes/adminHeader.php'); 
include('includes/dbconnect.php');
include('PHP_GetDataFromDB.php');
include('PHP_DeleteStaff.php');
?>
<?php
if(isset($_POST['btnedit']))
{
      $userid=$_POST['btnedit'];

      $userName = $_POST['editUserName'];
      $email = $_POST['editEmail'];
      $contact = $_POST['editContact'];
      $role = $_POST['editRole'];
      $department = $_POST['editDepartment'];

  $sql = "UPDATE user_table SET userName='$userName', userEmail='$email', userContact='$contact', role='$role', department='$department' WHERE userID='$userid'";

  if (mysqli_query($conn, $sql)) {
          echo "<script>alert('Details Edited');</script>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

if(isset($_POST['delete']))
{
      $userid=$_POST['delete'];
echo $userid;
  $sql = "DELETE FROM user_table where userID = '$userid'";

  if (mysqli_query($conn, $sql)) {
          echo "<script>alert('Staff Deleted');</script>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

?>
<!-- Register User Modal -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="PHP_Registration.php" method="POST">

        <div class="modal-body">

            <div class="form-group row">
                  <label>User Name </label>
                  <input type="text" name="userName" class="form-control" placeholder="User Name" required>
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" placeholder="Email Address" required>
              </div>
            <div class="form-group">
                <label>Contact No.</label>
                <input type="text" name="contact" class="form-control" maxlength="11" pattern="[0-9]{3}-[0-9]{7,}" placeholder="Contact No. (xxx-xxxxxxx)" required>
            </div>
            
            <div class="form-group">
                <label>Role</label>
                <br>
                <select name="role" class="form-control" id="inpEditRole" required>
									<option selected disabled>Select Role</option>
									<option>Staff</option>
									<option>Quality Assurance Coordinator</option>
									<option>Quality Assurance Manager</option>			  
								</select>
            </div>
            <div class="form-group">
              <label>Department</label>
              <br>
              <select name="department" class="form-control" id="inpEditRole" required>
                <option disabled selected value>Select Department</option>
                <option>Student Affair</option>
                <option>Bursary</option>
                <option>Information Technology</option>
                <option>Business</option>
                <option>Tourism and Hospitality Management</option>
              </select>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">

                  <label>Password</label>
                  <input type="password" name="password" class="form-control" pattern="(?=.*\d).{8,}" maxlength="50" placeholder="Password" required>
              </div>
              <div class="col-sm-6">
                  <label>Confirm Password</label>
                  <input type="password" name="confirmpassword" class="form-control" maxlength="50" placeholder="Confirm Password" required>
              </div>
            </div>

            <div class="form-group">
              <div class="custom-control custom-checkbox small">
                <input required type="checkbox" class="custom-control-input" id="customCheck">
                <label class="custom-control-label" for="customCheck">I Agree to the <button id="tnc_btn" data-toggle="modal" data-target="#Tnc">Terms and Condition</button></label>
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="btnsignup" class="btn btn-primary">Register</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Edit User Modal -->
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="modal fade" id="editadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" id="editProfile">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
            <div class="form-group">
                <label for="editUserName"> User Name </label>
                <input type="text" name="editUserName" id="editUserName" class="form-control" placeholder="User Name" required>
            </div>
       
            <div class="form-group">
                <label for="editEmail">Email Address</label>
                <input type="email" name="editEmail" id="editEmail" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <label for="editContact">Contact No.</label>
                <input type="text" name="editContact" id="editContact"  class="form-control" placeholder="Contact No." required>
            </div>
            <div class="form-group">
                <label for="editRole">Role</label>
                <br>
                <select name="editRole" class="form-control" id="editRole" required>
									<option selected disabled>Select Role</option>
									<option>Staff</option>
									<option>Quality Assurance Coordinator</option>
									<option>Quality Assurance Manager</option>			  
								</select>
            </div>
            <div class="form-group">
              <label for="editDepartment">Department</label>
              <br>
              <select name="editDepartment" id="editDepartment" class="form-control" id="inpEditRole" required>
                <option disabled selected value>Select Department</option>
                <option>Student Affair</option>
                <option>Bursary</option>
                <option>Information Technology</option>
                <option>Business</option>
                <option>Tourism and Hospitality Management</option>
              </select>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="btnedit"  value="`+userID+`" class="btn btn-primary">Save Changes</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- T&C Modal -->
<div class="modal fade" id="Tnc" tabindex="-1" role="dialog" aria-labelledby="Tnc" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Terms and Condition</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      These Terms of Use constitute a legally binding agreement made between you, whether personally or on behalf of an entity (“you”) and  website as well as any other media form, media channel, mobile website or mobile application related, linked, or otherwise connected thereto (collectively, the “Site”).
      </div>
    </div>
  </div>
</div>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Staff Management</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <div class="row">
              <div class="d-sm-flex mr-auto p-2">
                  <h6 class="m-0 font-weight-bold text-primary">User Table</h6>
              </div>
              <div class="pt-2">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Admin Profile 
            </button>
              </div>
          </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Role</th>
                      <th>Department</th>
                      <th></th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                        
                        <?php foreach ($showStaff as $key => $staff): ?>
                            <tr>
                                <?php 
                                
                                    $thisStaffId = $staff['userID'];
                                    
                                ?>
                                <td><?php echo $staff['userID'] ?></td>
                                <td><?php echo $staff['userName'] ?></td>
                                <td><?php echo $staff['userEmail'] ?></td>
                                <td><?php echo $staff['userContact'] ?></td>
                                <td><?php echo $staff['role'] ?></td>
                                <td><?php echo $staff['department'] ?></td>
                                <td><button type="button" class="edit btn btn-primary" data-toggle="modal" data-target="#editadminprofile" value="<?php echo $staff['userID']?>"> <i class="fa fa-edit" aria-hidden="true"></i></button></td>
                                <td><button type="submit" name="delete" value="<?php echo $staff['userID']?>" class="btn btn-primary" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
               
            </table>
            </div>
            </div>
        </div>

    </div>
<!-- /.container-fluid -->

<?php
include('includes/adminFooter.php');
?>

<script>
    $(document).ready(function() {
        $('#dataTable').dataTable({
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
        });
    });
</script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<script>
  const editButton = document.querySelectorAll('.edit');

  editButton.forEach(btn => {
        btn.addEventListener('click', function handleClick(event) {
            editUser(btn.value);
        });
    });

    function editUser(userID) 
	{
		$.ajax({
			url:"PHP_EditUserProfile.php",
			method:"POST",
			data:{
				userID:userID,
                editUser:1
			},
			dataType: 'JSON',
			success: function(response){
				var len = response.length;
				for(var i=0; i<len; i++){
					var userName = response[i].userName;
          var email = response[i].email;
					var contact = response[i].contact;
          var role = response[i].role;    
          var department = response[i].department;

					var formHTML = `
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                          <div class="form-group">
                            <label for="editUserName"> User Name </label>
                            <input type="text" name="editUserName" id="editUserName" class="form-control" placeholder="" value="`+userName+`" required>
                          </div>
                          <div class="form-group">
                            <label for="editEmail">Email Address</label>
                            <input type="email" name="editEmail" id="editEmail" class="form-control" placeholder="" value="`+email+`" required>
                          </div>
                          <div class="form-group">
                            <label for="editContact">Contact No.</label>
                            <input type="text" name="editContact" id="editContact" class="form-control" placeholder="" value="`+contact+`" required>
                          </div>

                          <div class="form-group">  
                            <label for="editRole">Role</label>
                            <br>
                            <select name="editRole" class="form-control" id="editRole" value="`+role+`" required>
                            `;
                              if(role == "Staff")
                              {
                                formHTML+=`
                                <option disabled>Select Role</option>
                                <option selected="selected">Staff</option>
                                <option>Quality Assurance Coordinator</option>
                                <option>Quality Assurance Manager</option>		
                                `;
                              }	  
                              else if(role == "Quality Assurance Coordinator")
                              {
                                formHTML+=`
                                <option disabled>Select Role</option>
                                <option>Staff</option>
                                <option selected="selected">Quality Assurance Coordinator</option>
                                <option>Quality Assurance Manager</option>		
                                `;
                              }
                              else if(role == "Quality Assurance Manager")
                              {
                                formHTML+=`
                                <option disabled>Select Role</option>
                                <option>Staff</option>
                                <option>Quality Assurance Coordinator</option>
                                <option selected="selected">Quality Assurance Manager</option>		
                                `;
                              }
                              formHTML+=`
                            </select>     
                          </div>
                            
                          <div class="form-group">
                            <label for="editDepartment">Department</label>
                            <br>
                            <select name="editDepartment" class="form-control" id="editDepartment" value="`+department+`" required>
                            `;
                            if(department == "Student Affair")
                              {
                                formHTML+=`
                                <option disabled>Select Department</option>
                                <option selected="selected">Student Affair</option>
                                <option>Bursary</option>
                                <option>Information Technology</option>
                                <option>Business</option>
                                <option>Tourism and Hospitality Management</option>
                              `;
                              }
                              else if(department == "Bursary")
                              {
                                formHTML+=`
                                <option disabled>Select Department</option>
                                <option>Student Affair</option>
                                <option selected="selected">Bursary</option>
                                <option>Information Technology</option>
                                <option>Business</option>
                                <option>Tourism and Hospitality Management</option>
                                `;
                              }
                              else if(department == "Information Technology")
                              {
                                formHTML+=`
                                <option disabled>Select Department</option>
                                <option>Student Affair</option>
                                <option>Bursary</option>
                                <option selected="selected">Information Technology</option>
                                <option>Business</option>
                                <option>Tourism and Hospitality Management</option>
                                `;
                              }
                              else if(department == "Business")
                              {
                                formHTML+=`
                                <option disabled>Select Department</option>
                                <option>Student Affair</option>
                                <option>Bursary</option>
                                <option selected="selected">Information Technology</option>
                                <option>Business</option>
                                <option>Tourism and Hospitality Management</option>
                                `;
                              }
                              else if(department == "Tourism and Hospitality Management")
                              {
                                formHTML+=`
                                <option disabled>Select Department</option>
                                <option>Student Affair</option>
                                <option>Bursary</option>
                                <option>Information Technology</option>
                                <option>Business</option>
                                <option selected="selected">Tourism and Hospitality Management</option>
                                `;
                              }
                              formHTML+=`
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="btnedit"  value="`+userID+`" class="btn btn-primary">Save Changes</button>
                      </div>
					`;
					
					$("#editProfile").empty();
					$("#editProfile").append(formHTML);
				}
				if(!!document.getElementById("VariationErrorMsg"))
				{
					document.getElementById("VariationErrorMsg").remove();
				}
			},
			error: function(err) {
				//$('#login_message').html(err.responseText);
				alert(err.responseText);
			}
		});
	}

  const removeButton = document.querySelectorAll('.remove');

    removeButton.forEach(btn => {
        btn.addEventListener('click', function handleClick(event) {
            removeButton.forEach(btn => {
                document.getElementById('btndelete').value=btn.value
            });
        });
    });
    
</script>

<style>
	#tnc_btn{
		background: none;
		color: blue;
		border: none;
		padding: 0;
		font: inherit;
		cursor: pointer;
		outline: inherit;
	}
</style>