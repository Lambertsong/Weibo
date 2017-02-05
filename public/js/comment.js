/**
 * Created by d4smart on 2017/2/5.
 */
function insertCommentForm(id) {
    var pattern = /^comment-(\d+)$/;
    var result = pattern.exec(id);
    var status = result[1];

    $("#comment-form-"+status).show();
}
