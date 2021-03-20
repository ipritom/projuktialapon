<div class="col-md-2">
    <h5 class="h5 text-light text-center py-2">_____</h5>
    <!--control panel-->
    <div class="col">
        <form class="form-group" action="admin_users_list.php"> 
            <button type="submit" class="btn btn-block bg-dark text-light btn-outline-primary">User List</button>
        </form>
        
        <form class="form-group" action="admin_content.php" method="get">
            <input type="hidden" name="op" value='all'>
            <button type="submit" class="btn btn-block bg-dark text-light btn-outline-primary">Manage Contents</button>
        </form>                
        <form class="form-group" action="admin_badges.php">
            <button type="submit" class="btn btn-block bg-dark text-light btn-outline-primary">Badges</button>
        </form>
        <form class="form-group" action="admin_media.php"> 
            <button type="submit" class="btn btn-block bg-dark text-light btn-outline-primary">Media</button>     
        </form>
         <form class="form-group" action="admin_adminship.php"> 
            <button type="submit" class="btn btn-block bg-dark text-light btn-outline-primary">Adminship</button>
        </form>
    </div>
    <h5 class="h5 text-light text-center">_____</h5>
</div>