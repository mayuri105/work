$(function(n) {
    function u(t) {
        var i = new Date(t.attr("data-iso-date")),
            r = t.parents(".hz-date-picker-outer");
        return n(".hz-date-picker-item").removeClass("active"), t.addClass("active"), r.find("input.hz-datepicker-selected-date").val(s(i)), i
    }

    function o(n) {
        return '<div class="hz-date-picker-item" data-iso-date="' + n.isoDate + '"><label class="hz-month">' + n.month + '<\/label><label class="hz-date">' + n.date + '<\/label><label class="hz-day">' + n.day + "<\/label><\/div>"
    }

    function s(n) {
        var t = n.getDate(),
            i = n.getMonth(),
            r = n.getFullYear();
        return t + "/" + (i + 1) + "/" + r
    }
    var r, t;
    n.fn.hzDatePicker = function(t) {
        if (i[t]) return i[t].apply(this, Array.prototype.slice.call(arguments, 1));
        if (typeof t != "object" && t) n.error("Method " + t + " does not exists.");
        else return i.init.apply(this, arguments)
    };
    r = new Date;
    t = new Date;
    t.setDate(t.getDate() + 30);
    [18, 19, 20, 21, 22, 23].indexOf(r.getHours()) != -1 && (r.setDate(r.getDate() + 1), t.setDate(t.getDate() + 1));
    var i = {},
        f = {
            startDate: r,
            endDate: t
        },
        e = '<div><div class="nav-arrow arrow-left"><i class="fa fa-chevron-left"><\/i><\/div><div class="nav-arrow arrow-right"><i class="fa fa-chevron-right"><\/i><\/div><div class="hz-date-picker-outer"><input class="hz-datepicker-selected-date" type="hidden"/><div class="hz-date-picker-inner"><\/div><\/div><\/div>';
    i.init = function(t) {
        var i = n.extend({}, f, t);
        return this.each(function() {
            var t = n(this),
                p = t.parent(),
                h = t,
                c = n(e).attr("id", t.attr("id")),
                f, a, v;
            t.replaceWith(c);
            t = c;
            t.find("input.hz-datepicker-selected-date").attr("name", n(h).attr("name"));
            var r = i.startDate,
                y = i.endDate,
                s = "",
                l = 0;
            for (r; r <= y; r.setDate(r.getDate() + 1)) f = r.toDateString().split(" "), l++, s += o({
                month: f[1],
                date: f[2],
                day: f[0],
                isoDate: r.toISOString()
            });
            s += '<div style="clear:both;"><\/div>';
            n(".hz-date-picker-inner").css({
                width: l * 69 + 10,
                paddingLeft: 0
            }).append(s);
            a = n(".hz-date-picker-item").eq(0).attr("data-iso-date").split("T")[0];
            u(n('.hz-date-picker-item[data-iso-date^="' + a + '"]'));
            n("body").on("click", ".hz-date-picker-item", function() {
                var i = n(this),
                    f = i.index() + 1,
                    r;
                if (i.hasClass("active")) return !0;
                n(".hz-date-picker-outer").animate({
                    scrollLeft: f * 69 - n(".hz-date-picker-outer").width() / 2 - 35
                }, 200);
                r = u(i);
                t.trigger("hzdp-selected", [r])
            });
            n("body").on("click", ".arrow-left", function() {
                var t = n(".hz-date-picker-outer"),
                    i = t.scrollLeft();
                t.animate({
                    scrollLeft: i - 210
                }, 300)
            });
            n("body").on("click", ".arrow-right", function() {
                var t = n(".hz-date-picker-outer"),
                    i = t.scrollLeft();
                t.animate({
                    scrollLeft: i + 210
                }, 300)
            });
            v = {
                original: h
            };
            t.data("hzDatePicker", v)
        })
    };
    i.getDate = function() {
        var t = n(this);
        return new Date(t.find(".hz-date-picker-item.active").attr("data-iso-date"))
    };
    i.destroy = function() {
        return this.each(function() {
            var t = n(this),
                i = t.data("hzDatePicker"),
                r;
            i && (r = i.original, t.removeData("hzDatePicker").unbind().replaceWith(r))
        })
    }
    
}(jQuery))