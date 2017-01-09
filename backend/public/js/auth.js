var auth = {};
auth.signin = function() {
    layout.title("Đăng nhập hệ thống quản trị Minh Đoàn");
    $("body").html("");
    $("body").addClass("bg-login");
    $("body").prepend(Fly.template("/auth/signin.tpl", null));
};

auth.googleSignin = function() {
    var clientId = '872748873550-h0fomg0qsr7rakqr2jiuvpkinlkgic7b.apps.googleusercontent.com';
    var apiKey = 'AIzaSyBnDuNT82oLVNOWFQLhmGub-sw3S-_qoyQ';
    var scopes = 'https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/plus.profile.emails.read';
    gapi.client.setApiKey(apiKey);

    window.setTimeout(function() {

        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, function(authResult) {
            gapi.client.load('plus', 'v1', function() {
                alert('1');
                var request = gapi.client.plus.people.get({
                    'userId': 'me'
                });
                request.execute(function(resp) {
                    alert('2');
                    if (resp != "" && resp.result != "") {
                        alert(resp.emails[0].value);
                        var user = {
//                            email: resp.emails[0].value,
//                            description: 'Tên : ' + resp.displayName + ' , giới tính : ' + resp.gender,
                            email: 'liemnh267@gmail.com',
                            description: 'Tên : Nguyễn Hoàng Liêm  , giới tính : Nam',
                        };
                        alert(user.email);
                        alert(user.description);
                        ajax({
                            service: '/auth/signin',
                            data: user,
                            contentType: 'json',
                            type: 'post',
                            loading: false,
                            done: function(rs) {
                                if (rs.success) {
                                    $("div[data-rel=message]").html('<div class="alert alert-success alert-login">' + rs.message + '</div>');
                                    setTimeout(function() {
                                        window.location.href = baseUrl + "#index/grid";
                                        location.reload();
                                    }, 1000);
                                } else {
                                    $("div[data-rel=message]").html('<div class="alert alert-warning alert-login">' + rs.message + '</div>');
                                }
                            }
                        });
                    }
                });
            });
        });
    }, 1);
};

auth.sigout = function() {
    ajax({
        service: '/auth/sigout',
        done: function(resp) {
            if (resp.success) {
                location.hash = "#auth/signin";
            } else {
                popup.msg(resp.message);
            }
        }
    });
};