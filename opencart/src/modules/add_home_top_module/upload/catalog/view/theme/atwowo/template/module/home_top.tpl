<div id="home-top" class="container">
	<div class="row">
		<?php if ($catagory_menu) { ?>
		<div class="col-sm-3">
			<?php echo $catagory_menu; ?>
		</div>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div class="<?php echo $class;?> home-title">
			<a href="#">首页</a>
			<a href="#">品牌</a>
			<a href="#">店铺</a>
			<hr>
		</div>
		<div id="home-top" class="<?php echo $class;?>">
		<div id="home-top-slideshow<?php echo $module; ?>" class="owl-carousel" style="opacity: 1;">
				<?php foreach ($banners as $banner) { ?>
				<div class="item">
					<?php if ($banner['link']) { ?>
					<a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
					<?php } else { ?>
					<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<script type="text/javascript"><!--
				$('#home-top-slideshow<?php echo $module; ?>').owlCarousel({
					items: 6,
					autoPlay: 3000,
					singleItem: true,
					navigation: true,
					navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
					pagination: true
				});
			--></script>
			<div style="width: 100%;height: 50px;">

			</div>
		</div>
	</div>
</div>