<?php
use yii\helpers\Url;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= Url::to(['/site/index']) ?>" class="brand-link">
    <span class="brand-text font-weight-light">Flyer Admin</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="<?= Url::to(['/site/index']) ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= Url::to(['/flyers/index']) ?>" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Flyers</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= Url::to(['/locations/index']) ?>" class="nav-link">
            <i class="nav-icon fas fa-map-marker-alt"></i>
            <p>Locations</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= Url::to(['/products/index']) ?>" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>Products</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= Url::to(['/categories/index']) ?>" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>Categories</p>
          </a>
        </li>


      </ul>
    </nav>
  </div>
</aside>
