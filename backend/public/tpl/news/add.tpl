<form class="form-horizontal" id="add-news" style="width: 800px; margin-top: 15px;" >
    <input name="id"  value="<%= (typeof data != 'undefined' ?  data.id : '') %>" type="text" class="form-control" placeholder="id" style="display: none;"/>
    <div class="form-group">
        <label class="control-label col-sm-4">Tên tin tức:</label>
        <div class="col-sm-8">
            <input name="name" type="text" value="<%= (typeof data != 'undefined' ?  data.name : '') %>" class="form-control" onkeydown="textUtils.drawAlias(this)" onkeypress="textUtils.drawAlias(this)" onkeyup="textUtils.drawAlias(this)" placeholder="Tên tin tức"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Mô tả:</label>
        <div class="col-sm-8">
            <textarea name="description"  id="description"  data-alias=description type="text" style="max-width: 524px" class="form-control" placeholder="Mô tả"><%= (typeof data != 'undefined' ?  data.description : '') %></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Loại tin:</label>
        <div class="col-sm-4">
            <select class="form-control" name="type">
                <option value="0" <%= (typeof data != 'undefined' && data.type == 'news' ?  'selected' : '') %> >Tin tức</option>
                <option value="1" <%= (typeof data != 'undefined' && data.type == 'activity' ?  'selected' : '') %> >Hoạt động</option>
                <option value="2" <%= (typeof data != 'undefined' && data.type == 'about' ?  'selected' : '') %> >Giới thiệu</option>
                <option value="3" <%= (typeof data != 'undefined' && data.type == 'customer_care' ?  'selected' : '') %> >Chăm sóc khách hàng</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Trạng thái:</label>
        <div class="col-sm-4">
            <select name="active" class="form-control">
                <option value="1" <%= (typeof data != 'undefined' && data.active == 1 ?  'selected' : '') %>>Hoạt động</option>
                <option value="0" <%= (typeof data != 'undefined' && data.active == 0 ?  'selected' : '') %>>Tạm khóa</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Nội dung:</label>
    </div>
    <div class="form-group">
        <div style="margin-left: 125px;">
            <textarea name="detail" id="detail" class="form-control" style="height: 50px; margin: auto" ><%= typeof data != 'undefined'?data.detail:'' %></textarea>
        </div>
    </div>
</form>