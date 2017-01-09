<div class="cms-content">
    <h1 class="func-title">
        <i class="fa fa-edit fa-fw"></i>
        Tin tức
    </h1>
    <div class="panel panel-default panel-tabs" style="margin-bottom: 0px;" >
        <div class="panel-heading">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#news/grid">Danh sách tin tức</a></li>
            </ul>
        </div>
    </div>
    <!-- /panel -->

    <div class="func-container">
        <div class="func-yellow">
            <form method="GET" action="#news/grid" id="search" class="form row" >
                <div class="col-sm-3 padding-right-5">
                    <input data-search="keyword" name="keyword" type="text" class="form-control" placeholder="Từ Khóa">
                    <div style="margin-top: 5px;">
                        <select class="form-control" name="active" data-search="active">
                            <option value="0" >---Chọn trạng thái---</option>
                            <option value="1" >Hoạt động</option>
                            <option value="2" >Tạm khóa</option>
                        </select>
                    </div><!-- /col -->
                    <div style="margin-top: 5px;">
                        <select class="form-control" name="type" data-search="type">
                            <option value="" >---Chọn loại tin---</option>
                            <option value="news" >Tin tức</option>
                            <option value="activity" >Hoạt động</option>
                            <option value="about" >Giới thiệu</option>
                            <option value="customer_care" >Chăm sóc khách hàng</option>
                        </select>
                    </div><!-- /col -->
                </div><!-- /col -->
                <div class="col-sm-3">
                    <button onclick="viewUtils.btnSearch('search')" type="button" class="btn btn-info">
                        <span class="glyphicon glyphicon-search"></span>Tìm kiếm
                    </button>
                </div><!-- /col -->
            </form><!-- /form -->
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive">
            <table id="mytable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr class="success" >
                        <th class="text-center" style="vertical-align: middle;width: 80px" >Ảnh</th>
                        <th class="text-center" style="vertical-align: middle;width: 80px" >Loại tin</th>
                        <th class="text-center" style="vertical-align: middle" >Tên tin tức</th>
                        <th class="text-center" style="vertical-align: middle;width: 100px" >Trạng thái</th>
                        <th class="text-center" style="vertical-align: middle;width: 320px" > 
                            Chức năng<i style="cursor: pointer" onclick="news.add();" class="pull-right glyphicon glyphicon-plus">
                        </th>
                    <tr>
                </thead>
                <tbody rel-data="bodydata">
                    <% if (data.length <= 0 ){ %>
                    <tr>
                        <td colspan="5" class="text-danger" style="text-align: center">Không tồn tại tin tức nào trong cơ sở dữ liệu!</td>
                    </tr>
                    <% }else{ %>
                    <% $.each(data.data, function(index){ %>
                    <tr rel-data="<%= this.id %>">
                        <td class="text-center" style="vertical-align: middle">
                            <% if(this.images.length > 0){ %>
                            <img src="<%= baseUrl %>images/ajax-loader.gif" class="lazy" data-original="<%= this.images[0] %>" style="max-width:60px; margin:auto;" class="thumbnail"/>
                            <%}else { %>
                            <img src="<%= baseUrl %>images/no_avatar.png" class="lazy" data-original="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"  class="thumbnail" />
                            <% } %>
                        </td>
                        <% if(this.type == 'news'){ %>
                        <td class="text-center" style="vertical-align: middle">Tin tức</td>
                        <% }else if(this.type == 'activity'){ %>
                        <td class="text-center" style="vertical-align: middle">Hoạt động</td>
                        <% }else if(this.type == 'about'){ %>
                        <td class="text-center" style="vertical-align: middle">Giới thiệu</td>
                        <% }else{ %>
                        <td class="text-center" style="vertical-align: middle">Chăm sóc khách hàng</td>
                        <% } %>
                        <td class="text-left" style="vertical-align: middle;font-weight: bold" data-name="<%= this.id %>"><%= this.name %></td>
                        <td class="text-center" style="vertical-align: middle">
                            <div data-key-active="<%= this.id %>">
                                <%= '<label class="label label-' + (this.active == 1 ? 'success' : 'danger') + '" >' + (this.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeActive(\'' + this.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (this.active == 1 ? 'check' : 'unchecked') + '" />' %>
                            </div>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" onclick="news.edit('<%= this.id %>');" >
                                    <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
                                </button>
                                <button onclick="image.addImage('<%= this.id %>', 'news');" type="button" class="btn btn-success" style="width: 100px;">
                                    <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
                                </button>
                                <button onclick="news.remove('<%= this.id %>');" type="button" class="btn btn-danger" style="width: 100px;">
                                    <span class="fa fa-trash pull-left" style="line-height: 18px" ></span> Xóa
                                </button>
                            </div>
                        </td>
                    </tr>
                    <% }); %>
                    <% } %>
                </tbody>
            </table>
            <%= viewUtils.dataPage(data, [])  %>
            <div class="clearfix"></div>
        </div><!-- /table-responsive -->
    </div><!-- /func-container -->
</div><!-- /cms-content -->

