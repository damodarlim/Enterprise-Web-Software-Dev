<?php
    require_once('PHP_Logout.php');
    include('PHP_GetDataFromDb.php');  
    include('PHP_DeleteIdea.php');
    include('PHP_CreateIdea.php');
    include('PHP_ManageCategory.php');
    include('PHP_ManageTopic.php');
	include('includes/adminHeader.php');
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 mr-auto p-2">Idea</h1>
            <?php if($_SESSION['role'] == 'Quality Assurance Manager'): ?>
            <a href="PHP_ExportIdea.php" class="btn btn-success p-2" style="margin:0 10px 0 0;">Download All Ideas Data</a>
            <a href="PHP_ExportDocument.php" class="btn btn-success p-2" style="margin:0 10px 0 0;">Download All Ideas Document</a>

            <?php endif ?>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Idea Management</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="d-sm-flex col-xl-4 col-lg-4 col-sm-12 mr-auto p-2">
                                <div class="input-group mb-3 ">
                                <?php if($_SESSION['role'] == 'Quality Assurance Manager'): ?>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#manageCategoryModal">Category</button>
                                <?php elseif($_SESSION['role'] == 'Quality Assurance Coordinator'): ?>
                                <h6 class="m-0 font-weight-bold text-primary">Category</h6>
                                <?php endif ?>
                                </div>
                            </div>
                            <div class="p-2">
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addNewTopicModal">Add New Topic</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <form method="post">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Popularity</th>
                                <th>Topic</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Document</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php foreach ($showIdeas as $key => $idea): ?>
                            <tr>
                                <td>
                                <?php 
                                
                                    $thisIdeaId = $idea['ideaID'];
                                    $getLikeTotalQuery = "SELECT COUNT(likeDislike) FROM like_table WHERE likeDislike = 'like' AND ideaID =$thisIdeaId";
                                    $executeGetLikeTotalQuery = mysqli_query($conn, $getLikeTotalQuery);
                                    $getLikeTotal = mysqli_fetch_array($executeGetLikeTotalQuery);

                                    $getDislikeTotalQuery = "SELECT COUNT(likeDislike) FROM like_table WHERE likeDislike = 'dislike' AND ideaID =$thisIdeaId";
                                    $executeGetDislikeTotalQuery = mysqli_query($conn, $getDislikeTotalQuery);
                                    $getDislikeTotal = mysqli_fetch_array($executeGetDislikeTotalQuery);

                                    echo ("👍🏼" . $getLikeTotal[0] . " 👎🏼" . $getDislikeTotal[0]);
                                    
                                ?>
                                </td>
                                <td><?php echo $idea['topicName'] ?></td>
                                <td><?php echo $idea['ideaTitle'] ?></td>
                                <td><?php echo $idea['ideaDesc'] ?></td>
                                <td><?php echo $idea['cateName'] ?></td>
                                <td><a href="<?php echo 'PHP_DownloadDocument.php?downloadDocument='. $idea['ideaID'] ?>" class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                <td><a href="<?php echo 'PHP_DownloadIdea.php?download='. $idea['ideaID'] ?>" class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                <td><button type="submit" name="btndelete" value="<?php echo $idea['ideaID']?>" class="btn btn-primary" data-toggle="modal" data-target="#deleteIdea"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Create Topic Modal -->
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal fade" id="addNewTopicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Create New Topic for Collecting Ideas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-xl-3 col-lg-3 col-sm-12">
                                <label for="topicName">New Topic</label>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-sm-12">
                                <input type="text" name="topicName" class="form-control" id="inpTopic" placeholder="Insert New Topic..." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-3 col-lg-3 col-sm-12">
                                <label for="inpCategory">Category</label>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-sm-12">
                                <select class="form-select" name="topicCategory" required>
                                    <option disabled selected value>Choose a category</option>
                                    <?php foreach ($showCategory as $Category): ?>
                                    <option value="<?php echo $Category['cateID'] ?>"><?php echo $Category['cateName'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-3 col-lg-3 col-sm-12">
                                <label for="inpStartDate">Start Date</label>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-sm-12">
                                <input type="date" id="datePickerStart" name="startDate" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d"); ?>" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-3 col-lg-3 col-sm-12">
                                <label for="inpEndDate">End Date</label>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-sm-12">
                                <input type="date" id="datePickerEnd" name="endDate" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d"); ?>" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-3 col-lg-3 col-sm-12">
                                <label for="inpFinalDate">Final Closure Date</label>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-sm-12">
                                <input type="date" id="datePickerFinal" name="finalDate" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d"); ?>" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btnaddtopic" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Manage Category-->
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal fade" id="manageCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Manage Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-xl-3 col-lg-3 col-sm-12">
                                <label for="cateName">New Category</label>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-sm-12">
                                <input type="text" name="cateName" class="form-control" id="inpTitle" placeholder="Insert New Category...">
                            </div>
                            
                        </div>
                        <?php foreach ($showCategory as $category): ?>
                            
                        <div class="row mb-3">
                        <div class="col-xl-3 col-lg-3 col-sm-12">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-sm-12">
                                <label for="inpCategory"><?php echo $category['cateName']?></label>
                                <button type="submit" name="btndelcate" value="<?php echo $category['cateID']?>" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btnaddcate" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php
	include('includes/adminFooter.php') 
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