<tr rel-data="<%= data.id %>">
    <td class="text-center" style="vertical-align: middle">
        <img src="<%= baseUrl %>images/no_avatar.png" class="lazy" data-original="<%= baseUrl %>images/no_avatar.png" style="max-width:60px; margin:auto;"  class="thumbnail" />
    </td>
    <% if(data.type == 'news'){ %>
    <td class="text-center" style="vertical-align: middle">Tin tức</td>
    <% }else if(data.type == 'activity'){ %>
    <td class="text-center" style="vertical-align: middle">Hoạt động</td>
    <% }else if(data.type == 'about'){ %>
    <td class="text-center" style="vertical-align: middle">Giới thiệu</td>
    <% }else{ %>
    <td class="text-center" style="vertical-align: middle">Chăm sóc khách hàng</td>
    <% } %>
    <td class="text-center" style="vertical-align: middle"><%= data.name %></td>
    <td class="text-center" style="vertical-align: middle">
        <div data-key-active="<%= data.id %>">
            <%= '<label class="label label-' + (data.active == 1 ? 'success' : 'danger') + '" >' + (data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeActive(\'' + data.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (data.active == 1 ? 'check' : 'unchecked') + '" />' %>
        </div>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div class="btn-group">
            <button type="button" class="btn btn-warning" onclick="news.edit('<%= data.id %>');" >
                <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
            </button>
            <button onclick="image.addImage('<%= data.id %>', 'news');" type="button" class="btn btn-success" style="width: 100px;">
                <span class="fa fa-image pull-left" style="line-height: 18px" ></span> Ảnh
            </button>
            <button onclick="news.remove('<%= data.id %>');" type="button" class="btn btn-danger" style="width: 100px;">
                <span class="fa fa-trash pull-left" style="line-height: 18px" ></span> Xóa
            </button>
        </div>
    </td>
</tr>