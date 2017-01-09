var urlsUtils = {};

/**
 * Danh mục tin tức
 * @param type $alias
 * @return type
 */
urlsUtils.browse = function (alias) {
    if (typeof alias == 'undefined' || alias == null) {
        return "danh-muc-san-pham.html";
    }
    return "p/" + alias;
}

/**
 * Detail sản phẩm
 * @param {type} name
 * @param {type} id
 * @returns {String}
 */
urlsUtils.item = function (name, id) {
    return "p/" + textUtils.createAlias(name) + "-" + id + ".html";
};