<?php
    include('PHP_Like.php');
    include('includes/userHeader.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid" >

        <div class="bg-lg" >
            <div class="bg-overlay" style="background-color: #16a085; opacity: 1.0;">

            </div>
            <div class="bg-title">
                <img src= "img\IH_Logo_2.png" width="300" height="225" style="margin-top: -50px; margin-left: -400px;"/> <p style="font-size: 4rem; text-align:center; margin-top: -160px; margin-left:30px;"><font color="white">Idea</font><font color="black">Hub</font></p>

            </div>
        </div>
        <!-- Page Heading -->
        <div class="row">
            
            <div class="col-lg-8 col-md-10 mx-auto" style="text-align:right; margin-top:50px;">
                <div class="row">          
                    <div class="col-xl-2 col-lg-2 col-sm-0">                        
                    <?php if(isset($_SESSION['username'])): ?>
                        <div>
                            <button type="button" class="btn btn-primary btn-sticky" data-toggle="modal" data-target="#createIdeaModal" style="margin: -102px -1050px 10px 0; width:300px;">Create Idea</button>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
<br>

<br>

<br>
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
    <div class="table-responsive">
    <table class="table" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($showIdeas as $idea): ?>
            <tr><td>
            <div class="idea mb-4">
                <a class="idea-tag" href="<?php 
                if(isset($_SESSION['username']) )
                {
                        echo 'ideaDetail.php?id=' . $idea['ideaID'];
                    
                }
                ?>">
                <div class="abc">
                    <?php if($idea['anoymous'] == 0): ?>
                        <p style="font-size: 1rem;"><?php echo $idea['userName'] ?></p>
                    <?php elseif($idea['anoymous'] == 1): ?>
                        <p style=" bold;font-size: 1rem;">Anonymous Staff</p>
                    <?php endif; ?>
                    <p style="font-weight: bold;font-size: 1.55rem;"><?php echo $idea['userName']?></p>
                    <div class="row">
                        <div class="col-lg-4">
                            <p style="font-size: 1rem;"><?php echo $idea['cateName'] ?></p>
                            <p style="font-size: 1.5rem;"><?php echo $idea['ideaTitle'] ?></p>
                        </div>
                        <div class="row col-lg-12">
                            <div class="col-lg-6" style="text-align: end;">
                                <p style="font-size: 1rem;">👍🏼<?php echo getLikes($idea['ideaID']); ?></p>
                            </div>
                            <div class="col-lg-" style="text-align: end;">
                                <p style="font-size: 1rem;">👎🏼<?php echo getDislikes($idea['ideaID']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                </a>
            </div>
            </td></tr>
        <?php endforeach ?>
    </tbody>
    </table>
    </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->
<?php
include('includes/userFooter.php') 
?>

<script>
    $(document).ready(function() {
        $('#dataTable').dataTable({
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
        });
    });
</script>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
