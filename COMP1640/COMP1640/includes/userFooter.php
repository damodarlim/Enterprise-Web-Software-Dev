</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; COMP1640 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Create Ideas Modal -->
    <form method="post" enctype="multipart/form-data" action="PHP_CreateIdea.php">
        <div class="modal fade" id="createIdeaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Create New Idea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-xl-3 col-lg-3 col-sm-12">
                            <label for="inpCategory">Topic</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-sm-12">
                            <select class="form-select" name="ideaTopic" required>
                                <option disabled selected value>Choose a topic</option>
                                <?php 
                                    foreach ($showTopic as $Topic): 
                                ?>
                                <option value="<?php echo $Topic['topicID'] ?>"><?php echo $Topic['topicName'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-3 col-lg-3 col-sm-12">
                            <label for="ideaTitle">Title</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-sm-12">
                            <input type="text" name="ideaTitle" class="form-control" id="ideaTitle" placeholder="Your Idea Title ..." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-3 col-lg-3 col-sm-12">
                            <label for="ideaDesc">Description</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-sm-12">
                            <textarea name="ideaDesc" class="form-control" id="ideaDesc" placeholder="Your Description ..." required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-3 col-lg-3 col-sm-12">
                            <label for="uploadFile">File</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-sm-12">
                            <input type="file" name="uploadFile[]" class="form-control" id="uploadFile" accept="video/*,image/*" multiple>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ideaTnc" value="1" id="ideaTnc" required>
                        <label class="form-check-label" for="btntnc">
                         Agree <button type="button" id="btntnc" data-toggle="modal" data-target="#Tnc"> Terms and Condition</button>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ideaAnoymous" value="1" id="ideaAnoymous">
                        <label class="form-check-label" for="btntnc">
                            Post Anonymously
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btncreate" class="btn btn-primary" value="<?php echo $_SESSION["id"]?>">Create</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="Homepage.php?logout='1'">Logout</a>
                </div>
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

    <style>
        #btntnc{
            background: none;
            color: blue;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }
    </style>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="js/CheckFileValidation.js"></script>


