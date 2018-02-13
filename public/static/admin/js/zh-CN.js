// validator
function zh_validator() {
    // 验证手机号
    jQuery.validator.addMethod("mobile", function(value, element) {
        var tel = /^1[3|4|5|7|8]\d{9}$/;
        return this.optional(element) || (tel.test(value));
    }, "请输入有效的手机号码");

    // 验证手机号
    jQuery.validator.addMethod("hnum", function(value, element) {
        var tel = /^\d{8}$/;
        return this.optional(element) || (tel.test(value));
    }, "请输入有效的会员卡号");

    // 验证身份证号
    jQuery.validator.addMethod("cardid", function(value, element) {
        var tel = /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;
        return this.optional(element) || (tel.test(value));
    }, "请输入有效的身份证号");

    // 自定义正则验证
    jQuery.validator.addMethod("regular", function(value, element) {
        var regular = eval(element.getAttribute('data-rule-regular'));
        return this.optional(element) || (regular.test(value));
    }, "输入有误");

    $.extend($.validator.messages, {
        required: "这是必填字段",
        remote: "请修正此字段",
        email: "请输入有效的电子邮件地址",
        url: "请输入有效的网址",
        date: "请输入有效的日期",
        dateISO: "请输入有效的日期 (YYYY-MM-DD)",
        number: "请输入有效的数字",
        digits: "只能输入数字",
        creditcard: "请输入有效的信用卡号码",
        equalTo: "你的输入不相同",
        extension: "请输入有效的后缀",
        maxlength: $.validator.format("最多可以输入 {0} 个字符"),
        minlength: $.validator.format("最少要输入 {0} 个字符"),
        rangelength: $.validator.format("请输入长度在 {0} 到 {1} 位字符"),
        range: $.validator.format("请输入范围在 {0} 到 {1} 之间的数值"),
        max: $.validator.format("请输入不大于 {0} 的数值"),
        min: $.validator.format("请输入不小于 {0} 的数值")
    });
}

// table
function zh_table() {
    $.extend($.fn.bootstrapTable.defaults, {
        formatLoadingMessage: function() {
            return '加载数据中，请稍候……'; },
        formatRecordsPerPage: function(pageNumber) {
            return '每页显示 ' + pageNumber + ' 条记录'; },
        formatShowingRows: function(pageFrom, pageTo, totalRows) {
            return '显示第 ' + pageFrom + ' 到第 ' + pageTo + ' 条记录，总共 ' + totalRows + ' 条记录'; },
        formatSearch: function() {
            return '搜索'; },
        formatNoMatches: function() {
            return '没有找到匹配的记录'; },
        formatRefresh: function() {
            return '刷新'; },
        formatToggle: function() {
            return '切换'; },
        formatColumns: function() {
            return '选择列'; }
    });
}
