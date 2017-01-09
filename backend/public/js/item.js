var item = {};
item.grid = function () {
    layout.title("Danh sách quản lý sản phẩm Minh Đoàn");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Sản phẩm", "#item/grid"],
        ["Danh sách sản phẩm"]
    ]);
    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }

    search.w_thum = 140;
    search.h_thum = 130;

    ajax({
        service: '/item/grid',
        data: search,
        loading: false,
        done: function (resp) {
            if (resp.success) {
                layout.container(Fly.template("/item/grid.tpl", resp));
                setTimeout(function () {
                    setTimeout(function () {
                        $("img.lazy").lazyload({
                            effect: "fadeIn",
                        });
                    }, 100);
                    viewUtils.initSearch("search");
                    $('input[data-search=createTimeFrom]').timeSelect(true);
                    $('input[data-search=createTimeTo]').timeSelect(true);
                    $('input[data-search=updateTimeFrom]').timeSelect(true);
                    $('input[data-search=updateTimeTo]').timeSelect(true);
                    item.showCategoryName();
                }, 300);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
item.add = function () {
    popup.open('popup-add-item', 'Thêm mới sản phẩm', Fly.template('/item/add.tpl'), [
        {
            title: 'Thêm mới',
            style: 'btn-primary',
            loading: false,
            fn: function () {
                var id = $('input[id=id]').val();
                var name = $('input[id=name]').val();
                var categoryId = $('select[name=categoryId]').val();
                var active = $('select[id=active]').val();
                var description = $('textarea[id=description]').val();
                var sellPrice = $('input[id=sellPrice]').val();
                var special = $('input[name="special"]').is(':checked') ? 1 : 0;
                var bestSelling = $('input[name="bestSelling"]').is(':checked') ? 1 : 0;
                var suggest = $('input[name="suggest"]').is(':checked') ? 1 : 0;
                var position = special == 1 ? $('input[name=position]').val() : 0;
                var quantity = $('input[id=quantity]').val();
                var prototype = $('select[id=prototype]').val();
                var color = $('input[id=color]').val();
                var size = $('input[id=size]').val();
                ajax({
                    service: '/item/add',
                    data: {id: id, name: name, categoryId: categoryId, active: active,
                        description: description, sellPrice: sellPrice,
                        special: special, bestSelling: bestSelling, suggest: suggest,
                        position: position, prototype: prototype, quantity: quantity, color: color, size: size},
                    loading: false,
                    type: 'POST',
                    done: function (rs) {
                        if (rs.success) {
                            viewUtils.btnReset('search');
                            popup.msg(rs.message, function () {
                                location.reload();
                            });
                        } else {
                            popup.msg(rs.message, function () {
                                $('.form-group').removeClass('has-error');
                                $('span.help-block').empty();
                                $.each(rs.data, function (key, value) {
                                    $('#' + key).after('<span class="help-block">' + value + '</span>');
                                    $('#' + key).parent().parent().addClass('has-error');
                                });
                            });
                        }
                    }
                });
            }
        },
        {
            title: 'Hủy',
            style: 'btn-default',
            fn: function () {
                popup.close('popup-add-item');
            }
        }
    ], 'modal-lg');
    setTimeout(function () {
//        editor("detail", {});
        item.drawcategory();
    }, 100);
};


item.edit = function (id) {
    ajax({
        service: '/item/getbyid',
        data: {id: id},
        loading: false,
        done: function (rs) {
            if (rs.success) {
                popup.open('popup-edit-item', 'Sửa thông tin sản phẩm', Fly.template('/item/edit.tpl', rs), [
                    {
                        title: 'Sửa',
                        style: 'btn-primary',
                        fn: function () {
                            var id = $('input[id=id]').val();
                            var name = $('input[id=name]').val();
                            var categoryId = $('select[id=categoryId]').val();
                            var active = $('select[id=active]').val();
                            var description = $('textarea[id=description]').val();
                            var sellPrice = $('input[id=sellPrice]').val();
                            var special = $('input[name="special"]').is(':checked') ? 1 : 0;
                            var bestSelling = $('input[name="bestSelling"]').is(':checked') ? 1 : 0;
                            var suggest = $('input[name="suggest"]').is(':checked') ? 1 : 0;
                            var position = special == 1 ? $('input[name=position]').val() : 0;
                            var quantity = $('input[name=quantity]').val();
                            var prototype = $('select[id=prototype]').val();
                            var color = $('input[id=color]').val();
                            var size = $('input[id=size]').val();
                            ajax({
                                service: '/item/edit',
                                data: {id: id, name: name, categoryId: categoryId, active: active,
                                    description: description, sellPrice: sellPrice,
                                    special: special, bestSelling: bestSelling, suggest: suggest, position: position,
                                    quantity: quantity, prototype: prototype, color: color, size: size},
                                loading: false,
                                type: 'POST',
                                done: function (rs) {
                                    if (rs.success) {
                                        popup.msg(rs.message, function () {
                                            location.reload();
                                        });
                                    } else {
                                        popup.msg(rs.message, function () {
                                            $('.form-group').removeClass('has-error');
                                            $('span.help-block').empty();
                                            $.each(rs.data, function (key, value) {
                                                $('#' + key).after('<span class="help-block">' + value + '</span>');
                                                $('#' + key).parent().parent().addClass('has-error');
                                            });
                                        });
                                    }
                                }
                            });
                        }
                    },
                    {
                        title: 'Hủy',
                        style: 'btn-default',
                        fn: function () {
                            popup.close('popup-edit-item');
                        }
                    }
                ], 'modal-lg');
                item.drawcategory(rs.data.categoryId);
                $('input[id=id]').css("disabled", "true");
            } else {
                popup.msg(rs.message);
            }
        }
    });
};

item.formatSellPrice = function () {
    var price = $('input[name=sellPrice]').val();
    price = parseInt(price);
    if (price > 0) {
        var formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
            minimumFractionDigits: 0,
        });
        var priceFormat = formatter.format(price);
        $('input[name=sellPrice]').val(priceFormat);
    }
};
item.showPosition = function () {
    if ($('input[name="special"]').is(':checked')) {
        $('label[id=position]').show();
    } else {
        $('label[id=position]').hide();
    }
};
item.drawcategory = function (parId) {
    ajax({
        service: '/category/getall',
        loading: false,
        done: function (resp) {
            if (resp.success) {
                var html = '<option value="">-----------Chọn danh mục-----------</option>';
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
                                    $.each(resp.data, function () {
                                        if (this.parentId == idlv2) {
                                            var idlv3 = this.id;
                                            if (this.id == parId) {
                                                html += '<option value="' + this.id + '" selected >-- -- --' + this.name + '</option>';
                                            } else {
                                                html += '<option value="' + this.id + '">-- -- -- ' + this.name + '</option>';
                                            }
                                            $.each(resp.data, function () {
                                                if (this.parentId == idlv3) {
                                                    if (this.id == parId) {
                                                        html += '<option value="' + this.id + '" selected >-- -- -- -- ' + this.name + '</option>';
                                                    } else {
                                                        html += '<option value="' + this.id + '">-- -- -- -- ' + this.name + '</option>';
                                                    }
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
                $('select[name=categoryId]').html(html);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

item.changeActive = function (id) {
    ajax({
        service: '/item/changeactive',
        data: {id: id},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                $("div[data-key-active='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="item.changeActive(\'' + id + '\');" style="cursor: pointer; margin-left:5px" class="glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

item.detail = function (id) {
    ajax({
        service: '/item/getbyid',
        data: {id: id},
        loading: false,
        done: function (rs) {
            if (rs.success) {
                popup.open('popup-detail-item', 'Chi tiết sản phẩm', Fly.template('/item/detail.tpl', rs), [
                    {
                        title: 'Lưu',
                        style: 'btn-primary',
                        fn: function () {
                            var detail = CKEDITOR.instances['detail'].getData();
                            ajax({
                                service: '/item/savedetail',
                                data: {id: id, detail: detail},
                                loading: false,
                                done: function (rs) {
                                    if (rs.success) {
                                        popup.msg(rs.message, function () {
                                            location.reload();
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
                            popup.close('popup-detail-item');
                        }
                    }
                ], 'modal-lg');
                setTimeout(function () {
                    editor("detail", {});
                }, 50);
            } else {
                popup.msg(rs.message);
            }
        }
    });
};

item.removeItem = function (id) {
    popup.confirm("Bạn có chắc chắn muốn xóa sản phẩm này?", function () {
        ajax({
            service: '/item/remove',
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

item.showCategoryName = function () {
    ajax({
        service: '/category/getall',
        loading: false,
        done: function (resp) {
            if (resp.success) {
                $.each(resp.data, function () {
                    $('b[rel-categoryId-item="' + this.id + '"]').text(this.name);
                });
            } else {
                popup.msg(resp.message);
            }
        }
    });
};