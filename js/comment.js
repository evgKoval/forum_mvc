$(document).ready(function() {
    var url = window.location.href;
    var postId = url.split("/").pop();

    setInterval(function() {
        $.ajax({
            method: "POST",
            url: '/post/get-comments/' + postId,
            success: function(response) {
                var comments = JSON.parse(response);

                $(".comments").empty();

                for (var i = 0; i < comments.length; i++) {
                    $(".comments").append('\
                        <li class="list-group-item">\
                            <small class="d-block">\
                                ' + comments[i].first_name + ' at '+ comments[i].created_at + '\
                            </small>\
                            ' + comments[i].comment + '\
                        </li>\
                    ');
                } 
            }
        });
    }, 30000)
});