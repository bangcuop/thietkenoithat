var news = {};
news.grid = function() {
    layout.title("Quản trị danh sách tin tức");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Tin tức", "#news/grid"],
        ["Quản lý tin tức"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }

    ajax({
        service: '/news/grid',
        data: search,
        loading: true,
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/news/grid.tpl", resp));
                setTimeout(function() {
                    viewUtils.initSearch("search");
                    $("img.lazy").lazyload({
                        effect: "fadeIn",
                    });
                }, 300);
            } else {
                popup.msg(resp.message);
            }
        }
    });

};

news.add = function() {
    popup.open('popup-add-news', 'Thêm mới tin tức.', Fly.template('/news/add.tpl'), [
        {
            title: 'Thêm mới',
            style: 'btn-primary',
            loading: false,
            fn: function() {
                ajaxSubmit({
                    service: '/news/add',
                    id: 'add-news',
                    contentType: 'json',
                    loading: false,
                    done: function(rs) {
                        if (rs.success) {
                                var html = Fly.template('/news/tradd.tpl', rs);
                                $('#mytable tbody[rel-data="bodydata"]').prepend(html);
                                popup.close('popup-add-news');
                        } else {
                            popup.msg(rs.message);
                        }
                    }
                });
            }
        },
        {
            title: 'Hủy',
            style: 'btn-default',
            fn: function() {
                popup.close('popup-add-news');
            }
        }
    ], 'modal-lg');
    setTimeout(function() {
        editor("detail", {});
    },100);
};


news.edit = function(id) {
    ajax({
        service: '/news/getbyid',
        loading: false,
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit-news', 'Sửa tin tức.', Fly.template('/news/add.tpl', resp), [
                    {
                        title: 'Sửa',
                        style: 'btn-primary',
                        fn: function() {
                            ajaxSubmit({
                                service: '/news/add',
                                id: 'add-news',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    if (rs.success) {
                                            $('td[data-name="' + id + '"]').empty().html(rs.data.name);
                                            $('td[data-updateTime="' + id + '"]').empty().html(textUtils.formatTime(rs.data.updateTime));
                                            $('td div[data-key-active="' + id + '"]').empty().html('<label class="label label-' + (rs.data.active == 1 ? 'success' : 'danger') + '" >' + (rs.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeActive(\'' + rs.data.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (rs.data.active == 1 ? 'check' : 'unchecked') + '" />');
                                            popup.close('popup-edit-news');
                                    } else {
                                        popup.msg(rs.message);
                                    }
                                }
                            });
                        }
                    },
                    {
                        title: 'Hủy',
                        style: 'btn-default',
                        fn: function() {
                            popup.close('popup-edit-news');
                        }
                    }
                ], 'modal-lg');
                setTimeout(function() {
                    editor("detail", {"height":400});
                });
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

news.changeActive = function(id) {
    ajax({
        service: '/news/changeactive',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key-active='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeActive(\'' + id + '\');" style="cursor: pointer; margin-left:5px" class="glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

news.remove = function(id) {
    popup.confirm("Bạn có chắc chắn muốn xóa tin tức này?", function() {
        ajax({
            service: '/news/remove',
            data: {id: id},
            loading: false,
            done: function(resp) {
                if (resp.success) {
                    popup.msg(resp.message, function() {
                        $('tr[rel-data=' + id + ']').remove();
                    });
                } else {
                    popup.msg(resp.message);
                }
            }
        });
    });
};
