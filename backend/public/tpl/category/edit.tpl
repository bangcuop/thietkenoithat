<form class="form-horizontal" id="edit-category" style="width: 500px; margin-top: 15px;" >
    <input name="id" type="hidden"  value="<%= typeof data != 'undefined'?data.id:'' %>"/>
    <input name="createEmail" type="hidden"  value="<%= typeof data != 'undefined'?data.createEmail:'' %>"/>
    <div class="form-group">
        <label class="control-label col-sm-4">Tên danh mục:</label>
        <div class="col-sm-8">
            <input name="name" type="text" value="<%= typeof data != 'undefined'?data.name:'' %>" class="form-control" onkeydown="textUtils.drawAlias(this)" onkeypress="textUtils.drawAlias(this)" onkeyup="textUtils.drawAlias(this)" placeholder="Tên danh mục"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Danh mục gốc:</label>
        <div class="col-sm-8">
            <select class="form-control" name="parentId">
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Trạng thái:</label>
        <div class="col-sm-4">
            <select name="active" class="form-control">
                <option value="1" <%= data.active == 1 ? 'selected' : '' %> >Hoạt động</option>
                <option value="2" <%= data.active == 0 ? 'selected' : '' %> >Tạm khóa</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Thứ tự:</label>
        <div class="col-sm-8">
            <input name="position"  type="text" class="form-control" value="<%= typeof data != 'undefined'?data.position:'' %>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Mô tả:</label>
        <div class="col-sm-8">
            <textarea name="description" type="text"class="form-control" ><%= typeof data != 'undefined'?data.description:'' %></textarea>
        </div>
    </div>
</form>