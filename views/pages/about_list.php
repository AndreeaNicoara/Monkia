<?php
$session = new SessionHandle();
if ($session->confirm_logged_in()) {
    $redirect = new Redirector("views/home/login.php");
}
// Get all about data
$u = new AboutController();
$aboutData = $u->getAllAbout();
?>

<!-- Main content -->
<div class="row">
    <div class="col col-lg-12 col-xs-12">
        <table width="100%">
            <tr style="border: 1px solid white; color: white;">
                <td width="70"><b>Decription and rules</b></td>
                <td width="20" style="text-align: center;"><b>Created Date</b></td>
                <?php if($_SESSION['role_name'] == 'admin') { ?>
                  <td width="5"><b>Action</b></td>
                <?php } ?>
            </tr>
            <?php foreach ($aboutData as $key => $aboutVal) { ?>
                <tr style="border: 1px solid white; color: white;">
                    <td class="description_content"><?php echo $aboutVal['description']; ?></td>
                    <td style="text-align: center;"><?php echo $aboutVal['date_time']; ?></td>
                    <?php if($_SESSION['role_name'] == 'admin') { ?>
                      <td><a style="cursor: pointer;" class="edit_about">Edit</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
    <!-- Post Content End -->
</div>

<script type="text/javascript">
    $(".edit_about").click(function() {
      $(this).parent().parent().parent().find('.edit_about').text('');
      $(this).parent().parent().find('.description_content').html('<textarea id="about_description" style="width: 100%;height: 130px;"></textarea><button style="cursor: pointer;" onclick="updateAbout()">Update</button><button style="cursor: pointer;" onClick="window.location.reload();">Cancel</button>');
    });

    function updateAbout() {
        let formData = {
          option: "update_about",
          description: $("#about_description").val(),
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