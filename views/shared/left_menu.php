  <ul id="left-menu_categories">
    <li>My Categories</li>
    <?php
    $c = new CategoryController();
    $categories = $c->getUserCategories();

    foreach ($categories as $category) { ?>
      <li class="category_names">
        <a onclick="loadSpecificCategory('<?php echo $category['category_name'] ?>')">
          <i class="<?php echo $category['icon'] ?>" id="<?php echo $category['category_name'] ?>"></i>
          <span><?php echo $category['category_name'] ?></span>
        </a>
      </li>
    <?php } if($userData['role_name'] == 'admin') { ?>
      <li class="category_names user_list">
        <a onclick="loadUsersList()">
          <i class="fas fa-user"></i>
          <span><?php echo 'List Users' ?></span>
        </a>
      </li>
    <?php } ?>
      <li class="category_names about_list">
        <a onclick="loadAboutList()">
          <i class="fas fa-info-circle"></i>
          <span><?php echo 'About Website' ?></span>
        </a>
      </li>
  </ul>