<style>
    body, html {
    height:100%;
    }

    body {
        padding-top: 70px;
    }
    /*
    * Off Canvas sidebar at medium breakpoint
    * --------------------------------------------------
    */
    @media screen and (max-width: 992px) {

    .row-offcanvas {
        position: relative;
        -webkit-transition: all 0.25s ease-out;
        -moz-transition: all 0.25s ease-out;
        transition: all 0.25s ease-out;
    }

    .row-offcanvas-left
    .sidebar-offcanvas {
        left: -33%;
    }

    .row-offcanvas-left.active {
        left: 33%;
        margin-left: -6px;
    }

    .sidebar-offcanvas {
        position: absolute;
        top: 0;
        width: 33%;
        height: 100%;
    }
    }

    /*
    * Off Canvas wider at sm breakpoint
    * --------------------------------------------------
    */
    @media screen and (max-width: 34em) {
    .row-offcanvas-left
    .sidebar-offcanvas {
        left: -45%;
    }

    .row-offcanvas-left.active {
        left: 45%;
        margin-left: -6px;
    }
    
    .sidebar-offcanvas {
        width: 45%;
    }
    }

    .card {
        overflow:hidden;
    }

    .card-block .rotate {
        z-index: 8;
        float: right;
        height: 100%;
    }

    .card-block .rotate i {
        color: rgba(20, 20, 20, 0.15);
        position: absolute;
        left: 0;
        left: auto;
        right: -10px;
        bottom: 0;
        display: block;
        -webkit-transform: rotate(-44deg);
        -moz-transform: rotate(-44deg);
        -o-transform: rotate(-44deg);
        -ms-transform: rotate(-44deg);
        transform: rotate(-44deg);
    }

</style>
<div id="header">

</div>
<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-primary mb-3">
    <div class="flex-row d-flex">
        <a class="navbar-brand" href="#" title="Free Bootstrap 4 Admin Template">Admin</a>
        <button type="button" class="navbar-toggler" data-toggle="offcanvas" title="Toggle responsive left sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="collapsingNavbar">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">หน้าแรก <span class="sr-only">หน้าแรก</span></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="" data-target="#myModal" data-toggle="modal">Username</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-md-3 col-lg-2 sidebar-offcanvas pl-0" id="sidebar" role="navigation">
            <ul class="nav flex-column pl-1">
                <li class="nav-item"><a class="nav-link" href="#">Overview</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Reports▾</a>
                    <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
                       <li class="nav-item"><a class="nav-link" href="">Report 1</a></li>
                       <li class="nav-item"><a class="nav-link" href="">Report 2</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Export</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Snippets</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Flexbox</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Layouts</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Templates</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Themes</a></li>
            </ul>
        </div>

        

<script>
$(document).ready(function() {
    
    $('[data-toggle=offcanvas]').click(function() {
      $('.row-offcanvas').toggleClass('active');
    });
    
  });
</script>