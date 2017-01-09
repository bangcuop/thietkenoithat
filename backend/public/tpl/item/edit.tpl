<form class="form-horizontal" id="add-item" style="width: 800px; margin-top: 15px;" >
    <div class="form-group">
        <label class="control-label col-sm-4">Mã sản phẩm:</label>
        <div class="col-sm-4">
            <input name="id" id="id" disabled="" value="<%= (typeof data != 'undefined' ?  data.id : '') %>" type="text" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Tên sản phẩm:</label>
        <div class="col-sm-8">
            <input name="name" id="name"  value="<%= (typeof data != 'undefined' ?  data.name : '') %>" type="text" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Danh mục:</label>
        <div class="col-sm-4">
            <select class="form-control" id="categoryId" name="categoryId">
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Trạng thái:</label>
        <div class="col-sm-3">
            <select name="active" class="form-control" id="active">
                <option value="1" <%= (typeof data != 'undefined' && data.active == 1 ?  'selected' : '') %>>Hoạt động</option>
                <option value="0" <%= (typeof data != 'undefined' && data.active == 0 ?  'selected' : '') %>>Tạm khóa</option>
            </select>
        </div>
        <label class="control-label col-sm-2">Màu sắc:</label>
        <div class="col-sm-3">
            <input name="color" type="text" id="color" value="<%= (typeof data != 'undefined' ?  data.color : '') %>"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Số lượng:</label>
        <div class="col-sm-3">
            <input name="quantity" type="text" id="quantity" value="<%= (typeof data != 'undefined' ?  data.quantity : '') %>"  class="form-control"/>
        </div>
        <label class="control-label col-sm-2">Kích cỡ:</label>
        <div class="col-sm-3">
            <input name="size" type="text" id="size" value="<%= (typeof data != 'undefined' ?  data.size : '') %>"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Giá bán:</label>
        <div class="col-sm-3">
            <input name="sellPrice" type="text" value="<%= (typeof data != 'undefined' ?  data.sellPrice : '') %>" id="sellPrice"   class="form-control"/>
        </div>
        <label class="control-label col-sm-2">Dòng sản phẩm:</label>
        <div class="col-sm-3">
            <select name="prototype" class="form-control" id="prototype">
                <option value="classic" <%= (typeof data != 'undefined' && data.prototype == 'classic' ?  'selected' : '') %>>Cổ điển</option>
                <option value="modern" <%= (typeof data != 'undefined' && data.prototype == 'modern' ?  'selected' : '') %>>Hiện đại</option>
                <option value="crafts" <%= (typeof data != 'undefined' && data.prototype == 'crafts' ?  'selected' : '') %>>Thủ công mỹ nghệ</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Mô tả:</label>
        <div class="col-sm-8">
            <textarea class="form-control" id="description" style="max-width: 523px" name="description"><%= (typeof data != 'undefined' ?  data.description : '') %></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Loại sản phẩm:</label>
        <div class="col-sm-8">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="special"  name="special" value="1" onclick="item.showPosition();" <%= (typeof data != 'undefined' && data.special == 1 ?  'checked' : '') %>>Sản phẩm đặc biệt
                </label>
                <label style="margin-left: 50px;" id="position" name="position" <%= (typeof data != 'undefined' && data.special == 1 ?  '' : 'hidden=""') %> >
                       <input type="text"  name="position" value="<%= (typeof data != 'undefined' ?  data.position : '') %>"> Thứ tự
                </label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" id="bestSelling" name="bestSelling" <%= (typeof data != 'undefined' && data.bestSelling == 1 ?  'checked' : '') %>>Sản phẩm bán chạy</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" id="suggest" name="suggest" <%= (typeof data != 'undefined' && data.suggest == 1 ?  'checked' : '') %>>Sản phẩm gợi ý</label>
            </div>
        </div>
    </div>
</form>