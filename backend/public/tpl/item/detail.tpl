<form class="form-horizontal" id="add-detail-item" style="width: 800px; margin-top: 15px;" >
    <input name="id"  value="<%= (typeof data != 'undefined' ?  data.id : '') %>" type="text" class="form-control" placeholder="id" style="display: none;"/>
    <div class="form-group">
        <div style="margin-left: 125px;">
            <textarea name="detail" id="detail" class="form-control" style="height: 50px; margin: auto" ><%= typeof data != 'undefined'? data.details : '' %></textarea>
        </div>
    </div>
</form>