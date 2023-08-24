<div class="d-flex align-items-center justify-content-around w-100 pb-4">
    <img class="img-fluid" style="width:100px" src="images/LnT_logo.jpg">
    <img class="img-fluid" style="width:100px" src="images/child_help_LOGO.jpg">
    <img class="img-fluid" style="width:100px" src="images/maharashtra_shashan.jpg">
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>

        <div class="d-flex">
            <div class="d-flex align-items-center me-4 ">
                <div class="me-1 text-end">
                    <h6 class="m-0 ">Ashiq Shaikh</h6>
                    <small>Admin</small>
                </div>
                <i class="fa fa-user-circle-o fs-2" aria-hidden="true"></i>
            </div>

            <button type="button" class="btn btn-primary position-relative me-4 ">
                <i class="fa fa-envelope fs-5" aria-hidden="true"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    5
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>

            <form action="includes/logout.inc.php" method="post">
                <input class="btn btn-danger" type="submit" value="Logout">
            </form>
        </div>

    </div>
</nav>

<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Dashbaord</a></li>
        <?php if(basename($_SERVER['PHP_SELF']) === 'student.php'){ ?>
        <li class="breadcrumb-item active" aria-current="page">Student</li>
        <?php } ?>
        <?php if(basename($_SERVER['PHP_SELF']) === 'add_student.php'){ ?>
        <li class="breadcrumb-item active" aria-current="page">Student Registration</li>
        <?php } ?>
    </ol>
</nav>