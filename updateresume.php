<?php
    $title = "Create resume | Resume builder";
    require './assets/includes/header.php';
    require './assets/includes/navbar.php';
    $fn->authPage();
    $slug = $_GET['resume'] ?? '';

    $resumes = $db->query("SELECT * FROM resumes WHERE (slug = '$slug' AND user_id=".$fn->Auth()['id'].") ");
    $resume = $resumes->fetch_assoc();
    if(!$resume){
        $fn->redirect('myresumes.php');
    }

    $exps = $db->query("SELECT * FROM experiences WHERE (".$resume['id'].") ");
    $exps = $exps->fetch_all(1);

    $edus = $db->query("SELECT * FROM educations WHERE (".$resume['id'].") ");
    $edus = $edus->fetch_all(1);

    $skills = $db->query("SELECT * FROM skills WHERE (".$resume['id'].") ");
    $skills = $skills->fetch_all(1);
?>

    <div class="container">

        <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
            <div class="d-flex justify-content-between border-bottom">
                <h5>Create Resume</h5>
                <div>
                    <a class="text-decoration-none" onclick="history.back()"><i class="bi bi-arrow-left-circle"></i> Back</a>
                </div>
            </div>
        <div>

                <form action="actions/createresume.action.php" method="POST" class="row g-3 p-3">
                    <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
                    <div class="col-12">
                        <label class="form-label">Resume title</label>
                        <input type="text" name="resume_title" placeholder="Web design" class="form-control" value="<?= @$resume['resume_title'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" value="<?= @$resume['full_name'] ?>" name="full_name" placeholder="Zweena" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" value="<?= @$resume['email_id'] ?>" name="email_id" placeholder="dev@abc.com" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Objective</label>
                        <textarea class="form-control" name="objective"><?= @$resume['objective'] ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mobile No</label>
                        <input type="number" name="mobile_no" value="<?= @$resume['mobile_no'] ?>"placeholder="9569569569"
                            class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" name="dob" value="<?= date('d-m-Y', $resume['dob']) ?>" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select class="form-select" name="gender">
                            <option <?= ($resume['gender']== 'Male' ? 'selected':'')?>>Male</option>
                            <option <?= ($resume['gender']== 'Female' ? 'selected':'')?>>Female</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Religion</label>
                        <select class="form-select" name="religion">
                            <option <?= ($resume['religion']== 'Hindu' ? 'selected':'')?>>Hindu</option>
                            <option <?= ($resume['religion']== 'Muslim' ? 'selected':'')?>>Muslim</option>
                            <option <?= ($resume['religion']== 'Sikh' ? 'selected':'')?>>Sikh</option>
                            <option <?= ($resume['religion']== 'Christian' ? 'selected':'')?>>Christian</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nationality</label>
                        <select class="form-select" name="nationality">
                            <option <?= ($resume['nationality']== 'Asian' ? 'selected':'')?>>Asian</option>
                            <option <?= ($resume['nationality']== 'South east' ? 'selected':'')?>>South east</option>
                            <option <?= ($resume['nationality']== 'Europe' ? 'selected':'')?>>Europe</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Marital Status</label>
                        <select class="form-select" name="marital_status">
                            <option <?= ($resume['marital_status']== 'Married' ? 'selected':'')?>>Married</option>
                            <option <?= ($resume['marital_status']== 'Single' ? 'selected':'')?>>Single</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Hobbies</label>
                        <input type="text" name="hobbies" value="<?= @$resume['hobbies']?>" placeholder="Reading Books, Watching Movies" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Languages Known</label>
                        <input type="text" name="languages" value="<?= @$resume['languages']?>" placeholder="English" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label for="inputAddress" class="form-label"> Address</label>
                        <input type="text" class="form-control" value="<?= @$resume['address']?>" id="inputAddress" placeholder="1234 Main St" name="address" required>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5 class=" text-secondary"><i class="bi bi-briefcase"></i> Experience</h5>
                        <div>
                            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addexp"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">

                    <?php 
                        if($exps){
                            foreach($exps as $exp){
                                ?>
                                <div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6><?= $exp['position'] ?></h6>
                                    <a href=""><i class="bi bi-x-lg"></i></a>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                    <i class="bi bi-buildings"></i> <?= $exp['company']?>(<?= $exp['started'].'-' .$exp['ended']?>)
                                </p>
                                <p class="small text-secondary m-0" style="">
                                    <?= $exp['job_desc']?>
                                </p>

                            </div>
                        </div>

                                <?php
                            } 
                        } else{
                            ?>
                            <div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>I'm a fresh graduate</h6>
                                </div>
                                <p class="small text-secondary m-0" style="">
                                    If you have experience, you can add it
                                </p>

                            </div>
                        </div>

                            <?php
                        }
                    ?>

                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5 class=" text-secondary"><i class="bi bi-journal-bookmark"></i> Education</h5>
                        <div>
                            <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addedu"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">

                    <?php 
                        if($edus){
                            foreach($edus as $exp){
                                ?>
                                <div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6><?= $exp['course'] ?></h6>
                                    <a href=""><i class="bi bi-x-lg"></i></a>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                <i class="bi bi-book"></i> <?= $exp['institute']?>
                                </p>
                                <p class="small text-secondary m-0" style="">
                                    <?= $exp['started'].'-' .$exp['ended']?>
                                </p>

                            </div>
                        </div>

                                <?php
                            } 
                        } else{
                            ?>
                            <div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>I have no education</h6>
                                </div>
                                <p class="small text-secondary m-0" style="">
                                    If you have education, you can add it
                                </p>

                            </div>
                        </div>

                            <?php
                        }
                    ?>

                        


                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5 class=" text-secondary"><i class="bi bi-boxes"></i> Skills</h5>
                        <div>
                            <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addskill"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">

<?php
    if($skills){
        foreach($skills as $skill){
            ?>
            <div class="col-12 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6><i class="bi bi-caret-right"></i> <?= $skill['skill']?></h6>
                                    <a href=""><i class="bi bi-x-lg"></i></a>
                                </div>
                            </div>
                        </div>

            <?php
        }
    } else{
?>
<div class="col-12 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6><i class="bi bi-caret-right"></i> I have no skills</h6>
                                    <a href=""><i class="bi bi-x-lg"></i></a>
                                </div>
                            </div>
                        </div>

<?php 
    }
?>

                        
                        <div class="col-12 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6><i class="bi bi-caret-right"></i> Basic Knowledge in Computer & Internet</h6>
                                    <a href=""><i class="bi bi-x-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update
                            resume</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="addexp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add experience</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                    <form method="POST" action="actions/addexperience.action.php" class="row g-3">
                        <input type="hidden" name="slug" value="<?= $resume['slug']?>"/>
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Position / job role</label>
                                    <input type="text" class="form-control" id="inputEmail4" name="position" placeholder="Web Developer Consultant (2+ Years)" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label">Company</label>
                                    <input type="text" name="company" placeholder="Dominos,New Delhi (October 2020 - Currently Pursuing)" class="form-control" id="inputPassword4" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Joined</label>
                                    <input type="text" name="started" placeholder="October 2021" class="form-control" id="inputPassword4" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Resigned</label>
                                    <input type="text" name="ended" placeholder="Currently pursuing" class="form-control" id="inputPassword4" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label">Job description</label>
                                    <textarea class="form-control" name="job_desc" required></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">Add experience</button>
                                </div>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->
                    <div class="modal fade" id="addedu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add education</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                    <form method="POST" action="actions/addeducation.action.php" class="row g-3">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Course / degree</label>
                                    <input type="text" class="form-control" id="inputEmail4" name="course" placeholder="Completed 12th Class (Arts Stream)" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label">Institute / board</label>
                                    <input type="text" name="institute" placeholder="Central Board Of Secondary Education, New Delhi" class="form-control" id="inputPassword4" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Started</label>
                                    <input type="text" name="started" placeholder="October 2021" class="form-control" id="inputPassword4" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Ended</label>
                                    <input type="text" name="ended" placeholder="Currently pursuing" class="form-control" id="inputPassword4" required>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">Add education</button>
                                </div>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->
                    <div class="modal fade" id="addskill" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add skill</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                    <form method="POST" action="actions/addskill.action.php" class="row g-3">
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Skill</label>
                                    <input type="text" class="form-control" id="inputEmail4" name="skill" placeholder="Basic Knowledge in Computer & Internet" required>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">Add skill</button>
                                </div>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>