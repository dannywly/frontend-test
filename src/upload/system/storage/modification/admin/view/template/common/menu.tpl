<ul id="menu">
  <li id="dashboard"><a href="<?php echo $home; ?>"><i class="fa fa-dashboard fa-fw"></i> <span><?php echo $text_dashboard; ?></span></a></li>
  
            	<?php if ($show_catalog) {?>
				<li id="catalog"><a class="parent"><i class="fa fa-tags fa-fw"></i> <span><?php echo $text_catalog; ?></span></a>
				  <ul>
            		<?php echo $catalog_html;?>
            	  </ul>
            	<li>
            	<?php }?>

            	<?php if ($show_extension) {?>
				<li id="extension"><a class="parent"><i class="fa fa-puzzle-piece fa-fw"></i> <span><?php echo $text_extension; ?></span></a>
				  <ul>
            		<?php echo $extension_html;?>
            		<?php if ($openbay_show_menu == 1) { ?>
					  <li><a class="parent"><?php echo $text_openbay_extension; ?></a>
					    <ul>
					      <li><a href="<?php echo $openbay_link_extension; ?>"><?php echo $text_openbay_dashboard; ?></a></li>
					      <li><a href="<?php echo $openbay_link_orders; ?>"><?php echo $text_openbay_orders; ?></a></li>
					      <li><a href="<?php echo $openbay_link_items; ?>"><?php echo $text_openbay_items; ?></a></li>
					      <?php if ($openbay_markets['ebay'] == 1) { ?>
					      <li><a class="parent"><?php echo $text_openbay_ebay; ?></a>
					        <ul>
					          <li><a href="<?php echo $openbay_link_ebay; ?>"><?php echo $text_openbay_dashboard; ?></a></li>
					          <li><a href="<?php echo $openbay_link_ebay_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
					          <li><a href="<?php echo $openbay_link_ebay_links; ?>"><?php echo $text_openbay_links; ?></a></li>
					          <li><a href="<?php echo $openbay_link_ebay_orderimport; ?>"><?php echo $text_openbay_order_import; ?></a></li>
					        </ul>
					      </li>
					      <?php } ?>
					      <?php if ($openbay_markets['amazon'] == 1) { ?>
					      <li><a class="parent"><?php echo $text_openbay_amazon; ?></a>
					        <ul>
					          <li><a href="<?php echo $openbay_link_amazon; ?>"><?php echo $text_openbay_dashboard; ?></a></li>
					          <li><a href="<?php echo $openbay_link_amazon_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
					          <li><a href="<?php echo $openbay_link_amazon_links; ?>"><?php echo $text_openbay_links; ?></a></li>
					        </ul>
					      </li>
					      <?php } ?>
					      <?php if ($openbay_markets['amazonus'] == 1) { ?>
					      <li><a class="parent"><?php echo $text_openbay_amazonus; ?></a>
					        <ul>
					          <li><a href="<?php echo $openbay_link_amazonus; ?>"><?php echo $text_openbay_dashboard; ?></a></li>
					          <li><a href="<?php echo $openbay_link_amazonus_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
					          <li><a href="<?php echo $openbay_link_amazonus_links; ?>"><?php echo $text_openbay_links; ?></a></li>
					        </ul>
					      </li>
					      <?php } ?>
					      <?php if ($openbay_markets['etsy'] == 1) { ?>
					      <li><a class="parent"><?php echo $text_openbay_etsy; ?></a>
					        <ul>
					          <li><a href="<?php echo $openbay_link_etsy; ?>"><?php echo $text_openbay_dashboard; ?></a></li>
					          <li><a href="<?php echo $openbay_link_etsy_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
					          <li><a href="<?php echo $openbay_link_etsy_links; ?>"><?php echo $text_openbay_links; ?></a></li>
					        </ul>
					      </li>
					      <?php } ?>
					    </ul>
					  </li>
					  <?php } ?>
            	  </ul>
            	<li>
            	<?php }?>

            	<?php if ($show_design) {?>
				<li id="design"><a class="parent"><i class="fa fa-television fa-fw"></i> <span><?php echo $text_design; ?></span></a>
				  <ul>
            		<?php echo $design_html;?>
            	  </ul>
            	<li>
            	<?php }?>

            	<?php if ($show_sale) {?>
				<li id="sale"><a class="parent"><i class="fa fa-shopping-cart fa-fw"></i> <span><?php echo $text_sale; ?></span></a>
				  <ul>
            		<?php echo $sale_html;?>
            	  </ul>
            	<li>
            	<?php }?>

            	<?php if ($show_customers) {?>
				<li id="customer"><a class="parent"><i class="fa fa-user fa-fw"></i> <span><?php echo $text_customer; ?></span></a>
				  <ul>
            		<?php echo $customers_html;?>
            	  </ul>
            	<li>
            	<?php }?>

            	<?php if ($show_marketing) {?>
				<li><a class="parent"><i class="fa fa-share-alt fa-fw"></i> <span><?php echo $text_marketing; ?></span></a>
				  <ul>
            		<?php echo $marketing_html;?>
            	  </ul>
            	<li>
            	<?php }?>

				<?php if ($show_system) {?>
			    <li id="system"><a class="parent"><i class="fa fa-cog fa-fw"></i> <span><?php echo $text_system; ?></span></a>
			      <ul>
			        <?php echo $system_setting_html;?>
			      </ul>
			    <li>
			    <?php }?>
			    
				<?php if ($show_report) {?>
				<li id="reports"><a class="parent"><i class="fa fa-bar-chart-o fa-fw"></i> <span><?php echo $text_reports; ?></span></a>
				  <ul>
            		<?php echo $report_html;?>
            	  </ul>
            	<li>
            	<?php }?>
            






































































































































































































</ul>
