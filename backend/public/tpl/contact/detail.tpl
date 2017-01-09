<table class="table table-bordered" style="margin: 15px;width: 97%">
    <tr>
        <td><b>Tên</b></td>
        <td colspan="3"><%= data.name %></td>
    </tr>
    <tr>
        <td><b>Số điện thoại</b></td>
        <td colspan="3"><%= data.phone %> </td>
    </tr>
    <tr>
        <td><b>Email</b></td>
        <td colspan="3"><%= data.email %></td>
    </tr>
    <tr>
        <td><b>Ghi chú</b></td>
        <td colspan="3"><textarea disabled="" style="width: 100%; height: 150px;"><%= data.note %></textarea></td>
    </tr>
</table>