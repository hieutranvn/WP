jQuery(document).ready(function() {
    jQuery(".user_vote").click(function() {
        post_id = jQuery(this).attr("data-post_id");
        nonce = jQuery(this).attr("data-nonce");
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "my_user_vote", post_id: post_id, nonce: nonce},
            success: function(response) {
                if (response.type === "success") {
                    jQuery("#vote_counter").html(response.vote_count);
                    //alert("success");
                }
                else {
                    alert("Your vote could not be added");
                }
            }
        });
    });
});

