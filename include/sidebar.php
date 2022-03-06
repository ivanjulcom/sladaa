
<div class="main-sidebar sidebar-style-2 ex1">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="dashboard.php"><?php echo $set['d_title']; ?></a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="dashboard.php"><?php echo $set['d_s_title']; ?></a>
                </div>
				
				<?php
if($_SESSION['ltype'] == 'Vendor')
{
	?>
				
                <ul class="sidebar-menu">
                    
                    <li class="active">
                        <a href="dashboard.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                     
                    </li>
                    <li class="menu-header">Product Section</li>
                    
					
					
					
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-gift"></i> <span>Coupon </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_coupon.php">Add Coupon</a></li>
							<li><a class="nav-link" href="list_coupon.php">List Coupon</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_coupon.php">Add Coupon</a></li>
					<li><a class="nav-link" href="list_coupon.php">List Coupon</a></li>
					
					
					
					
					
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-carrot"></i> <span>Product </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_product.php">Add Product</a></li>
							<li><a class="nav-link" href="add_product_attributes.php">Add Product Attributes</a></li>
							<li><a class="nav-link" href="list_product.php">List Product</a></li>
							<li><a class="nav-link" href="list_product_attributes.php">List Product Attributes</a></li>
							<li><a class="nav-link" href="product_import.php">Product Import</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_product.php">Add Product</a></li>
					<li><a class="nav-link" href="add_product_attributes.php">Add Product Attributes</a></li>
					<li><a class="nav-link" href="list_product.php">List Product</a></li>
					<li><a class="nav-link" href="list_product_attributes.php">List Product Attributes</a></li>
					<li><a class="nav-link" href="product_import.php">Product Import</a></li>
					<li class="menu-header">Home Section</li>
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-home"></i> <span>Home Section </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_home_section.php">Add Home Section</a></li>
							<li><a class="nav-link" href="list_home_section.php">List Home Section</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_home_section.php">Add Home Section</a></li>
					<li><a class="nav-link" href="list_home_section.php">List Home Section</a></li>
					 <li class="menu-header">Product Order Section</li>
					 <li><a class="nav-link" href="pending.php"><i class="fas fa-shopping-cart"></i> <span>Pending Order</span></a></li>
                    <li><a class="nav-link" href="complete.php"><i class="fas fa-check"></i> <span>Complete Order</span></a></li>
					<li><a class="nav-link" href="cancle_order_list.php"><i class="fas fa-times"></i> <span>Cancelled Order</span></a></li>
					<li class="menu-header">Payout Section</li>
					 <li><a class="nav-link" href="request_payout.php"><i class="fas fa-receipt"></i> <span>Payout Request</span></a></li>
					 <li><a class="nav-link" href="list_payout.php"><i class="fas fa-receipt"></i> <span>Payout List</span></a></li>
                   
                </ul>
<?php } 
else if($_SESSION['ltype'] == 'D_boy')
{
	?>
	 <ul class="sidebar-menu">
                    
                    <li class="active">
                        <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                     
                    </li>
					
					 <li class="menu-header">Product Order Section</li>
					 <li><a class="nav-link" href="pending.php"><i class="fas fa-shopping-cart"></i> <span>Pending Order</span></a></li>
                    <li><a class="nav-link" href="complete.php"><i class="fas fa-check"></i> <span>Complete Order</span></a></li>
					<li><a class="nav-link" href="cancle_order_list.php"><i class="fas fa-times"></i> <span>Cancelled Order</span></a></li>
					
					<li class="menu-header">Package Order Section</li>
					 <li><a class="nav-link" href="pkg_pending.php"><i class="fas fa-shopping-cart"></i> <span>Pending Order</span></a></li>
                    <li><a class="nav-link" href="pkg_complete.php"><i class="fas fa-check"></i> <span>Complete Order</span></a></li>
					<li><a class="nav-link" href="pkg_cancle_order_list.php"><i class="fas fa-times"></i> <span>Cancelled Order</span></a></li>
					
					<li class="menu-header">Payout Section</li>
					 <li><a class="nav-link" href="request_payout.php"><i class="fas fa-receipt"></i> <span>Payout Request</span></a></li>
					 <li><a class="nav-link" href="list_payout.php"><i class="fas fa-receipt"></i> <span>Payout List</span></a></li>
					</ul>
	<?php 
}
else 
{
?>
  <ul class="sidebar-menu">
                    
                    <li class="active">
                        <a href="dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                     
                    </li>
                    <li class="menu-header">Product Section</li>
                    
					
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-ol"></i> <span>Category </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_category.php">Add Category</a></li>
							<li><a class="nav-link" href="list_category.php">List Category</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_category.php">Add Category</a></li>
					<li><a class="nav-link" href="list_category.php">List Category</a></li>
					
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-image"></i> <span>Banner </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_banner.php">Add Banner</a></li>
							<li><a class="nav-link" href="list_banner.php">List Banner</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_banner.php">Add Banner</a></li>
					<li><a class="nav-link" href="list_banner.php">List Banner</a></li>
					
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-map-pin"></i> <span>Pincode </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_pincode.php">Add Pincode</a></li>
							<li><a class="nav-link" href="list_pincode.php">List Pincode</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_pincode.php">Add Pincode</a></li>
					<li><a class="nav-link" href="list_pincode.php">List Pincode</a></li>
					
					  <li class="menu-header">Package Section</li>
                    
					
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-ol"></i> <span>Package Category </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="pkg_category.php">Add Category</a></li>
							<li><a class="nav-link" href="pkglist_category.php">List Category</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="pkg_category.php">Add Category</a></li>
					<li><a class="nav-link" href="pkglist_category.php">List Category</a></li>
					
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-image"></i> <span>Package Banner </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="pkg_banner.php">Add Banner</a></li>
							<li><a class="nav-link" href="pkglist_banner.php">List Banner</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="pkg_banner.php">Add Banner</a></li>
					<li><a class="nav-link" href="pkglist_banner.php">List Banner</a></li>
					<li class="menu-header">Notification Section</li>
					
					<li>
                        <a href="push_notification.php" class="nav-link"><i class="fas fa-bell"></i><span>Send Notification</span></a>
                     
                    </li>
					
					<li class="menu-header">Store Section</li>
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-store"></i> <span>Store </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_store.php">Add Store</a></li>
							<li><a class="nav-link" href="list_store.php">List Store</a></li>
                            
              
                        </ul>
                    </li>  -->
                    <li><a class="nav-link" href="add_store.php">Add Store</a></li>
					<li><a class="nav-link" href="list_store.php">List Store</a></li>
					
					
					<!-- <li class="menu-header">Delivery Boy Section</li>
					<li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-motorcycle"></i> <span>Delivery Boy </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_deliveryboy.php">Add Delivery Boy</a></li>
							<li><a class="nav-link" href="list_deliveryboy.php">List Delivery Boy</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_deliveryboy.php">Add Delivery Boy</a></li>
					<li><a class="nav-link" href="list_deliveryboy.php">List Delivery Boy</a></li>
					
					<li class="menu-header">Payout Section</li>
					<li><a class="nav-link" href="list_payout.php"><i class="fas fa-receipt"></i> <span> Vendor  List</span></a></li>
					<li><a class="nav-link" href="dlist_payout.php"><i class="fas fa-receipt"></i> <span> Delivery Boy List</span></a></li>
                    </li>
					
					<li class="menu-header">Faq Section</li>
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-question-circle"></i> <span>Faq </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_faq.php">Add Faq</a></li>
							<li><a class="nav-link" href="list_faq.php">List Faq</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_faq.php">Add Faq</a></li>
					<li><a class="nav-link" href="list_faq.php">List Faq</a></li>
                    </li>
					
					<li class="menu-header">Payment Gateway Section</li>
					<li><a class="nav-link" href="list_payment_list.php"><i class="fas fa-money-bill-alt"></i> <span>List Payment Gateway</span></a></li>
					
					
					<li class="menu-header">Customer Section</li>
					<li><a class="nav-link" href="customer.php"><i class="fas fa-users"></i> <span>Customers</span></a></li>
                    
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-comment"></i> <span>Testimonial </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_testimonial.php">Add Testimonial</a></li>
							<li><a class="nav-link" href="list_testimonial.php">List Testimonial</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_testimonial.php">Add Testimonial</a></li>
					<li><a class="nav-link" href="list_testimonial.php">List Testimonial</a></li>
					
					<!-- <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-flag"></i> <span>Country Code </span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="add_ccode.php">Add Country Code</a></li>
							<li><a class="nav-link" href="list_ccode.php">List Country Code</a></li>
                            
              
                        </ul>
                    </li> -->
                    <li><a class="nav-link" href="add_ccode.php">Add Country Code</a></li>
					<li><a class="nav-link" href="list_ccode.php">List Country Code</a></li>
					<li class="menu-header">Normal Order Section</li>
					<li>
                        <a href="orderlist.php" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Order List</span></a>
                     
                    </li>
					
					<li class="menu-header">Package Order Section</li>
					 <li><a class="nav-link" href="pkg_pending.php"><i class="fas fa-shopping-cart"></i> <span>Pending Order</span></a></li>
                    <li><a class="nav-link" href="pkg_complete.php"><i class="fas fa-check"></i> <span>Complete Order</span></a></li>
					<li><a class="nav-link" href="pkg_cancle_order_list.php"><i class="fas fa-times"></i> <span>Cancelled Order</span></a></li>
					 <?php
if($_SESSION['ltype'] == 'Vendor')
{
    ?>
    
    <?php 
}
else 
{   
                    ?>
                    <?php } ?>
                    <?php
if($_SESSION['ltype'] == 'Vendor')
{
}
else 
{
    ?>
					 <li class="menu-header">Security Section</li>
                    <li><a class="nav-link" href="profile.php"><i class="fas fa-user"></i> <span>Update Profile</span></a></li>
                    <li><a class="nav-link" href="setting.php"><i class="fas fa-sun"></i> <span>Setting</span></a></li>
                </ul>
                <?php } ?>
<?php } ?>  

            </aside>
        </div>


       