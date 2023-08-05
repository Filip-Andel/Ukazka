<header>
<script src="https://kit.fontawesome.com/f72e62bf58.js" crossorigin="anonymous"></script>
    <h1 class="logo">Snowball German</h1>
    <div class="menu-toggle"></div>
        <nav>
        <ul class="navigation">
        <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1 ):?>
            <li><a href="teachers.php">Teachers</a></li>
            <li><a href="teacherAdd.php">Add Teacher</a></li>
        <?php endif; ?>
        <?php if(isset($_SESSION['user']) && $_SESSION['user']['teacher'] == 1 | $_SESSION['user']['admin'] == 1):?>
            <li><a href="all.php">All</a></li>
            <li><a href="index.php">My Students</a></li>
            <li><a href="registr.php">Add Student</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- <li><input type="checkbox" id="switch" name="theme"><label for="switch" class="toggle" onclick="color()" >Toggle</label></li> -->
        <?php elseif (isset($_SESSION['user']) && $_SESSION['user']['teacher'] == 0):?>
            <li><a href="studentDetail.php?id=<?=$_SESSION['user']['id']?>">My profile</a></li>
            <li><a href="logout.php" >Logout</a></li>
            <!-- <li><input type="checkbox" id="switch" name="theme"><label for="switch" class="toggle" onclick="color()" >Toggle</label></li> -->
        <?php else: ?>
            <li><a href="index.php">Log-in</a></li>
            <li><a href="info.php">Info</a></li>
        <?php endif;?>
        </ul>
        </nav>
    <div class="clearfix"></div>
</header>

<script type="text/javascript">
  const currentLocation = location.href;
  const menuItem = document.querySelectorAll('.navigation li a');
  const menuLength = menuItem.length
  for (let i = 0; i<menuLength; i++)
  {
      if(menuItem[i].href === currentLocation)
      {
          menuItem[i].className = "active"
      }
  }
</script>