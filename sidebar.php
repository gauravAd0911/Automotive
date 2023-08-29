<ul class="nav" id="main-menu">
		<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
		</li>
                <?php
                    if($_SESSION['type']=="owner"){
                ?>
                    <li>
                        <a href="dashboard.php"><i class=""></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="slot.php"><i class=""></i>Add Slots</a>
                    </li>
                    <li>
                        <a href="engg.php"><i class=""></i>Add Engineer</a>
                    </li>
                    <li>
                        <a href="service.php"><i class=""></i>Add Services</a>
                    </li>
                    <li>
                        <a  href="direct.php"><i class=""></i>Direct Booking</a>
                    </li>
                    <li>
                        <a  href="userhome.php"><i class=""></i>View Booking</a>
                    </li>                    
                    <li>
                        <a href="billing.php"><i class=""></i>Generate Bill</a>
                     </li>
                     <li>
                         <a href="billingrpt.php"><i class=""></i>Billing Report</a>
                     </li>
                    <li>
                        <a  href="edit1.php"><i class=""></i>Change Password</a>
                    </li>
                    <?php }else{ ?>
                        <li>
                        <a href="addservice.php"><i class=""></i>Add Services</a>
                    </li>
                   <?php } ?>
                </ul>