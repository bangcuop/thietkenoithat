var category = {};
category.grid = function () {
    layout.title("Quản trị danh mục sản phẩm");
    layout.breadcrumb([
        ["Dashboad", "#category/grid"],
        ["Danh mục", "#category/grid"],
        ["Danh sách danh mục"]
    ]);
    ajax({
        service: '/category/grid',
        loading: true,
        done: function (resp) {
            if (resp.success) {
                layout.container(Fly.template("/category/grid.tpl", resp));
                setTimeout(function () {
                    $("img.lazy").lazyload({
                        effect: "fadeIn",
                    });
                }, 100);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
category.add = function () {
    popup.open('popup-add-category', 'Thêm mới danh mục.', Fly.template('/category/add.tpl'), [
        {
            title: 'Thêm mới',
            style: 'btn-primary',
            fn: function () {
                ajaxSubmit({
                    service: '/category/add',
                    id: 'add-category',
                    contentType: 'json',
                    loading: false,
                    done: function (rs) {
                        if (rs.success) {
                            popup.msg(rs.message, function () {
                                var html = Fly.template('/category/trAdd.tpl', rs);
                                if (rs.data.parentId == 0) {
                                    $('tbody[rel-data="bodydata"]').prepend(html);
                                } else {
                                    $('tr[rel-data=' + rs.data.parentId + ']').after(html);
                                }
                                popup.close('popup-add-category');
                            });
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
            fn: function () {
                popup.close('popup-add-category');
            }
        }
    ]);
    category.drawcategory();
};
category.edit = function (id) {
    ajax({
        service: '/category/get',
        data: {id: id},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                popup.open('popup-edit-category', 'Sửa danh mục.', Fly.template('/category/edit.tpl', resp), [
                    {
                        title: 'Lưu lại',
                        style: 'btn-primary',
                        fn: function () {
                            ajaxSubmit({
                                service: '/category/edit',
                                id: 'edit-category',
                                contentType: 'json',
                                loading: false,
                                done: function (rs) {
                                    if (rs.success) {
                                        popup.msg(rs.message, function () {
                                            $('tr[rel-data=' + id + ']').remove();
                                            var html = Fly.template('/category/trAdd.tpl', rs);
                                            if (rs.data.parentId == 0) {
                                                $('tbody[rel-data="bodydata"]').prepend(html);
                                            } else {
                                                $('tr[rel-data=' + rs.data.parentId + ']').after(html);
                                            }
                                            popup.close('popup-edit-category');
                                        });
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
                        fn: function () {
                            popup.close('popup-edit-category');
                        }
                    }
                ]);
                category.drawcategory(resp.data.parentId);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
category.drawcategory = function (parId) {
    ajax({
        service: '/category/getall',
        loading: false,
        done: function (resp) {
            if (resp.success) {
                var html = '<option value="0">Là danh mục gốc</option>';
                if (resp.data != null && resp.data.length > 0) {
                    $.each(resp.data, function () {
                        if (this.parentId == 0) {
                            var idlv1 = this.id;
                            if (this.id == parId) {
                                html += '<option value="' + this.id + '" selected style="font-weight: bold">-- ' + this.name + '</option>';
                            } else {
                                html += '<option value="' + this.id + '" style="font-weight: bold">-- ' + this.name + '</option>';
                            }
                            $.each(resp.data, function () {
                                if (this.parentId == idlv1) {
                                    var idlv2 = this.id;
                                    if (this.id == parId) {
                                        html += '<option value="' + this.id + '" selected >-- -- ' + this.name + '</option>';
                                    } else {
                                        html += '<option value="' + this.id + '">-- -- ' + this.name + '</option>';
                                    }
                                }
                            });
                        }
                    });
                }
                $('select[name=parentId]').html(html);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};


category.changeActive = function (id) {
    ajax({
        service: '/category/changeactive',
        data: {id: id},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                $("div[data-key-active='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="category.changeActive(\'' + id + '\');" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
category.changePosition = function (id) {
    var position = $('input[rel-data="' + id + '"]').val();
    if (position == '' || position == null) {
        popup.msg("Bạn phải nhập vị trí hiển thị!");
        return;
    }
    ajax({
        service: '/category/changeposition',
        data: {id: id, position: position},
        loading: false,
        done: function (resp) {
            if (resp.success) {

            } else {
                popup.msg(resp.message);
            }
        }
    });
};
category.remove = function (id) {
    popup.confirm("Bạn có chắc chắn muốn xóa danh mục này?", function () {
        ajax({
            service: '/category/remove',
            data: {id: id},
            loading: false,
            done: function (resp) {
                if (resp.success) {
                    popup.msg(resp.message, function () {
                        $('tr[rel-data=' + id + ']').remove();
                    });
                } else {
                    popup.msg(resp.message);
                }
            }
        });
    });
};