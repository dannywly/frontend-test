<div id="menu" class="category-menu">
<!--     <div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
    <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
  </div> -->
  <div class="collapse navbar-collapse">
    <ul class="nav nav-stacked">
      <li><a href="#">全部商品分类</a></li>
      <?php foreach ($categories as $category) { ?>
      <?php if ($category['children']) { ?>
      <li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
        <div class="dropdown-menu right-dropdown">
          <div class="dropdown-inner">
            <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
            <ul class="list-unstyled">
              <?php foreach ($children as $child) { ?>
              <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
              <?php } ?>
            </ul>
            <?php } ?>
          </div>
      </li>
      <?php } else { ?>
      <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
      <?php } ?>
      <?php } ?>
    </ul>
  </div>
</div>