<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Quản lý sản phẩm
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#item/grid">Danh sách sản phẩm</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->
    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#item/grid" id="search" class="form row" >
                <div class="col-sm-3 padding-right-5">
                    <input data-search="id" name="id" type="text" class="form-control" placeholder="Mã sản phẩm">
                    <select class="form-control" name="type" data-search="type" style="margin-top: 5px;">
                        <option value="0">-----Loại sản phẩm-----</option>
                        <option value="1">Sản phẩm đặc biệt</option>
                        <option value="2">Sản phẩm bán chạy</option>
                        <option value="3">Sản phẩm gợi ý</option>
                        <option value="4">Không thuộc loại nào</option>
                    </select>
                    <select class="form-control" name="prototype" data-search="prototype" style="margin-top: 5px;">
                        <option value="0">-----Dòng sản phẩm-----</option>
                        <option value="1">Cổ điển</option>
                        <option value="2">Hiện đại</option>
                        <option value="3">Thủ công mỹ nghệ</option>
                    </select>
                </div><!-- /col -->
                <div class="col-sm-3 padding-right-5">
                    <input data-search="name" name="name" type="text" class="form-control" placeholder="Tên sản phẩm">
                    <select class="form-control" name="active" data-search="active" style="margin-top: 5px;">
                        <option value="0">-----Trạng thái-----</option>
                        <option value="1">Hoạt động</option>
                        <option value="2">Đang khóa</option>
                    </select>
                </div><!-- /col -->
                <div class="col-sm-3 padding-right-5">
                    <input data-search="priceFrom" name="priceFrom" type="text"  class="form-control" placeholder="Giá từ">
                    <input data-search="priceTo" name="priceTo" type="text" class="form-control" style="margin-top: 5px;" placeholder="Giá đến">
                </div><!-- /col -->
                <div class="col-sm-3 padding-right-5">
                    <div class="input-group">
                        <input type="hidden" name="createTimeFrom" data-search="createTimeFrom" class="form-control" placeholder="Thời gian tạo từ">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <div class="input-group" style="margin-top: 5px;">
                        <input type="hidden" name="createTimeTo" data-search="createTimeTo" class="form-control" placeholder="Thời gian tạo đến">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div><!-- /col -->
                <div class="col-sm-3 padding-left-6">
                    <button onclick="viewUtils.btnSearch('search')" type="button" class="btn btn-info">
                        <span class="glyphicon glyphicon-search"></span> Search
                    </button>
                    <button onclick="viewUtils.btnReset('search');" type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                    </button>
                </div><!-- /col -->
            </form><!-- /form -->
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive" id="tableItem">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="success" >
                        <th class="text-center" style="vertical-align: middle;width: 50px;">STT</th>
                        <th class="text-center" style="vertical-align: middle;width: 120px" >Ảnh</th>
                        <th class="text-center" style="vertical-align: middle;width: 350px;">Thông tin sản phẩm</th>
                        <th class="text-center" style="vertical-align: middle;width: 150px" >Giá sản phẩm</th>
                        <th class="text-center" style="vertical-align: middle;width: 200px" >Thời gian</th>
                        <th class="text-center" style="vertical-align: middle;width: 80px" >Trạng thái</th>
                        <th class="text-center" style="vertical-align: middle;width: 250px" >Chức năng<i style="cursor: pointer" onclick="item.add();" class="pull-right glyphicon glyphicon-plus"></th>
                    <tr>
                </thead>
                <tbody>
                    <% if (data.data.length <= 0 ){ %>
                    <tr>
                        <td colspan="7" class="text-danger" style="text-align: center">Không tìm thấy sản phẩm nào !</td>
                    </tr>
                </tbody>
                <% }else{ %>
                <% $.each(data.data, function(index){ %>
                <tr rel-data="<%= this.id %>">
                    <td class="text-center" style="vertical-align: middle"><%= eval(index+1) %></td>
                    <td class="text-center" style="vertical-align: middle">
                        <% if(this.images.length > 0){ %>
                        <img src="<%= baseUrl %>images/ajax-loader.gif" class="lazy" data-original="<%= this.images[0] %>" style="max-width:60px; margin:auto;" class="thumbnail"/>
                        <%}else { %>
                        <img src="<%= baseUrl %>images/no_avatar.png" class="lazy" data-original="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"  class="thumbnail" />
                        <% } %>
                    </td>
                    <td class="text-left">
                        <p class="title-item">Tên: <b><%= this.name %></b>  (Mã :<%= this.id %>)</p>
                        <p class="title-item">Danh mục: <b rel-categoryId-item="<%= this.categoryId %>"></b>
                            <% if(this.special == 0 && this.bestSelling == 0 && this.suggest == 0){ %>
                        <p class="title-item">Loại:<b>Bình thường</b></p>
                        <% } else{ %>
                        <p class="title-item">Loại: 
                        <p><label class="label label-success"><%= this.special == 1 ? ' Đặc biệt' : '' %></label></p>
                        <p><label class="label label-success"><%= this.bestSelling == 1 ? ' Bán chạy' : '' %></label></p>
                        <p><label class="label label-success"><%= this.suggest == 1 ? ' Gợi ý' : '' %></label></p>
                        </p>
                        <% } %>
                        <% if(this.special == 1){ %>
                        <p class="title-item text-primary">Thứ tự hiển thị: <b><%= this.position %></b></p>
                        <% } %>
                        <p class="title-item">Dòng sản phẩm:
                            <% if(this.prototype == 'classic'){ %>
                            <b class="text-danger">Cổ điển</b>
                            <% }else if(this.prototype == 'modern'){ %>
                            <b class="text-danger">Hiện đại</b>
                            <% }else{ %>
                            <b class="text-danger">Thủ công mỹ nghệ</b>
                            <% } %>
                        </p>
                        <p class="title-item">Số lượng: <b><%= (this.quantity != null && this.quantity != '') ?  this.quantity : 'chưa nhập' %></b>
                            <% if(this.color != null && this.color != ''){ %>
                        <p class="title-item">Màu sắc: <b><%= this.color %></b>
                            <% } %>
                            <% if(this.size != null && this.size != ''){ %>
                        <p class="title-item">Kích cỡ: <b><%= this.size %></b>
                            <% } %>
                        <p class="title-item">Người đăng: <b><%= this.createEmail %></b>
                    </td>
                    <td class="text-left" style="vertical-align: middle;">
                        <span style='color:red; font-weight: bold'><%= eval(this.sellPrice).toMoney() %></span> VNĐ
                    </td>
                    <td class="text-left">
                        <p>Thời gian đăng: <b><%= textUtils.formatTime(this.createTime,'day') %></b></p>
                        <p>Thời gian sửa: <b><%= textUtils.formatTime(this.updateTime,'day') %></b></p>
                    </td>
                    <td class="text-left" style="vertical-align: middle;font-weight: bold">
                        <div data-key-active="<%= this.id %>">
                            <% var active = this.active %>
                            <%= '<label class="label label-' + (this.active == 1 ? 'success' : 'danger') + '" >' + (this.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="item.changeActive(\'' + this.id + '\',\'' + active + '\')" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (this.active == 1 ? 'check' : 'unchecked') + '" />' %>
                        </div>
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning" style="width: 100px" onclick="item.edit('<%= this.id %>');" >
                                <span class="glyphicon glyphicon-edit pull-left"  style="line-height: 16px"></span>Sửa
                            </button>
                            <button onclick="item.removeItem('<%= this.id %>');"  style="width: 100px; margin-left: 5px" type="button" class="btn btn-danger" style="width: 100px;">
                                <span class="fa fa-trash pull-left" style="line-height: 18px" ></span> Xóa
                            </button>
                        </div>
                        <div class="btn-group" style="margin-top: 10px">
                            <button onclick="item.detail('<%= this.id %>');"  style="width: 100px" type="button" class="btn btn-info" style="width: 100px;">
                                <span class="fa fa-list pull-left" style="line-height: 18px" ></span> Chi tiết
                            </button>
                            <button onclick="image.addImage('<%= this.id %>', 'item');" style="width: 100px;margin-left: 5px" type="button" class="btn btn-success" style="width: 100px;">
                                <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
                            </button>
                        </div>
                    </td>
                </tr>
                <% }); %>
                <% } %>
            </table>
            <%= viewUtils.dataPage(data, [])  %>
            <div class="clearfix"></div>
        </div><!-- /table-responsive -->
    </div><!-- /func-container -->
</div><!-- /cms-content -->

