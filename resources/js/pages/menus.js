$(document).ready(function () {
    /**
     * change menu name to slug on update section
     */
    $('#menu-name-update').on('keyup', function (evt) {
        let _menuNameVal = changeToSlug($(this).val());
        $('#menu-slug-update').val(_menuNameVal);
    });

    /**
     * change sub menu name on create section
     */
    $('#sub-menu-name-create').on('keyup', function () {
        let _menuNameVal = changeToSlug($(this).val());
        $('#sub-menu-slug-update').val(_menuNameVal);
    });

    /**
     * ben change sub menu
     */
    $('#btn-add-submenu').on('click', function () {
        $.ajax({
            url: '/admin/menus/create',
            type: 'get',
            data: {},
            success: function (result) {
                $('#show-sub-menu').html(result.data);
            }
        });
    });
});

/**
 * function get and show submenu and render view table
 *
 * @param idMenu
 */
window.showSubMenu = function (idMenu) {
    $.ajax({
        url: '/admin/menus/show/' + idMenu,
        type: 'get',
        data: {},
        beforeSend: function () {
            // show overloading
        },
        success: function (result) {
            if (result.code === 200) {
                $('#show-sub-menu').html(result.data);
            }

            return null;
        },
    });
};

/**
 * function change text to slug
 *
 * @param title
 * @returns {string}
 * @constructor
 */
window.changeToSlug = function (title)
{
    var slug;

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”

    return slug;
};
