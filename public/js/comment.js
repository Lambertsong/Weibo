/**
 * Created by d4smart on 2017/2/5.
 */
function insertCommentForm(id) {
    var pattern = /^comment-(\d+)$/;
    var result = pattern.exec(id);
    var status = result[1];

    if($("#comment-form-"+status).is(":hidden")) {
        $("#comment-form-"+status).show();
    } else {
        $("#comment-form-"+status).hide();
    }
}
