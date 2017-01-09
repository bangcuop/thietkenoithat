<tr rel-data="<%= data.id %>" class="success">
    <td class="text-center" style="vertical-align: middle"><%= data.id %></td>
    <td>
        <p class="title-item" style="font-weight: '<%= data.level ==1 ? 'bold' : '' %>' ">
            <% if(data.level == 1 ){ %>
            -- <%= data.name %>
            <% } else if(data.level == 2 ){ %>
            -- -- <%= data.name %>
            <% }  %>
        </p>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div data-key-active="<%= data.id %>">
            <%= '<label class="label label-' + (data.active == 1 ? 'success' : 'danger') + '" >' + (data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="category.changeActive(\'' + data.id + '\')" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (data.active == 1 ? 'check' : 'unchecked') + '" />' %>
        </div>
    </td>
    <td class="text-center" style="vertical-align: middle">
        <input type="text" onchange="category.changePosition('<%= data.id %>');" rel-data="<%= data.id %>" class="text-center" value="<%= data.position %>" size="4">
    </td>
    <td class="text-center" style="vertical-align: middle">
        <div class="btn-group">
            <button type="button" class="btn btn-warning btn-left" onclick="category.edit('<%= data.id %>')" >
                <i class="glyphicon glyphicon-edit pull-left" style="line-height: 16px"></i>Sửa
            </button>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-danger btn-left" onclick="category.remove('<%= data.id %>')" >
                <i class="glyphicon glyphicon-trash pull-left" style="line-height: 16px"></i>Xóa
            </button>
        </div>
    </td>
</tr>