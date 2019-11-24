function paginator(config)
{
    if (typeof config != "object") {
        throw "Paginator was expecting a config object!";
    }

    if (typeof config.get_rows != "function" && !(config.table instanceof Element)) {
        throw "Paginator was expecting a table or get_row function!";
    }
        
    if (typeof config.disable == "undefined") {
        config.disable = false;
    }

    var box;
    if (!(config.box instanceof Element)) {
        config.box = document.createElement("div");
    }
    box = config.box;

    if (typeof config.get_rows != "function") {
        config.get_rows = function () {
            var table = config.table
            var tbody = table.getElementsByTagName("tbody")[0]||table;

            children = tbody.children;
            var trs = [];
            for (var i=0; i<children.length; i++) {
                if (children[i].nodeType = "tr") {
                    if (children[i].getElementsByTagName("td").length > 0) {
                        trs.push(children[i]);
                    }
                }
            }

            return trs;
        }
    }

    var get_rows = config.get_rows;
    var trs = get_rows();
    var rows_per_page = 15;

    if (typeof config.page == "undefined") {
        config.page = 1;
    }

    var page = config.page;
    var pages = (rows_per_page > 0)? Math.ceil(trs.length / rows_per_page):1;

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
 
    for (var i=0; i<trs.length; i++) {
        if (typeof trs[i]["data-display"] == "undefined") {
            trs[i]["data-display"] = trs[i].style.display||"";
        }
        if (rows_per_page > 0) {
            if (i < page*rows_per_page && i >= (page-1)*rows_per_page) {
                trs[i].style.display = trs[i]["data-display"];
            } else {
                if (!config.disable) {
                    trs[i].style.display = "none";
                } else {
                    trs[i].style.display = trs[i]["data-display"];
                }
            }
        } else {
            trs[i].style.display = trs[i]["data-display"];
        }
    }

    config.active_class = config.active_class||"active";
    config.box_mode = "button";
    
    var make_button;
    
    make_button = function (symbol, index, config, disabled, active) {
        var button = document.createElement("button");
        button.innerHTML = symbol;
        button.addEventListener("click", function (event) {
            event.preventDefault();
            if (this.disabled != true) {
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
    }

    var page_box = document.createElement(config.box_mode == "list"?"ul":"div");
    
    var left = make_button("back", (page>1?page-1:1), config, (page == 1), false);
    page_box.appendChild(left);
    
    for (var i=1; i<=pages; i++) {
        var li = make_button(i, i, config, false, (page == i));
        li.setAttribute("class", "usual");
        page_box.appendChild(li);
    }
    
    var right = make_button("next", (pages>page?page+1:page), config, (page == pages), false);
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
        if (typeof box["data-display"] == "undefined") {
            box["data-display"] = box.style.display||"";
        }
        box.style.display = "none";
    } else {
        if (box.style.display == "none") {
            box.style.display = box["data-display"]||"";
        }
    }

    if (typeof config.tail_call == "function") {
        config.tail_call(config);
    }

    return box;
}
