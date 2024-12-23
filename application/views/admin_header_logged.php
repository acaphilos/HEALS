<!DOCTYPE html>
<html>
<head>
    <title>HEALS</title>
    <meta charset="utf-8">
    <meta name="description" content="Health Appointment and Log system">
    <meta name="keywords" content="HEALS, Symptom, appointment, software engineering, sabah">
    <meta name="viewport" content="width=device-witdh, initial-scale=1.0">
    
    <!-- Favicon -->
    <link href="<?=base_url()?>public/img/fki-icon.jpg" rel="shortcut icon"/>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,4001,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/flaticon.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/animate.css">
    <link rel="stylesheet" href="<?=base_url()?>public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    
    <!-- [if lt ie 9] -->
    <script defer src="https://oss.maxcdn.com/htmlshiv/3.7.2/html5shiv.min.js"></script>
    <script defer src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- [endif] -->

    <!-- Javascript & JQuery -->
    <script defer src="<?=base_url()?>public/js/jquery-3.2.1.min.js"></script>
    <script defer src="<?=base_url()?>public/js/bootstrap.min.js"></script>
    <script defer src="<?=base_url()?>public/js/circle-progress.min.js"></script>
    <script defer src="<?=base_url()?>public/js/main.js"></script>
    
    <script defer src="https://kit.fontawesome.com/8ffff75547.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

  </head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="d-flex align-items-center">
        <a href="<?=base_url()?>UpdateAdmin"><div class="m-3"><p>Edit Profile</p></div></a>
        <div class="header_img"> <a href="<?=base_url()?>UpdateAdmin"><img src="https://img.freepik.com/free-vector/illustration-customer-service-concept_53876-5882.jpg?w=740&t=st=1704932395~exp=1704932995~hmac=862919d0c6e9866d5620de9ee6833e9bb6d14700aa029ff926cc1a4cd17a7cae" alt="Edit Profile"></a></div>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="<?=base_url()?>Admin" class="nav_logo"> <i class='bx bxs-heart nav_logo-icon'></i> <span class="nav_logo-name">HEALS</span> </a>
                <div class="nav_list"> 
                    <a href="<?=base_url()?>Admin" class="nav_link"> 
                    <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                    <a href="<?=base_url()?>AppointmentListAdmin" class="nav_link"> 
                    <i class='bx bx-book-open nav_icon'></i> <span class="nav_name">All Appointments</span> </a> 
                    <a href="<?=base_url()?>EmailReminder" class="nav_link"> 
                    <i class='bx bxs-capsule nav_icon'></i> <span class="nav_name">Meds Reminder</span> </a> 
                    <a href="<?=base_url()?>RecordUserList" class="nav_link"> 
                    <i class='bx bxs-notepad nav_icon'></i> <span class="nav_name">User Records</span> </a>
                    <a href="<?=base_url()?>ManageAllUser" class="nav_link"> 
                    <i class='bx bxs-user-detail nav_icon'></i> <span class="nav_name">Manage User</span> </a>
                    <a href="<?=base_url()?>AdminSignup" class="nav_link"> 
                    <i class='bx bx-user-plus nav_icon'></i> <span class="nav_name">Add Admin</span> </a> 
                </div>
            </div> <a href="<?=base_url()?>Logout" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Logout</span> </a>
        </nav>
    </div>

<style>
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

:root {
  --header-height: 3rem;
  --nav-width: 68px;
  --first-color: #341A9E;
  --first-color-light: #AFA5D9;
  --white-color: #EEECF5;
  --body-font: 'Nunito', sans-serif;
  --normal-font-size: 1rem;
  --z-fixed: 100;
}

*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  position: relative;
  margin: var(--header-height) 0 0 0;
  padding: 0 1rem;
  font-family: var(--body-font);
  font-size: var(--normal-font-size);
  transition: .5s;
}

a {
  text-decoration: none;
}

.header {
  width: 100%;
  height: var(--header-height);
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1rem;
  background-color: var(--white-color);
  z-index: var(--z-fixed);
  transition: .5s;
}

.header_toggle {
  color: var(--first-color);
  font-size: 1.5rem;
  cursor: pointer;
}

.header_img {
  width: 35px;
  height: 35px;
  display: flex;
  justify-content: center;
  border-radius: 50%;
  overflow: hidden;
}

.header_img img {
  width: 40px;
}

.l-navbar {
  position: fixed;
  top: 0;
  left: -30%;
  width: var(--nav-width);
  height: 100vh;
  background-color: var(--first-color);
  padding: .5rem 1rem 0 0;
  transition: .5s;
  z-index: var(--z-fixed);
}

.nav {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  overflow: hidden;
}

.nav_logo,
.nav_link {
  display: grid;
  grid-template-columns: max-content max-content;
  align-items: center;
  column-gap: 1rem;
  padding: .5rem 0 .5rem 1.5rem;
}

.nav_logo {
  margin-bottom: 2rem;
}

.nav_logo-icon {
  font-size: 1.25rem;
  color: var(--white-color);
}

.nav_logo-name {
  color: var(--white-color);
  font-weight: 700;
}

.nav_link {
  position: relative;
  color: var(--first-color-light);
  margin-bottom: 1.5rem;
  transition: .3s;
}

.nav_link:hover {
  color: var(--white-color);
}

.nav_icon {
  font-size: 1.25rem;
}

.show {
  left: 0;
}

.body-pd {
  padding-left: calc(var(--nav-width) + 1rem);
}

.active {
  color: var(--white-color);
}

.active::before {
  content: '';
  position: absolute;
  left: 0;
  width: 2px;
  height: 32px;
  background-color: var(--white-color);
}

.height-100 {
  height: 100vh;
}

@media screen and (min-width: 768px) {
  body {
    margin: calc(var(--header-height) + 1rem) 0 0 0;
    padding-left: calc(var(--nav-width) + 2rem);
  }

  .header {
    height: calc(var(--header-height) + 1rem);
    padding: 0 2rem 0 calc(var(--nav-width) + 2rem);
  }

  .header_img {
    width: 40px;
    height: 40px;
  }

  .header_img img {
    width: 45px;
  }

  .l-navbar {
    left: 0;
    padding: 1rem 1rem 0 0;
  }

  .show {
    width: calc(var(--nav-width) + 156px);
  }

  .body-pd {
    padding-left: calc(var(--nav-width) + 188px);
  }
}

</style>

<script>document.addEventListener("DOMContentLoaded", function(event) {
   
const showNavbar = (toggleId, navId, bodyId, headerId) =>{
const toggle = document.getElementById(toggleId),
nav = document.getElementById(navId),
bodypd = document.getElementById(bodyId),
headerpd = document.getElementById(headerId)

// Validate that all variables exist
if(toggle && nav && bodypd && headerpd){
toggle.addEventListener('click', ()=>{
// show navbar
nav.classList.toggle('show')
// change icon
toggle.classList.toggle('bx-x')
// add padding to body
bodypd.classList.toggle('body-pd')
// add padding to header
headerpd.classList.toggle('body-pd')
})
}
}

showNavbar('header-toggle','nav-bar','body-pd','header')

/*===== LINK ACTIVE =====*/
const linkColor = document.querySelectorAll('.nav_link')

function colorLink(){
if(linkColor){
linkColor.forEach(l=> l.classList.remove('active'))
this.classList.add('active')
}
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))

 // Your code to run since DOM is loaded and ready
});</script>