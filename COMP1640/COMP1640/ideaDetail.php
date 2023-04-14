<?php
	include('includes/userHeader.php');
    include('PHP_Like.php');
    if (isset($_GET['id'])) 
    {
		$Ideas = getIdea($_GET['id']);
        $_SESSION['idea_id'] = $_GET['id'];
	}
    include('PHP_Comment.php');
?>
    <link href="css/ideaDetail.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Begin Page Content -->
    <?php foreach ($Ideas as $idea): ?>
    <div class="container-fluid">
        <div class="bg-lg">
            <div class="bg-overlay" style="background-color: #16a085; opacity:100%;">
            </div>

            <div class="bg-title">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto" >
                        <div class="idea mb-4">
                            <h1 style="font-weight: bold;font-size: 3rem;">Idea Title: <?php echo $idea['ideaTitle']; ?></h1>
                            <?php if($idea['anoymous'] == 0): ?>
                            <h2 style="font-weight: bold;font-size: 1rem;">Username: <?php echo $idea['userName'] ?></h2>
                            <?php endif ?>
                            <?php if($idea['anoymous'] == 1): ?>
                            <h2 style="font-weight: bold;font-size: 1rem;">Username: Anonymous Staff</h2>
                            <?php endif ?>
                            <div class="row">
                                <div class="col-lg-4">
                                    <p class="text-left">Start Date: <?php echo $idea['startDate']; ?></p>
                                    <p class="text-left">End Date: <?php echo $idea['endDate']; ?></p>
                                    <p class="text-left">Final Closure Date: <?php echo $idea['finalClosureDate']; ?></p>
                                </div>
                                <div class="col-lg-8 text-center">
                                    <i <?php if (userLiked($idea['ideaID'])): ?>
                                        class="fa fa-thumbs-up like-btn"
                                    <?php else: ?>
                                        class="fa fa-thumbs-o-up like-btn"
                                    <?php endif ?>
                                    aria-hidden="true" data-id="<?php echo $idea['ideaID']; ?>"></i>
                                    <span class="likes"><?php echo getLikes($idea['ideaID']); ?></span>
                                    &nbsp
                                    <i <?php if (userDisliked($idea['ideaID'])): ?>
                                        class="fa fa-thumbs-down dislike-btn"
                                    <?php else: ?>
                                        class="fa fa-thumbs-o-down dislike-btn"
                                    <?php endif ?>
                                    aria-hidden="true" data-id="<?php echo $idea['ideaID']; ?>"></i>
                                    <span class="dislikes"><?php echo getDislikes($idea['ideaID']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="idea mb-4">
                    <p style="font-size: 1.2rem;">Description: <?php echo $idea['ideaDesc'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach ?>

        <!--Comment Part-->
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="idea mb-4">
                <form class="clearfix"  action="PHP_SubmitComment.php" method="POST" id="comment_form">
                    <?php if($idea['finalClosureDate'] >= date("Y-m-d")): ?>
					<textarea name="commentContent" id="commentContent" class="form-control" cols="30" rows="3"></textarea>
                    <br>
					<button class="btn btn-primary btn-sm pull-right" style="width:300px; font-size:18px;"id="submit_comment" name="submit_comment" value="<?php echo $_GET['id']?>">Comment</button>
                    <?php else:?>
                    <p>Final Closure Date is ended...</p>
                    <?php endif?>
				</form>
                <p class="font-size:1.5rem;"><span id="comments_count" ><?php echo count($comments) ?></span> Comment(s)</p>
                <hr>
                    <div id="comments-wrapper">
                    <?php if (isset($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment clearfix">
                            <div class="row comment-details">
                                <div class="col-xl-4">
                                    <p style="font-size: 1rem;"><span class="comment-name"><?php echo getUsernameById($comment['userID']) ?></span></p>
                                </div>
                                <div class="col-xl-8 text-right">
                                    <p style="font-size: 1rem;"><span class="comment-date"><?php echo date("F j, Y ", strtotime($comment["dateTime"])); ?></span></p>
                                </div>
                                <br>
                            </div>
                            <div class="row ">
                                <div class="col-xl-12 border rounded" style="background-color:white;">
                                <p style="font-size: 1.1rem;"><?php echo $comment['commentContent']; ?></p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    <?php endforeach ?>
                    <?php endif ?>
                    </div>
                    <!-- // comments wrapper -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


<?php
	include('includes/userFooter.php') 
?>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<!--Like / Dislike-->
<script src="js/like.js"></script>