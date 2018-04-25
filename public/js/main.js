(function($) {
    $.fn.TienPham = function() {
        
    }
})(jQuery);

function doButtonAction(btn_class, btn_action) {
    var selected_checkbox = new Array();
    $('input[name="select"]:checked').each(function() {
        selected_checkbox.push(this.value);
    });
    var site_url = $('#site_url').val();

    //check if not selected at least 1
    if(selected_checkbox.length === 0) {
        alert('Không có danh mục nào được chọn!');
        return false;
    }

    //edit
    if(btn_action === 'edit') {
        window.location.replace(site_url + '/edit/' + selected_checkbox[0]);
    }
    return true;
}