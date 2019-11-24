/*global Element typeof document */
'use strict';

function paginator(config) {
    if (typeof config !== "object") {
        throw "Paginator was expecting a config object!";
    }

    if (typeof config.get_rows !== "function" && !(config.table instanceof Element)) {
        throw "Paginator was expecting a table or get_row function!";
    }

    if (config.disable === undefined) {
        config.disable = false;
    }

    var box;
    if (!(config.box instanceof Element)) {
        config.box = document.createElement("div");
    }
    box = config.box;

    if (typeof config.get_rows !== "function") {
        config.get_rows = function () {
            var table = config.table;
            var tbody = table.getElementsByTagName("tbody")[0] || table;

            var children = tbody.children;
            var trs = [];
            children.forEach(function (item, ignore) {
                if (item.nodeType === "tr") {
                    if (item.getElementsByTagName("td").length > 0) {
                        trs.push(item);
                    }
                }
            });
            return trs;
        };
    }

    var get_rows = config.get_rows;
    var trs = get_rows();
    var rows_per_page = 15;

    if (config.page === undefined) {
        config.page = 1;
    }

    var page = config.page;
    var pages = (rows_per_page > 0)
        ? Math.ceil(trs.length / rows_per_page)
        : 1;

    if (pages < 1) {
        pages = 1;
    }
    if (page > pages) {
        page = pages;
    }
    if (page < 1) {
        page = 1;
    }
    config.page = page;

    trs.forEach(function (item, index) {
        if (item["data-display"] === undefined) {
            item["data-display"] = item.style.display || "";
        }
        if (rows_per_page > 0) {
            if (index < page * rows_per_page && index >= (page - 1) * rows_per_page) {
                item.style.display = item["data-display"];
            } else {
                if (!config.disable) {
                    item.style.display = "none";
                } else {
                    item.style.display = item["data-display"];
                }
            }
        } else {
            item.style.display = item["data-display"];
        }
    });

    config.active_class = config.active_class || "active";
    config.box_mode = "button";

    var make_button;
    make_button = function (symbol, index, config, disabled, active) {
        var button = document.createElement("button");
        button.innerHTML = symbol;
        button.addEventListener("click", function (event) {
            event.preventDefault();
            if (button.disabled !== true) {
                config.page = index;
                paginator(config);
            }
            return false;
        }, false);
        if (disabled) {
            button.disabled = true;
        }
        if (active) {
            button.className = config.active_class;
        }
        return button;
    };

    var page_box;
    page_box = document.createElement(config.box_mode === "list"
        ? "ul"
        : "div");

    var left;
    left = make_button("back", (page > 1
        ? page - 1
        : 1), config, (page === 1), false);
    page_box.appendChild(left);

    pages.forEach(function (ignore, index) {
        var li = make_button(index, index, config, false, (page === index));
        li.setAttribute("class", "usual");
        page_box.appendChild(li);
    });

    var right = make_button("next", (pages > page
        ? page + 1
        : page), config, (page === pages), false);
    page_box.appendChild(right);

    if (box.childNodes.length) {
        while (box.childNodes.length > 1) {
            box.removeChild(box.childNodes[0]);
        }
        box.replaceChild(page_box, box.childNodes[0]);
    } else {
        box.appendChild(page_box);
    }

    if (config.disable) {
        if (box["data-display"] === undefined) {
            box["data-display"] = box.style.display || "";
        }
        box.style.display = "none";
    } else {
        if (box.style.display === "none") {
            box.style.display = box["data-display"] || "";
        }
    }

    if (typeof config.tail_call === "function") {
        config.tail_call(config);
    }

    return box;
}
