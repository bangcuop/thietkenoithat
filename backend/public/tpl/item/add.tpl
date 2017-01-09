<form class="form-horizontal" id="add-item" style="width: 800px; margin-top: 15px;" >
    <div class="form-group">
        <label class="control-label col-sm-4">Mã sản phẩm:</label>
        <div class="col-sm-4">
            <input name="id" id="id" type="text" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Tên sản phẩm:</label>
        <div class="col-sm-8">
            <input name="name" id="name"  type="text" class="form-control"/>
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
                <option value="1">Hoạt động</option>
                <option value="0">Tạm khóa</option>
            </select>
        </div>
        <label class="control-label col-sm-2">Màu sắc:</label>
        <div class="col-sm-3">
            <input name="color" type="text" id="color"   class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Số lượng:</label>
        <div class="col-sm-3">
            <input name="quantity" type="text" id="quantity"   class="form-control"/>
        </div>
        <label class="control-label col-sm-2">Kích cỡ:</label>
        <div class="col-sm-3">
            <input name="size" type="text" id="size"   class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Giá bán:</label>
        <div class="col-sm-3">
            <input name="sellPrice" type="text" id="sellPrice"   class="form-control"/>
        </div>
        <label class="control-label col-sm-2">Dòng sản phẩm:</label>
        <div class="col-sm-3">
            <select name="prototype" class="form-control" id="prototype">
                <option value="classic">Cổ điển</option>
                <option value="modern">Hiện đại</option>
                <option value="crafts">Thủ công mỹ nghệ</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Mô tả:</label>
        <div class="col-sm-8">
            <textarea class="form-control" id="description" style="max-width: 523px" name="description"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Loại sản phẩm:</label>
        <div class="col-sm-8">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="special" name="special" value="1" onclick="item.showPosition();">Sản phẩm đặc biệt
                </label>
                <label style="margin-left: 50px;" id="position" name="position" hidden="">
                    <input type="text"  name="position"> Thứ tự
                </label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" id="bestSelling" name="bestSelling" value="1">Sản phẩm bán chạy</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" id="suggest" name="suggest" value="1">Sản phẩm gợi ý</label>
            </div>
        </div>
    </div>
</form>