<?php
// Session Handling
$session = new SessionHandle();
if ($session->confirm_logged_in()) {
    $redirect = new Redirector("views/home/login.php");
}
// Get All users
$u = new UserController();
$userData = $u->getAllUsers();
?>

<!-- Main content -->
<div class="row">
    <div class="col col-lg-12 col-xs-12">
        <table width="100%">
            <tr style="border: 1px solid white; color: white;">
                <td><b>User Id</b></td>
                <td><b>Username</b></td>
                <td><b>Email</b></td>
                <td><b>Role</b></td>
                <td><b>Status</b></td>
                <td><b>Action</b></td>
            </tr>
            <?php foreach ($userData as $key => $userVal) { if($userVal['role_name'] == 'admin') { continue; } ?>
                <tr style="border: 1px solid white; color: white;">
                    <td><?php echo $userVal['user_id']; ?></td>
                    <td><?php echo $userVal['username']; ?></td>
                    <td><?php echo $userVal['email']; ?></td>
                    <td><?php echo $userVal['role_name']; ?></td>
                    <td><?php echo $userVal['active_user']; ?></td>
                    <td>
                        <?php if($userVal['active_user'] == 'Active') { ?>
                            <a style="cursor: pointer;" onclick="updateUser(<?php echo $userVal['user_id']; ?>, 'Non-Active')">Block User</a>
                        <?php } else { ?>
                            <a style="cursor: pointer;" onclick="updateUser(<?php echo $userVal['user_id']; ?>, 'Active')">Un-Block User</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <!-- Post Content End -->
</div>

<script type="text/javascript">
    function updateUser(user_id, active_user) {
        let formData = {
          option: "update_user",
          user_id: user_id,
          active_user: active_user,
        };
        $.ajax({
          method: "POST",
          url: "controller/ViewsController.php",
          data: formData,
          dataType: "json",
        })
          .done(function (data) {
            console.log(data);
            location.reload();
          })
          .fail(function (jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
              alert("ajax failed: " + textStatus);
            }
          });
    }
</script>