<?php
// Session Handling
$session = new SessionHandle();
if ($session->confirm_logged_in()) {
    $redirect = new Redirector("views/home/login.php");
}

// Load all categories
$c = new CategoryController();
$categories = $c->loadCategories();

// Load POST INFO
// this data comed from the Page Controller
$post_id = $data;
$p = new PostController();
// $post = $p->loadPostById($postID);
$post = $p->loadPostById($post_id);
?>


<div class="row d-flex justify-content-center min-vh-100">

  <div id="post-form" class="col col-lg-10">
    <section>
      <div class="container-form min-vh-100">
        <h2 class="f-heading">
          <span>Edit post</span>
        </h2>
        <form action="" method="post" enctype="multipart/form-data" id="edit-post-form">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php echo $post[0]['title'] ?>">
            <span class="msg error-message-dark my-2" id="title-error">
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" disabled="">
              <option value="Category">Select category</option>
              <?php foreach ($categories as $category) { 
                $selected = '';
                if($post[0]['category_name'] == $category['category_name'])
                {
                  $selected = 'selected';
                }
              ?>
                <option value="<?php echo $category['category_name'] ?>" <?php echo $selected; ?>><?php echo $category['category_name'] ?></option>
              <?php } ?>
            </select>
            <span class="msg error-message-dark my-2" id="category-error">
          </div>
          <div class="form-group">
            <label for="title">Description</label>
            <textarea type="text" name="description" id="description" value="<?php echo $post[0]['description'] ?>"><?php echo $post[0]['description'] ?></textarea>
            <span class="msg error-message-dark my-2" id="description-error">
          </div>
          <!-- <div class="form-group">
            <input type="file" name="imgfile" id="imgfile">
            <span class="msg error-message-dark my-2" id="image-error">
          </div> -->
          <input type="hidden" name="userId" id="userId" value="<?php echo $post[0]['post_id'] ?>">
          <div id="error-msg"></div>
          <button class="btn" type="button" id="new_post-submit-btn" onclick="submitEditPostForm()"> Update</button>

        </form>
      </div>
    </section>
  </div>
</div>