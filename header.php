<?php  
require_once 'config.php'; 


?>



<!DOCTYPE html>
<html lang="pt-br">




<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class=" d-flex justify-content-center ">

      <div class="d-flex botao-menu position-relative">
        <i class="bi bi-list toggle-sidebar-btn d-flex "><span class="d-none d-lg-block" style="font-size: 20px; padding-left: 5px; "> Menu</span></i>

      </div>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->





        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          
            <span class="d-none d-md-block dropdown-toggle ps-2">Rafael Vasconcellos </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sair</span>
              </a>
            </li>
        </li>





      </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

   <!-- ======= Sidebar ======= -->
   <div class="menu card-body ">
    <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">
        <a href="index.php" class="d-none d-lg-block logo d-flex align-items-center">
          <span class=" d-block p-3">SysCattle</span>
        </a>


        <li class="nav-item">
          <a class="nav-link " href="index.php">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="cadastro-fazenda.php">
            <i class="bi bi-house-add"></i>
            <span>Cadastrar Fazenda </span>
          </a>
        </li><!-- cadastro-fazenda  -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="cadastro-potreiro.php">
            <i class="bi bi-houses"></i>
            <span>Cadastrar Potreiros</span>
          </a>
        </li><!-- cadastro-potreiro -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="cadastro-lote.php">

            <i class="bi bi-card-checklist"></i>
            <span>Registrar Lote Animal</span>
          </a>
        </li><!-- cadastro lote-animal -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="cadastro-animais.php">

            <i class="bi bi-card-checklist"></i>
            <span>Cadastrar Animais</span>
          </a>
        </li><!-- cadastro-animal -->



        <li class="nav-item">
          <a class="nav-link collapsed" href="cadastro-manejo.php">
            <i class="bi bi-card-list"></i>
            <span>Registrar Manejo</span>
          </a>
        </li><!-- manejo -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="cadastro-movimentacao.php">
            <i class="bi bi-calendar-event"></i>
            <span>Registrar Movimentação </span>
          </a>
        </li><!-- movimentação  -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="cadastro-vacinacao.php">
            <i class="bi bi-capsule"></i>
            <span>Vacinação</span>
          </a>
        </li><!-- vacinação  -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="cadastro-usuario.php">
          <i class="bi bi-file-earmark-person-fill"></i>
            <span>Cadastrar Usuário</span>
          </a>
        </li><!-- cadastro de usuários  -->

        
        <li class="nav-item">
          <a class="nav-link collapsed" href="delete-session.php">
          <i class="bi bi-box-arrow-in-left"></i>
            <span>Sair</span>
          </a>
        </li><!-- sair  -->



      </ul>

    </aside><!-- End Sidebar-->

  </div>