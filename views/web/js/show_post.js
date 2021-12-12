$(document).ready(function () {
  sendUsrPostId = function (userId,postId){
    getUserSinglePostRate(userId,postId);
  };
  submitNewComment = function (userId,postId) {
    var formData = {
      formtype: "comment",
      description: $("#description").val(),
      image: $("#imgupload").val(),
    };
    $.ajax({
      method: "POST",
      url: "controller/ViewsController.php",
      data: {formData:formData, userId:userId, postId:postId, option:"submit_post_comment"},
      encode: true,
    })
      .done(function (data) {
        // We clean the textarea input after the comment is made
        var post_id = $('.votes_comments_area .icons').attr('id');
        // We reload the page by calling again the function that loaded the page the first time (on userfeed)
        loadContent('show_post',post_id);
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus);
      });
  };
  getUserSinglePostRate = function(userId,postId){  
    $.ajax({
        url: "controller/ViewsController.php",
        method: "POST",
        data: { option:"singlepost_user_votes", userId:userId, postId:postId}
    })
    .done(function(data) {
      var parsedData = $.parseJSON(data);
      // it returns false if the user didn't vote that post before
        if(parsedData) fillSinglePostVotes(parsedData);
    });  
  };
  fillSinglePostVotes= function(ratedPost){ 
        // upvote
        console.log(parseInt(ratedPost['is_positive']));
        if(parseInt(ratedPost['is_positive'])){
            $("#"+ratedPost['post_id']+" .upvote_button").removeClass( "upvote_default" ).addClass( "upvote_filled" );
        }
        //downvote
        else{
            $("#"+ratedPost['post_id']+" .downvote_button").removeClass( "downvote_default" ).addClass( "downvote_filled" );
        }
    // }
  };
  editComment = function(commentId, postId){  
    $.ajax({
        url: "controller/ViewsController.php",
        method: "POST",
        data: { option:"show_post_comment", commentId:commentId}
    })
    .done(function(data) {
      var parsedData = $.parseJSON(data);
      var description = parsedData[0].description;
      $(".comment_"+postId).val(description);
      $(".update_"+postId).attr('onclick','updateComment('+commentId+')');
      $(".submit_"+postId).hide();
      $(".update_"+postId).show();
    });  
  };
  updateComment = function (commentId) {
    var formData = {
      formtype: "comment",
      description: $("#description").val(),
    };
    $.ajax({
      method: "POST",
      url: "controller/ViewsController.php",
      data: {formData:formData, commentId:commentId, option:"edit_post_comment"},
      encode: true,
    })
      .done(function (data) {
        // We clean the textarea input after the comment is made
        var post_id = $('.votes_comments_area .icons').attr('id');
        // We reload the page by calling again the function that loaded the page the first time (on userfeed)
        loadContent('show_post',post_id);
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus);
      });
  };
  deleteComment = function (commentId) {
    $.ajax({
      method: "POST",
      url: "controller/ViewsController.php",
      data: {commentId:commentId, option:"delete_comment"},
      encode: true,
    })
      .done(function (data) {
        // We clean the textarea input after the comment is made
        var post_id = $('.votes_comments_area .icons').attr('id');
        // We reload the page by calling again the function that loaded the page the first time (on userfeed)
        loadContent('show_post',post_id);
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus);
      });
  };
});
