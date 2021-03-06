/*!
 * jQuery QueryBuilder 2.4.1
 * Copyright 2014-2017 Damien "Mistic" Sorel (http://www.strangeplanet.fr)
 * Licensed under MIT (http://opensource.org/licenses/MIT)
 */
! function(a, b) {
    "function" == typeof define && define.amd ? define("jQuery.extendext", ["jquery"], b) : "object" == typeof module && module.exports ? module.exports = b(require("jquery")) : b(a.jQuery)
}(this, function($) {
    "use strict";
    $.extendext = function() {
        var a, b, c, d, e, f, g = arguments[0] || {},
            h = 1,
            i = arguments.length,
            j = !1,
            k = "default";
        for ("boolean" == typeof g && (j = g, g = arguments[h++] || {}), "string" == typeof g && (k = g.toLowerCase(), "concat" !== k && "replace" !== k && "extend" !== k && (k = "default"), g = arguments[h++] || {}), "object" == typeof g || $.isFunction(g) || (g = {}), h === i && (g = this, h--); h < i; h++)
            if (null !== (a = arguments[h]))
                if ($.isArray(a) && "default" !== k) switch (f = g && $.isArray(g) ? g : [], k) {
                    case "concat":
                        g = f.concat($.extend(j, [], a));
                        break;
                    case "replace":
                        g = $.extend(j, [], a);
                        break;
                    case "extend":
                        a.forEach(function(a, b) {
                            if ("object" == typeof a) {
                                var c = $.isArray(a) ? [] : {};
                                f[b] = $.extendext(j, k, f[b] || c, a)
                            } else f.indexOf(a) === -1 && f.push(a)
                        }), g = f
                } else
                    for (b in a) c = g[b], d = a[b], g !== d && (j && d && ($.isPlainObject(d) || (e = $.isArray(d))) ? (e ? (e = !1, f = c && $.isArray(c) ? c : []) : f = c && $.isPlainObject(c) ? c : {}, g[b] = $.extendext(j, k, f, d)) : void 0 !== d && (g[b] = d));
        return g
    }
}),
function() {
    "use strict";

    function a(b, c, d) {
        return ("string" == typeof c ? c : c.toString()).replace(b.define || f, function(a, c, e, f) {
            return 0 === c.indexOf("def.") && (c = c.substring(4)), c in d || (":" === e ? (b.defineParams && f.replace(b.defineParams, function(a, b, e) {
                d[c] = {
                    arg: b,
                    text: e
                }
            }), c in d || (d[c] = f)) : new Function("def", "def['" + c + "']=" + f)(d)), ""
        }).replace(b.use || f, function(c, e) {
            b.useParams && (e = e.replace(b.useParams, function(a, b, c, e) {
                if (d[c] && d[c].arg && e) {
                    var f = (c + ":" + e).replace(/'|\\/g, "_");
                    return d.__exp = d.__exp || {}, d.__exp[f] = d[c].text.replace(new RegExp("(^|[^\\w$])" + d[c].arg + "([^\\w$])", "g"), "$1" + e + "$2"), b + "def.__exp['" + f + "']"
                }
            }));
            var f = new Function("def", "return " + e)(d);
            return f ? a(b, f, d) : f
        })
    }

    function b(a) {
        return a.replace(/\\('|\\)/g, "$1").replace(/[\r\t\n]/g, " ")
    }
    var c, d = {
        version: "1.0.3",
        templateSettings: {
            evaluate: /\{\{([\s\S]+?(\}?)+)\}\}/g,
            interpolate: /\{\{=([\s\S]+?)\}\}/g,
            encode: /\{\{!([\s\S]+?)\}\}/g,
            use: /\{\{#([\s\S]+?)\}\}/g,
            useParams: /(^|[^\w$])def(?:\.|\[[\'\"])([\w$\.]+)(?:[\'\"]\])?\s*\:\s*([\w$\.]+|\"[^\"]+\"|\'[^\']+\'|\{[^\}]+\})/g,
            define: /\{\{##\s*([\w\.$]+)\s*(\:|=)([\s\S]+?)#\}\}/g,
            defineParams: /^\s*([\w$]+):([\s\S]+)/,
            conditional: /\{\{\?(\?)?\s*([\s\S]*?)\s*\}\}/g,
            iterate: /\{\{~\s*(?:\}\}|([\s\S]+?)\s*\:\s*([\w$]+)\s*(?:\:\s*([\w$]+))?\s*\}\})/g,
            varname: "it",
            strip: !0,
            append: !0,
            selfcontained: !1,
            doNotSkipEncoded: !1
        },
        template: void 0,
        compile: void 0,
        log: !0
    };
    d.encodeHTMLSource = function(a) {
        var b = {
                "&": "&#38;",
                "<": "&#60;",
                ">": "&#62;",
                '"': "&#34;",
                "'": "&#39;",
                "/": "&#47;"
            },
            c = a ? /[&<>"'\/]/g : /&(?!#?\w+;)|<|>|"|'|\//g;
        return function(a) {
            return a ? a.toString().replace(c, function(a) {
                return b[a] || a
            }) : ""
        }
    }, c = function() {
        return this || (0, eval)("this")
    }(), "undefined" != typeof module && module.exports ? module.exports = d : "function" == typeof define && define.amd ? define("doT", function() {
        return d
    }) : c.doT = d;
    var e = {
            append: {
                start: "'+(",
                end: ")+'",
                startencode: "'+encodeHTML("
            },
            split: {
                start: "';out+=(",
                end: ");out+='",
                startencode: "';out+=encodeHTML("
            }
        },
        f = /$^/;
    d.template = function(g, h, i) {
        h = h || d.templateSettings;
        var j, k, l = h.append ? e.append : e.split,
            m = 0,
            n = h.use || h.define ? a(h, g, i || {}) : g;
        n = ("var out='" + (h.strip ? n.replace(/(^|\r|\n)\t* +| +\t*(\r|\n|$)/g, " ").replace(/\r|\n|\t|\/\*[\s\S]*?\*\//g, "") : n).replace(/'|\\/g, "\\$&").replace(h.interpolate || f, function(a, c) {
            return l.start + b(c) + l.end
        }).replace(h.encode || f, function(a, c) {
            return j = !0, l.startencode + b(c) + l.end
        }).replace(h.conditional || f, function(a, c, d) {
            return c ? d ? "';}else if(" + b(d) + "){out+='" : "';}else{out+='" : d ? "';if(" + b(d) + "){out+='" : "';}out+='"
        }).replace(h.iterate || f, function(a, c, d, e) {
            return c ? (m += 1, k = e || "i" + m, c = b(c), "';var arr" + m + "=" + c + ";if(arr" + m + "){var " + d + "," + k + "=-1,l" + m + "=arr" + m + ".length-1;while(" + k + "<l" + m + "){" + d + "=arr" + m + "[" + k + "+=1];out+='") : "';} } out+='"
        }).replace(h.evaluate || f, function(a, c) {
            return "';" + b(c) + "out+='"
        }) + "';return out;").replace(/\n/g, "\\n").replace(/\t/g, "\\t").replace(/\r/g, "\\r").replace(/(\s|;|\}|^|\{)out\+='';/g, "$1").replace(/\+''/g, ""), j && (h.selfcontained || !c || c._encodeHTML || (c._encodeHTML = d.encodeHTMLSource(h.doNotSkipEncoded)), n = "var encodeHTML = typeof _encodeHTML !== 'undefined' ? _encodeHTML : (" + d.encodeHTMLSource.toString() + "(" + (h.doNotSkipEncoded || "") + "));" + n);
        try {
            return new Function(h.varname, n)
        } catch (o) {
            throw "undefined" != typeof console && console.log("Could not create a template function: " + n), o
        }
    }, d.compile = function(a, b) {
        return d.template(a, null, b)
    }
}(),
function(a, b) {
    "function" == typeof define && define.amd ? define("query-builder", ["jquery", "doT", "jQuery.extendext"], b) : b(a.jQuery, a.doT)
}(this, function($, a) {
    "use strict";

    function b(a) {
        return this instanceof b ? (this.root = null, void(this.$ = $(this))) : b.getModel(a)
    }

    function c(a, b) {
        if (null !== a && "object" == typeof a) {
            var c = Object.keys(a);
            return 1 === c.length ? c[0] : void 0 !== a.$gte && void 0 !== a.$lte ? "between" : void 0 !== a.$lt && void 0 !== a.$gt ? "not_between" : void 0 !== a.$regex ? "$regex" : void 0
        }
        return "eq"
    }

    function d(a) {
        for (var b = Object.keys(a), c = 0, d = b.length; c < d; c++)
            if ("$or" == b[c].toLowerCase() || "$and" == b[c].toLowerCase()) return b[c]
    }

    function e(a, c, d) {
        var e, f;
        e = c.closest(h.rule_container), e.length && (f = "moveAfter"), f || (e = c.closest(h.group_header), e.length && (e = c.closest(h.group_container), f = "moveAtBegin")), f || (e = c.closest(h.group_container), e.length && (f = "moveAtEnd")), f && (a[f](b(e)), d && a instanceof k && d.setRuleInputValue(a, a.value))
    }

    function f(a) {
        var b = a.match(/(question_mark|numbered|named)(?:\((.)\))?/);
        return b || (b = [null, "question_mark", void 0]), b
    }
    var g = function(a, b) {
        this.init(a, b)
    };
    $.extend(g.prototype, {
        change: function(a, b) {
            var c = new $.Event(this.tojQueryEvent(a, !0), {
                builder: this,
                value: b
            });
            return this.$el.triggerHandler(c, Array.prototype.slice.call(arguments, 2)), c.value
        },
        trigger: function(a) {
            var b = new $.Event(this.tojQueryEvent(a), {
                builder: this
            });
            return this.$el.triggerHandler(b, Array.prototype.slice.call(arguments, 1)), b
        },
        on: function(a, b) {
            return this.$el.on(this.tojQueryEvent(a), b), this
        },
        off: function(a, b) {
            return this.$el.off(this.tojQueryEvent(a), b), this
        },
        once: function(a, b) {
            return this.$el.one(this.tojQueryEvent(a), b), this
        },
        tojQueryEvent: function(a, b) {
            return a.split(" ").map(function(a) {
                return a + ".queryBuilder" + (b ? ".filter" : "")
            }).join(" ")
        }
    }), g.plugins = {}, g.defaults = function(a) {
        return "object" != typeof a ? "string" == typeof a ? "object" == typeof g.DEFAULTS[a] ? $.extend(!0, {}, g.DEFAULTS[a]) : g.DEFAULTS[a] : $.extend(!0, {}, g.DEFAULTS) : void $.extendext(!0, "replace", g.DEFAULTS, a)
    }, g.define = function(a, b, c) {
        g.plugins[a] = {
            fct: b,
            def: c || {}
        }
    }, g.extend = function(a) {
        $.extend(g.prototype, a)
    }, g.prototype.initPlugins = function() {
        if (this.plugins) {
            if ($.isArray(this.plugins)) {
                var a = {};
                this.plugins.forEach(function(b) {
                    a[b] = null
                }), this.plugins = a
            }
            Object.keys(this.plugins).forEach(function(a) {
                a in g.plugins ? (this.plugins[a] = $.extend(!0, {}, g.plugins[a].def, this.plugins[a] || {}), g.plugins[a].fct.call(this, this.plugins[a])) : l.error("Config", 'Unable to find plugin "{0}"', a)
            }, this)
        }
    }, g.types = {
        string: "string",
        integer: "number",
        "double": "number",
        date: "datetime",
        time: "datetime",
        datetime: "datetime",
        "boolean": "boolean"
    }, g.inputs = ["text", "textarea", "radio", "checkbox", "select"], g.modifiable_options = ["display_errors", "allow_groups", "allow_empty", "default_condition", "default_filter"];
    var h = g.selectors = {
        group_container: ".rules-group-container",
        rule_container: ".rule-container",
        filter_container: ".rule-filter-container",
        operator_container: ".rule-operator-container",
        value_container: ".rule-value-container",
        error_container: ".error-container",
        condition_container: ".rules-group-header .group-conditions",
        rule_header: ".rule-header",
        group_header: ".rules-group-header",
        group_actions: ".group-actions",
        rule_actions: ".rule-actions",
        rules_list: ".rules-group-body>.rules-list",
        group_condition: ".rules-group-header [name$=_cond]",
        rule_filter: ".rule-filter-container [name$=_filter]",
        rule_operator: ".rule-operator-container [name$=_operator]",
        rule_value: ".rule-value-container [name*=_value_]",
        add_rule: "[data-add=rule]",
        delete_rule: "[data-delete=rule]",
        add_group: "[data-add=group]",
        delete_group: "[data-delete=group]"
    };
    g.templates = {}, g.regional = {}, g.OPERATORS = {
        equal: {
            type: "equal",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["string", "number", "datetime", "boolean"]
        },
        not_equal: {
            type: "not_equal",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["string", "number", "datetime", "boolean"]
        },
        "in": {
            type: "in",
            nb_inputs: 1,
            multiple: !0,
            apply_to: ["string", "number", "datetime"]
        },
        not_in: {
            type: "not_in",
            nb_inputs: 1,
            multiple: !0,
            apply_to: ["string", "number", "datetime"]
        },
        less: {
            type: "less",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["number", "datetime"]
        },
        less_or_equal: {
            type: "less_or_equal",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["number", "datetime"]
        },
        greater: {
            type: "greater",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["number", "datetime"]
        },
        greater_or_equal: {
            type: "greater_or_equal",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["number", "datetime"]
        },
        between: {
            type: "between",
            nb_inputs: 2,
            multiple: !1,
            apply_to: ["number", "datetime"]
        },
        not_between: {
            type: "not_between",
            nb_inputs: 2,
            multiple: !1,
            apply_to: ["number", "datetime"]
        },
        begins_with: {
            type: "begins_with",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["string"]
        },
        not_begins_with: {
            type: "not_begins_with",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["string"]
        },
        contains: {
            type: "contains",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["string"]
        },
        not_contains: {
            type: "not_contains",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["string"]
        },
        ends_with: {
            type: "ends_with",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["string"]
        },
        not_ends_with: {
            type: "not_ends_with",
            nb_inputs: 1,
            multiple: !1,
            apply_to: ["string"]
        },
        is_empty: {
            type: "is_empty",
            nb_inputs: 0,
            multiple: !1,
            apply_to: ["string"]
        },
        is_not_empty: {
            type: "is_not_empty",
            nb_inputs: 0,
            multiple: !1,
            apply_to: ["string"]
        },
        is_null: {
            type: "is_null",
            nb_inputs: 0,
            multiple: !1,
            apply_to: ["string", "number", "datetime", "boolean"]
        },
        is_not_null: {
            type: "is_not_null",
            nb_inputs: 0,
            multiple: !1,
            apply_to: ["string", "number", "datetime", "boolean"]
        }
    }, g.DEFAULTS = {
        filters: [],
        plugins: [],
        sort_filters: !1,
        display_errors: !0,
        allow_groups: -1,
        allow_empty: !1,
        conditions: ["AND"],
        default_condition: "AND",
        inputs_separator: " , ",
        select_placeholder: "--Select Filter--",
        display_empty_filter: !0,
        default_filter: null,
        optgroups: {},
        default_rule_flags: {
            filter_readonly: !1,
            operator_readonly: !1,
            value_readonly: !1,
            no_delete: !1
        },
        default_group_flags: {
            condition_readonly: !1,
            no_add_rule: !1,
            no_add_group: true,
            no_delete: !1
        },
        templates: {
            group: null,
            rule: null,
            filterSelect: null,
            operatorSelect: null
        },
        lang_code: "en",
        lang: {},
        operators: ["equal", "not_equal", "in", "not_in", "less", "less_or_equal", "greater", "greater_or_equal", "between", "not_between", "begins_with", "not_begins_with", "contains", "not_contains", "ends_with", "not_ends_with", "is_empty", "is_not_empty", "is_null", "is_not_null"],
        icons: {
            add_group: "glyphicon glyphicon-plus-sign",
            add_rule: "glyphicon glyphicon-plus",
            remove_group: "glyphicon glyphicon-remove",
            remove_rule: "glyphicon glyphicon-remove",
            error: "glyphicon glyphicon-warning-sign"
        }
    }, g.prototype.init = function(c, d) {
        c[0].queryBuilder = this, this.$el = c, this.settings = $.extendext(!0, "replace", {}, g.DEFAULTS, d), this.model = new b, this.status = {
            group_id: 0,
            rule_id: 0,
            generated_id: !1,
            has_optgroup: !1,
            has_operator_oprgroup: !1,
            id: null
        }, this.settings.allow_groups === !1 ? this.settings.allow_groups = 0 : this.settings.allow_groups === !0 && (this.settings.allow_groups = -1), this.filters = this.settings.filters, this.icons = this.settings.icons, this.operators = this.settings.operators, this.templates = this.settings.templates, this.plugins = this.settings.plugins, void 0 === g.regional.en && l.error("Config", '"i18n/en.js" not loaded.'), this.lang = $.extendext(!0, "replace", {}, g.regional.en, g.regional[this.settings.lang_code], this.settings.lang), Object.keys(this.templates).forEach(function(b) {
            this.templates[b] || (this.templates[b] = g.templates[b]), "string" == typeof this.templates[b] && (this.templates[b] = a.template(this.templates[b]))
        }, this), this.$el.attr("id") || (this.$el.attr("id", "qb_" + Math.floor(99999 * Math.random())), this.status.generated_id = !0), this.status.id = this.$el.attr("id"), this.$el.addClass("query-builder form-inline"), this.filters = this.checkFilters(this.filters), this.operators = this.checkOperators(this.operators), this.bindEvents(), this.initPlugins(), this.trigger("afterInit"), d.rules ? (this.setRules(d.rules), delete this.settings.rules) : this.setRoot(!0)
    }, g.prototype.checkFilters = function(a) {
        var b = [];
        if (a && 0 !== a.length || l.error("Config", "Missing filters list"), a.forEach(function(a, c) {
                switch (a.id || l.error("Config", "Missing filter {0} id", c), b.indexOf(a.id) != -1 && l.error("Config", 'Filter "{0}" already defined', a.id), b.push(a.id), a.type ? g.types[a.type] || l.error("Config", 'Invalid type "{0}"', a.type) : a.type = "string", a.input ? "function" != typeof a.input && g.inputs.indexOf(a.input) == -1 && l.error("Config", 'Invalid input "{0}"', a.input) : a.input = "text", a.operators && a.operators.forEach(function(a) {
                    "string" != typeof a && l.error("Config", "Filter operators must be global operators types (string)")
                }), a.field || (a.field = a.id), a.label || (a.label = a.field), a.optgroup ? (this.status.has_optgroup = !0, this.settings.optgroups[a.optgroup] || (this.settings.optgroups[a.optgroup] = a.optgroup)) : a.optgroup = null, a.input) {
                    case "radio":
                    case "checkbox":
                        (!a.values || a.values.length < 1) && l.error("Config", 'Missing filter "{0}" values', a.id);
                        break;
                    case "select":
                        a.placeholder && (void 0 === a.placeholder_value && (a.placeholder_value = -1), l.iterateOptions(a.values, function(b) {
                            b == a.placeholder_value && l.error("Config", 'Placeholder of filter "{0}" overlaps with one of its values', a.id)
                        }))
                }
            }, this), this.settings.sort_filters)
            if ("function" == typeof this.settings.sort_filters) a.sort(this.settings.sort_filters);
            else {
                var c = this;
                a.sort(function(a, b) {
                    return c.translateLabel(a.label).localeCompare(c.translateLabel(b.label))
                })
            }
        return this.status.has_optgroup && (a = l.groupSort(a, "optgroup")), a
    }, g.prototype.checkOperators = function(a) {
        var b = [];
        return a.forEach(function(c, d) {
            "string" == typeof c ? (g.OPERATORS[c] || l.error("Config", 'Unknown operator "{0}"', c), a[d] = c = $.extendext(!0, "replace", {}, g.OPERATORS[c])) : (c.type || l.error("Config", 'Missing "type" for operator {0}', d), g.OPERATORS[c.type] && (a[d] = c = $.extendext(!0, "replace", {}, g.OPERATORS[c.type], c)), void 0 !== c.nb_inputs && void 0 !== c.apply_to || l.error("Config", 'Missing "nb_inputs" and/or "apply_to" for operator "{0}"', c.type)), b.indexOf(c.type) != -1 && l.error("Config", 'Operator "{0}" already defined', c.type), b.push(c.type), c.optgroup ? (this.status.has_operator_optgroup = !0, this.settings.optgroups[c.optgroup] || (this.settings.optgroups[c.optgroup] = c.optgroup)) : c.optgroup = null
        }, this), this.status.has_operator_optgroup && (a = l.groupSort(a, "optgroup")), a
    }, g.prototype.bindEvents = function() {
        var a = this;
        this.$el.on("change.queryBuilder", h.group_condition, function() {
            if ($(this).is(":checked")) {
                var a = $(this).closest(h.group_container);
                b(a).condition = $(this).val()
            }
        }), this.$el.on("change.queryBuilder", h.rule_filter, function() {
            var c = $(this).closest(h.rule_container);
            b(c).filter = a.getFilterById($(this).val())
        }), this.$el.on("change.queryBuilder", h.rule_operator, function() {
            var c = $(this).closest(h.rule_container);
            b(c).operator = a.getOperatorByType($(this).val())
        }), this.$el.on("click.queryBuilder", h.add_rule, function() {
            var c = $(this).closest(h.group_container);
            a.addRule(b(c))
        }), this.$el.on("click.queryBuilder", h.delete_rule, function() {
            var c = $(this).closest(h.rule_container);
            a.deleteRule(b(c))
        }), 0 !== this.settings.allow_groups && (this.$el.on("click.queryBuilder", h.add_group, function() {
            var c = $(this).closest(h.group_container);
            a.addGroup(b(c))
        }), this.$el.on("click.queryBuilder", h.delete_group, function() {
            var c = $(this).closest(h.group_container);
            a.deleteGroup(b(c))
        })), this.model.on({
            drop: function(b, c) {
                c.$el.remove(), a.refreshGroupsConditions()
            },
            add: function(b, c, d) {
                0 === d ? c.$el.prependTo(c.parent.$el.find(">" + h.rules_list)) : c.$el.insertAfter(c.parent.rules[d - 1].$el), a.refreshGroupsConditions()
            },
            move: function(b, c, d, e) {
                c.$el.detach(), 0 === e ? c.$el.prependTo(d.$el.find(">" + h.rules_list)) : c.$el.insertAfter(d.rules[e - 1].$el), a.refreshGroupsConditions()
            },
            update: function(b, c, d, e, f) {
                if (c instanceof k) switch (d) {
                    case "error":
                        a.displayError(c);
                        break;
                    case "flags":
                        a.applyRuleFlags(c);
                        break;
                    case "filter":
                        a.updateRuleFilter(c, f);
                        break;
                    case "operator":
                        a.updateRuleOperator(c, f);
                        break;
                    case "value":
                        a.updateRuleValue(c)
                } else switch (d) {
                    case "error":
                        a.displayError(c);
                        break;
                    case "flags":
                        a.applyGroupFlags(c);
                        break;
                    case "condition":
                        a.updateGroupCondition(c)
                }
            }
        })
    }, g.prototype.setRoot = function(a, b, c) {
        a = void 0 === a || a === !0;
        var d = this.nextGroupId(),
            e = $(this.getGroupTemplate(d, 1));
        return this.$el.append(e), this.model.root = new j(null, e), this.model.root.model = this.model, this.model.root.data = b, this.model.root.__.flags = $.extend({}, this.settings.default_group_flags, c), this.trigger("afterAddGroup", this.model.root), this.model.root.condition = this.settings.default_condition, a && this.addRule(this.model.root), this.model.root
    }, g.prototype.addGroup = function(a, b, c, d) {
        b = void 0 === b || b === !0;
        var e = a.level + 1,
            f = this.trigger("beforeAddGroup", a, b, e);
        if (f.isDefaultPrevented()) return null;
        var g = this.nextGroupId(),
            h = $(this.getGroupTemplate(g, e)),
            i = a.addGroup(h);
        return i.data = c, i.__.flags = $.extend({}, this.settings.default_group_flags, d), this.trigger("afterAddGroup", i), i.condition = this.settings.default_condition, b && this.addRule(i), i
    }, g.prototype.deleteGroup = function(a) {
        if (a.isRoot()) return !1;
        var b = this.trigger("beforeDeleteGroup", a);
        if (b.isDefaultPrevented()) return !1;
        var c = !0;
        return a.each("reverse", function(a) {
            c &= this.deleteRule(a)
        }, function(a) {
            c &= this.deleteGroup(a)
        }, this), c && (a.drop(), this.trigger("afterDeleteGroup")), c
    }, g.prototype.updateGroupCondition = function(a) {
        a.$el.find(">" + h.group_condition).each(function() {
            var b = $(this);
            b.prop("checked", b.val() === a.condition), b.parent().toggleClass("active", b.val() === a.condition)
        }), this.trigger("afterUpdateGroupCondition", a)
    }, g.prototype.refreshGroupsConditions = function() {
        ! function a(b) {
            (!b.flags || b.flags && !b.flags.condition_readonly) && b.$el.find(">" + h.group_condition).prop("disabled", b.rules.length <= 1).parent().toggleClass("disabled", b.rules.length <= 1), b.each(function(a) {}, function(b) {
                a(b)
            }, this)
        }(this.model.root)
    }, g.prototype.addRule = function(a, b, c) {
        var d = this.trigger("beforeAddRule", a);
        if (d.isDefaultPrevented()) return null;
        var e = this.nextRuleId(),
            f = $(this.getRuleTemplate(e)),
            g = a.addRule(f);
        return void 0 !== b && (g.data = b), g.__.flags = $.extend({}, this.settings.default_rule_flags, c), this.trigger("afterAddRule", g), this.createRuleFilters(g), !this.settings.default_filter && this.settings.display_empty_filter || (g.filter = this.change("getDefaultFilter", this.getFilterById(this.settings.default_filter || this.filters[0].id), g)), g
    }, g.prototype.deleteRule = function(a) {
        if (a.flags.no_delete) return !1;
        var b = this.trigger("beforeDeleteRule", a);
        return !b.isDefaultPrevented() && (a.drop(), this.trigger("afterDeleteRule"), !0)
    }, g.prototype.createRuleFilters = function(a) {
        var b = this.change("getRuleFilters", this.filters, a),
            c = $(this.getRuleFilterSelect(a, b));
        a.$el.find(h.filter_container).html(c), this.trigger("afterCreateRuleFilters", a)
    }, g.prototype.createRuleOperators = function(a) {
        var b = a.$el.find(h.operator_container).empty();
        if (a.filter) {
            var c = this.getOperators(a.filter),
                d = $(this.getRuleOperatorSelect(a, c));
            b.html(d), a.__.operator = c[0], this.trigger("afterCreateRuleOperators", a, c)
        }
    }, g.prototype.createRuleInput = function(a) {
        var b = a.$el.find(h.value_container).empty();
        if (a.__.value = void 0, a.filter && a.operator && 0 !== a.operator.nb_inputs) {
            for (var c = this, d = $(), e = a.filter, f = 0; f < a.operator.nb_inputs; f++) {
                var g = $(this.getRuleInput(a, f));
                f > 0 && b.append(this.settings.inputs_separator), b.append(g), d = d.add(g)
            }
            b.show(), d.on("change " + (e.input_event || ""), function() {
                this._updating_input || (a._updating_value = !0, a.value = c.getRuleInputValue(a), a._updating_value = !1)
            }), e.plugin && d[e.plugin](e.plugin_config || {}), this.trigger("afterCreateRuleInput", a), void 0 !== e.default_value ? a.value = e.default_value : (a._updating_value = !0, a.value = c.getRuleInputValue(a), a._updating_value = !1)
        }
    }, g.prototype.updateRuleFilter = function(a, b) {
        this.createRuleOperators(a), this.createRuleInput(a), a.$el.find(h.rule_filter).val(a.filter ? a.filter.id : "-1"), b && a.filter && b.id !== a.filter.id && (a.data = void 0), this.trigger("afterUpdateRuleFilter", a)
    }, g.prototype.updateRuleOperator = function(a, b) {
        var c = a.$el.find(h.value_container);
        a.operator && 0 !== a.operator.nb_inputs ? (c.show(), !c.is(":empty") && b && a.operator.nb_inputs === b.nb_inputs || this.createRuleInput(a)) : (c.hide(), a.__.value = void 0), a.operator && a.$el.find(h.rule_operator).val(a.operator.type), this.trigger("afterUpdateRuleOperator", a), this.updateRuleValue(a)
    }, g.prototype.updateRuleValue = function(a) {
        a._updating_value || this.setRuleInputValue(a, a.value), this.trigger("afterUpdateRuleValue", a)
    }, g.prototype.applyRuleFlags = function(a) {
        var b = a.flags;
        b.filter_readonly && a.$el.find(h.rule_filter).prop("disabled", !0), b.operator_readonly && a.$el.find(h.rule_operator).prop("disabled", !0), b.value_readonly && a.$el.find(h.rule_value).prop("disabled", !0), b.no_delete && a.$el.find(h.delete_rule).remove(), this.trigger("afterApplyRuleFlags", a)
    }, g.prototype.applyGroupFlags = function(a) {
        var b = a.flags;
        b.condition_readonly && a.$el.find(">" + h.group_condition).prop("disabled", !0).parent().addClass("readonly"), b.no_add_rule && a.$el.find(h.add_rule).remove(), b.no_add_group && a.$el.find(h.add_group).remove(), b.no_delete && a.$el.find(h.delete_group).remove(), this.trigger("afterApplyGroupFlags", a)
    }, g.prototype.clearErrors = function(a) {
        a = a || this.model.root, a && (a.error = null, a instanceof j && a.each(function(a) {
            a.error = null
        }, function(a) {
            this.clearErrors(a)
        }, this))
    }, g.prototype.displayError = function(a) {
        if (this.settings.display_errors)
            if (null === a.error) a.$el.removeClass("has-error");
            else {
                var b = this.lang.errors[a.error[0]] || a.error[0];
                b = l.fmt(b, a.error.slice(1)), b = this.change("displayError", b, a.error, a), a.$el.addClass("has-error").find(h.error_container).eq(0).attr("title", b)
            }
    }, g.prototype.triggerValidationError = function(a, b, c) {
        $.isArray(b) || (b = [b]);
        var d = this.trigger("validationError", a, b, c);
        d.isDefaultPrevented() || (a.error = b)
    }, g.prototype.destroy = function() {
        this.trigger("beforeDestroy"), this.status.generated_id && this.$el.removeAttr("id"), this.clear(), this.model = null, this.$el.off(".queryBuilder").removeClass("query-builder").removeData("queryBuilder"), delete this.$el[0].queryBuilder
    }, g.prototype.reset = function() {
        this.status.group_id = 1, this.status.rule_id = 0, this.model.root.empty(), this.addRule(this.model.root), this.trigger("afterReset")
    }, g.prototype.clear = function() {
        this.status.group_id = 0, this.status.rule_id = 0, this.model.root && (this.model.root.drop(), this.model.root = null), this.trigger("afterClear")
    }, g.prototype.setOptions = function(a) {
        $.each(a, function(a, b) {
            g.modifiable_options.indexOf(a) !== -1 && (this.settings[a] = b)
        }.bind(this))
    }, g.prototype.getModel = function(a) {
        return a ? b(a) : this.model.root
    }, g.prototype.validate = function() {
        this.clearErrors();
        var a = this,
            b = function c(b) {
                var d = 0,
                    e = 0;
                return b.each(function(b) {
                    if (!b.filter) return a.triggerValidationError(b, "no_filter", null), void e++;
                    if (!b.operator) return a.triggerValidationError(b, "no_operator", null), void e++;
                    if (0 !== b.operator.nb_inputs) {
                        var c = a.validateValue(b, b.value);
                        if (c !== !0) return a.triggerValidationError(b, c, b.value), void e++
                    }
                    d++
                }, function(a) {
                    c(a) ? d++ : e++
                }), !(e > 0) && (!!(0 !== d || a.settings.allow_empty && b.isRoot()) || (a.triggerValidationError(b, "empty_group", null), !1))
            }(this.model.root);
        return this.change("validate", b)
    }, g.prototype.getRules = function(a) {
        a = $.extend({
            get_flags: !1,
            allow_invalid: !1
        }, a);
        var b = this.validate();
        if (!b && !a.allow_invalid) return null;
        var c = this,
            d = function e(b) {
                var d = {
                    condition: b.condition,
                    rules: []
                };
                if (b.data && (d.data = $.extendext(!0, "replace", {}, b.data)), a.get_flags) {
                    var f = c.getGroupFlags(b.flags, "all" === a.get_flags);
                    $.isEmptyObject(f) || (d.flags = f)
                }
                return b.each(function(b) {
                    var e = null;
                    b.operator && 0 === b.operator.nb_inputs || (e = b.value);
                    var f = {
                        id: b.filter ? b.filter.id : null,
                        field: b.filter ? b.filter.field : null,
                        type: b.filter ? b.filter.type : null,
                        input: b.filter ? b.filter.input : null,
                        operator: b.operator ? b.operator.type : null,
                        value: e
                    };
                    if ((b.filter && b.filter.data || b.data) && (f.data = $.extendext(!0, "replace", {}, b.filter.data, b.data)), a.get_flags) {
                        var g = c.getRuleFlags(b.flags, "all" === a.get_flags);
                        $.isEmptyObject(g) || (f.flags = g)
                    }
                    d.rules.push(c.change("ruleToJson", f, b))
                }, function(a) {
                    d.rules.push(e(a))
                }, this), c.change("groupToJson", d, b)
            }(this.model.root);
        return d.valid = b, this.change("getRules", d)
    }, g.prototype.setRules = function(a, b) {
        b = $.extend({
            allow_invalid: !1
        }, b), $.isArray(a) && (a = {
            condition: this.settings.default_condition,
            rules: a
        }), a && a.rules && (0 !== a.rules.length || this.settings.allow_empty) || l.error("RulesParse", "Incorrect data object passed"), this.clear(), this.setRoot(!1, a.data, this.parseGroupFlags(a)), this.applyGroupFlags(this.model.root), a = this.change("setRules", a);
        var c = this;
        ! function d(a, e) {
            null !== e && (void 0 === a.condition ? a.condition = c.settings.default_condition : c.settings.conditions.indexOf(a.condition) == -1 && (l.error(!b.allow_invalid, "UndefinedCondition", 'Invalid condition "{0}"', a.condition), a.condition = c.settings.default_condition), e.condition = a.condition, a.rules.forEach(function(a) {
                var f;
                if (void 0 !== a.rules)
                    if (c.settings.allow_groups !== -1 && c.settings.allow_groups < e.level) l.error(!b.allow_invalid, "RulesParse", "No more than {0} groups are allowed", c.settings.allow_groups), c.reset();
                    else {
                        if (f = c.addGroup(e, !1, a.data, c.parseGroupFlags(a)), null === f) return;
                        c.applyGroupFlags(f), d(a, f)
                    }
                else {
                    if (a.empty || (void 0 === a.id && (l.error(!b.allow_invalid, "RulesParse", "Missing rule field id"), a.empty = !0), void 0 === a.operator && (a.operator = "equal")), f = c.addRule(e, a.data, c.parseRuleFlags(a)), null === f) return;
                    a.empty || (f.filter = c.getFilterById(a.id, !b.allow_invalid), f.filter && (f.operator = c.getOperatorByType(a.operator, !b.allow_invalid), f.operator || (f.operator = c.getOperators(f.filter)[0]), f.operator && 0 !== f.operator.nb_inputs && void 0 !== a.value && (f.value = a.value))), c.applyRuleFlags(f), c.change("jsonToRule", f, a) != f && l.error("RulesParse", "Plugin tried to change rule reference")
                }
            }), c.change("jsonToGroup", e, a) != e && l.error("RulesParse", "Plugin tried to change group reference"))
        }(a, this.model.root)
    }, g.prototype.validateValue = function(a, b) {
        var c = a.filter.validation || {},
            d = !0;
        return d = c.callback ? c.callback.call(this, b, a) : this.validateValueInternal(a, b), this.change("validateValue", d, b, a)
    }, g.prototype.validateValueInternal = function(a, b) {
        var c, d = a.filter,
            e = a.operator,
            f = d.validation || {},
            h = !0;
        1 === a.operator.nb_inputs && (b = [b]);
        for (var i = 0; i < e.nb_inputs; i++) {
            switch (d.input) {
                case "radio":
                    if (void 0 === b[i] || 0 === b[i].length) {
                        f.allow_empty_value || (h = ["radio_empty"]);
                        break
                    }
                    break;
                case "checkbox":
                    if (void 0 === b[i] || 0 === b[i].length) {
                        f.allow_empty_value || (h = ["checkbox_empty"]);
                        break
                    }
                    if (!e.multiple && b[i].length > 1) {
                        h = ["operator_not_multiple", e.type];
                        break
                    }
                    break;
                case "select":
                    if (void 0 === b[i] || 0 === b[i].length || d.placeholder && b[i] == d.placeholder_value) {
                        f.allow_empty_value || (h = ["select_empty"]);
                        break
                    }
                    if (d.multiple && !e.multiple && b[i].length > 1) {
                        h = ["operator_not_multiple", e.type];
                        break
                    }
                    break;
                default:
                    switch (g.types[d.type]) {
                        case "string":
                            if (void 0 === b[i] || 0 === b[i].length) {
                                f.allow_empty_value || (h = ["string_empty"]);
                                break
                            }
                            if (void 0 !== f.min && b[i].length < parseInt(f.min)) {
                                h = [this.getValidationMessage(f, "min", "string_exceed_min_length"), f.min];
                                break
                            }
                            if (void 0 !== f.max && b[i].length > parseInt(f.max)) {
                                h = [this.getValidationMessage(f, "max", "string_exceed_max_length"), f.max];
                                break
                            }
                            if (f.format && ("string" == typeof f.format && (f.format = new RegExp(f.format)), !f.format.test(b[i]))) {
                                h = [this.getValidationMessage(f, "format", "string_invalid_format"), f.format];
                                break
                            }
                            break;
                        case "number":
                            if (void 0 === b[i] || 0 === b[i].length) {
                                f.allow_empty_value || (h = ["number_nan"]);
                                break
                            }
                            if (isNaN(b[i])) {
                                h = ["number_nan"];
                                break
                            }
                            if ("integer" == d.type) {
                                if (parseInt(b[i]) != b[i]) {
                                    h = ["number_not_integer"];
                                    break
                                }
                            } else if (parseFloat(b[i]) != b[i]) {
                                h = ["number_not_double"];
                                break
                            }
                            if (void 0 !== f.min && b[i] < parseFloat(f.min)) {
                                h = [this.getValidationMessage(f, "min", "number_exceed_min"), f.min];
                                break
                            }
                            if (void 0 !== f.max && b[i] > parseFloat(f.max)) {
                                h = [this.getValidationMessage(f, "max", "number_exceed_max"), f.max];
                                break
                            }
                            if (void 0 !== f.step && "any" !== f.step) {
                                var j = (b[i] / f.step).toPrecision(14);
                                if (parseInt(j) != j) {
                                    h = [this.getValidationMessage(f, "step", "number_wrong_step"), f.step];
                                    break
                                }
                            }
                            break;
                        case "datetime":
                            if (void 0 === b[i] || 0 === b[i].length) {
                                f.allow_empty_value || (h = ["datetime_empty"]);
                                break
                            }
                            if (f.format) {
                                "moment" in window || l.error("MissingLibrary", "MomentJS is required for Date/Time validation. Get it here http://momentjs.com");
                                var k = moment(b[i], f.format);
                                if (!k.isValid()) {
                                    h = [this.getValidationMessage(f, "format", "datetime_invalid"), f.format];
                                    break
                                }
                                if (f.min && k < moment(f.min, f.format)) {
                                    h = [this.getValidationMessage(f, "min", "datetime_exceed_min"), f.min];
                                    break
                                }
                                if (f.max && k > moment(f.max, f.format)) {
                                    h = [this.getValidationMessage(f, "max", "datetime_exceed_max"), f.max];
                                    break
                                }
                            }
                            break;
                        case "boolean":
                            if (void 0 === b[i] || 0 === b[i].length) {
                                f.allow_empty_value || (h = ["boolean_not_valid"]);
                                break
                            }
                            if (c = ("" + b[i]).trim().toLowerCase(), "true" !== c && "false" !== c && "1" !== c && "0" !== c && 1 !== b[i] && 0 !== b[i]) {
                                h = ["boolean_not_valid"];
                                break
                            }
                    }
            }
            if (h !== !0) break
        }
        return h
    }, g.prototype.nextGroupId = function() {
        return this.status.id + "_group_" + this.status.group_id++
    }, g.prototype.nextRuleId = function() {
        return this.status.id + "_rule_" + this.status.rule_id++
    }, g.prototype.getOperators = function(a) {
        "string" == typeof a && (a = this.getFilterById(a));
        for (var b = [], c = 0, d = this.operators.length; c < d; c++) {
            if (a.operators) {
                if (a.operators.indexOf(this.operators[c].type) == -1) continue
            } else if (this.operators[c].apply_to.indexOf(g.types[a.type]) == -1) continue;
            b.push(this.operators[c])
        }
        return a.operators && b.sort(function(b, c) {
            return a.operators.indexOf(b.type) - a.operators.indexOf(c.type)
        }), this.change("getOperators", b, a)
    }, g.prototype.getFilterById = function(a, b) {
        if ("-1" == a) return null;
        for (var c = 0, d = this.filters.length; c < d; c++)
            if (this.filters[c].id == a) return this.filters[c];
        return l.error(b !== !1, "UndefinedFilter", 'Undefined filter "{0}"', a), null
    }, g.prototype.getOperatorByType = function(a, b) {
        if ("-1" == a) return null;
        for (var c = 0, d = this.operators.length; c < d; c++)
            if (this.operators[c].type == a) return this.operators[c];
        return l.error(b !== !1, "UndefinedOperator", 'Undefined operator "{0}"', a), null
    }, g.prototype.getRuleInputValue = function(a) {
        var b = a.filter,
            c = a.operator,
            d = [];
        if (b.valueGetter) d = b.valueGetter.call(this, a);
        else {
            for (var e = a.$el.find(h.value_container), f = 0; f < c.nb_inputs; f++) {
                var g, i = l.escapeElementId(a.id + "_value_" + f);
                switch (b.input) {
                    case "radio":
                        d.push(e.find("[name=" + i + "]:checked").val());
                        break;
                    case "checkbox":
                        g = [], e.find("[name=" + i + "]:checked").each(function() {
                            g.push($(this).val())
                        }), d.push(g);
                        break;
                    case "select":
                        b.multiple ? (g = [], e.find("[name=" + i + "] option:selected").each(function() {
                            g.push($(this).val())
                        }), d.push(g)) : d.push(e.find("[name=" + i + "] option:selected").val());
                        break;
                    default:
                        d.push(e.find("[name=" + i + "]").val())
                }
            }
            c.multiple && b.value_separator && (d = d.map(function(a) {
                return a.split(b.value_separator)
            })), 1 === c.nb_inputs && (d = d[0]), b.valueParser && (d = b.valueParser.call(this, a, d))
        }
        return this.change("getRuleValue", d, a)
    }, g.prototype.setRuleInputValue = function(a, b) {
        var c = a.filter,
            d = a.operator;
        if (c && d) {
            if (this._updating_input = !0, c.valueSetter) c.valueSetter.call(this, a, b);
            else {
                var e = a.$el.find(h.value_container);
                1 == d.nb_inputs && (b = [b]);
                for (var f = 0; f < d.nb_inputs; f++) {
                    var g = l.escapeElementId(a.id + "_value_" + f);
                    switch (c.input) {
                        case "radio":
                            e.find("[name=" + g + '][value="' + b[f] + '"]').prop("checked", !0).trigger("change");
                            break;
                        case "checkbox":
                            $.isArray(b[f]) || (b[f] = [b[f]]), b[f].forEach(function(a) {
                                e.find("[name=" + g + '][value="' + a + '"]').prop("checked", !0).trigger("change")
                            });
                            break;
                        default:
                            d.multiple && c.value_separator && $.isArray(b[f]) && (b[f] = b[f].join(c.value_separator)), e.find("[name=" + g + "]").val(b[f]).trigger("change")
                    }
                }
            }
            this._updating_input = !1
        }
    }, g.prototype.parseRuleFlags = function(a) {
        var b = $.extend({}, this.settings.default_rule_flags);
        return a.readonly && $.extend(b, {
            filter_readonly: !0,
            operator_readonly: !0,
            value_readonly: !0,
            no_delete: !0
        }), a.flags && $.extend(b, a.flags), this.change("parseRuleFlags", b, a)
    }, g.prototype.getRuleFlags = function(a, b) {
        if (b) return $.extend({}, a);
        var c = {};
        return $.each(this.settings.default_rule_flags, function(b, d) {
            a[b] !== d && (c[b] = a[b])
        }), c
    }, g.prototype.parseGroupFlags = function(a) {
        var b = $.extend({}, this.settings.default_group_flags);
        return a.readonly && $.extend(b, {
            condition_readonly: !0,
            no_add_rule: !0,
            no_add_group: !0,
            no_delete: !0
        }), a.flags && $.extend(b, a.flags), this.change("parseGroupFlags", b, a)
    }, g.prototype.getGroupFlags = function(a, b) {
        if (b) return $.extend({}, a);
        var c = {};
        return $.each(this.settings.default_group_flags, function(b, d) {
            a[b] !== d && (c[b] = a[b])
        }), c
    }, g.prototype.translateLabel = function(a) {
        return "object" == typeof a ? a[this.settings.lang_code] || a.en : a
    }, g.prototype.getValidationMessage = function(a, b, c) {
        return a.messages && a.messages[b] || c
    }, g.templates.group = '<dl id="{{= it.group_id }}" class="rules-group-container">   <dt class="rules-group-header">     <div class="btn-group pull-right group-actions">       <button type="button" class="btn btn-xs btn-warning" data-add="rule">         <i class="{{= it.icons.add_rule }}"></i> {{= it.lang.add_rule }}       </button>       {{? it.settings.allow_groups===-1 || it.settings.allow_groups>=it.level }}         <button type="button" class="btn btn-xs btn-success" data-add="group" style="display:none;">           <i class="{{= it.icons.add_group }}"></i> {{= it.lang.add_group }}         </button>       {{?}}       {{? it.level>1 }}         <button type="button" class="btn btn-xs btn-danger" data-delete="group">           <i class="{{= it.icons.remove_group }}"></i> {{= it.lang.delete_group }}         </button>       {{?}}     </div>     <div class="btn-group group-conditions">       {{~ it.conditions: condition }}         <label class="btn btn-xs btn-success">           <input type="radio" name="{{= it.group_id }}_cond" value="{{= condition }}"> {{= it.lang.conditions[condition] || condition }}         </label>       {{~}}     </div>     {{? it.settings.display_errors }}       <div class="error-container"><i class="{{= it.icons.error }}"></i></div>     {{?}}   </dt>   <dd class=rules-group-body>     <ul class=rules-list></ul>   </dd> </dl>', g.templates.rule = '<li id="{{= it.rule_id }}" class="rule-container">   <div class="rule-header">     <div class="btn-group pull-right rule-actions">       <button type="button" class="btn btn-xs btn-danger" data-delete="rule">         <i class="{{= it.icons.remove_rule }}"></i> {{= it.lang.delete_rule }}       </button>     </div>   </div>   {{? it.settings.display_errors }}     <div class="error-container"><i class="{{= it.icons.error }}"></i></div>   {{?}}   <div class="rule-filter-container"></div>   <div class="rule-operator-container"></div>   <div class="rule-value-container"></div> </li>', g.templates.filterSelect = '{{ var optgroup = null; }} <select class="form-control" name="{{= it.rule.id }}_filter">   {{? it.settings.display_empty_filter }}     <option value="-1">{{= it.settings.select_placeholder }}</option>   {{?}}   {{~ it.filters: filter }}     {{? optgroup !== filter.optgroup }}       {{? optgroup !== null }}</optgroup>{{?}}       {{? (optgroup = filter.optgroup) !== null }}         <optgroup label="{{= it.translate(it.settings.optgroups[optgroup]) }}">       {{?}}     {{?}}     <option value="{{= filter.id }}">{{= it.translate(filter.label) }}</option>   {{~}}   {{? optgroup !== null }}</optgroup>{{?}} </select>', g.templates.operatorSelect = '{{? it.operators.length === 1 }} <span> {{= it.lang.operators[it.operators[0].type] || it.operators[0].type }} </span> {{?}} {{ var optgroup = null; }} <select class="form-control {{? it.operators.length === 1 }}hide{{?}}" name="{{= it.rule.id }}_operator">   {{~ it.operators: operator }}     {{? optgroup !== operator.optgroup }}       {{? optgroup !== null }}</optgroup>{{?}}       {{? (optgroup = operator.optgroup) !== null }}         <optgroup label="{{= it.translate(it.settings.optgroups[optgroup]) }}">       {{?}}     {{?}}     <option value="{{= operator.type }}">{{= it.lang.operators[operator.type] || operator.type }}</option>   {{~}}   {{? optgroup !== null }}</optgroup>{{?}} </select>', g.prototype.getGroupTemplate = function(a, b) {
        var c = this.templates.group({
            builder: this,
            group_id: a,
            level: b,
            conditions: this.settings.conditions,
            icons: this.icons,
            lang: this.lang,
            settings: this.settings
        });
        return this.change("getGroupTemplate", c, b)
    }, g.prototype.getRuleTemplate = function(a) {
        var b = this.templates.rule({
            builder: this,
            rule_id: a,
            icons: this.icons,
            lang: this.lang,
            settings: this.settings
        });
        return this.change("getRuleTemplate", b)
    }, g.prototype.getRuleFilterSelect = function(a, b) {
        var c = this.templates.filterSelect({
            builder: this,
            rule: a,
            filters: b,
            icons: this.icons,
            lang: this.lang,
            settings: this.settings,
            translate: this.translateLabel
        });
        return this.change("getRuleFilterSelect", c, a)
    }, g.prototype.getRuleOperatorSelect = function(a, b) {
        var c = this.templates.operatorSelect({
            builder: this,
            rule: a,
            operators: b,
            icons: this.icons,
            lang: this.lang,
            settings: this.settings,
            translate: this.translateLabel
        });
        return this.change("getRuleOperatorSelect", c, a)
    }, g.prototype.getRuleInput = function(a, b) {
        var c = a.filter,
            d = a.filter.validation || {},
            e = a.id + "_value_" + b,
            f = c.vertical ? " class=block" : "",
            h = "";
        if ("function" == typeof c.input) h = c.input.call(this, a, e);
        else switch (c.input) {
            case "radio":
            case "checkbox":
                l.iterateOptions(c.values, function(a, b) {
                    h += "<label" + f + '><input type="' + c.input + '" name="' + e + '" value="' + a + '"> ' + b + "</label> "
                });
                break;
            case "select":
                h += '<select class="form-control" name="' + e + '"' + (c.multiple ? " multiple" : "") + ">", c.placeholder && (h += '<option value="' + c.placeholder_value + '" disabled selected>' + c.placeholder + "</option>"), l.iterateOptions(c.values, function(a, b) {
                    h += '<option value="' + a + '">' + b + "</option> "
                }), h += "</select>";
                break;
            case "textarea":
                h += '<textarea class="form-control" name="' + e + '"', c.size && (h += ' cols="' + c.size + '"'), c.rows && (h += ' rows="' + c.rows + '"'), void 0 !== d.min && (h += ' minlength="' + d.min + '"'), void 0 !== d.max && (h += ' maxlength="' + d.max + '"'), c.placeholder && (h += ' placeholder="' + c.placeholder + '"'), h += "></textarea>";
                break;
            default:
                switch (g.types[c.type]) {
                    case "number":
                        h += '<input class="form-control" type="number" name="' + e + '"', void 0 !== d.step && (h += ' step="' + d.step + '"'), void 0 !== d.min && (h += ' min="' + d.min + '"'), void 0 !== d.max && (h += ' max="' + d.max + '"'), c.placeholder && (h += ' placeholder="' + c.placeholder + '"'), c.size && (h += ' size="' + c.size + '"'), h += ">";
                        break;
                    default:
                        h += '<input class="form-control" type="text" name="' + e + '"', c.placeholder && (h += ' placeholder="' + c.placeholder + '"'), "string" === c.type && void 0 !== d.min && (h += ' minlength="' + d.min + '"'), "string" === c.type && void 0 !== d.max && (h += ' maxlength="' + d.max + '"'), c.size && (h += ' size="' + c.size + '"'), h += ">"
                }
        }
        return this.change("getRuleInput", h, a, e)
    }, $.extend(b.prototype, {
        trigger: function(a) {
            return this.$.triggerHandler(a, Array.prototype.slice.call(arguments, 1)), this
        },
        on: function() {
            return this.$.on.apply(this.$, Array.prototype.slice.call(arguments)), this
        },
        off: function() {
            return this.$.off.apply(this.$, Array.prototype.slice.call(arguments)), this
        },
        once: function() {
            return this.$.one.apply(this.$, Array.prototype.slice.call(arguments)), this
        }
    }), b.getModel = function(a) {
        return a ? a instanceof i ? a : $(a).data("queryBuilderModel") : null
    }, b.defineModelProperties = function(a, b) {
        b.forEach(function(b) {
            Object.defineProperty(a.prototype, b, {
                enumerable: !0,
                get: function() {
                    return this.__[b]
                },
                set: function(a) {
                    var c = null !== this.__[b] && "object" == typeof this.__[b] ? $.extend({}, this.__[b]) : this.__[b];
                    this.__[b] = a, null !== this.model && this.model.trigger("update", this, b, a, c)
                }
            })
        })
    };
    var i = function(a, b) {
        return this instanceof i ? (Object.defineProperty(this, "__", {
            value: {}
        }), b.data("queryBuilderModel", this), this.__.level = 1, this.__.error = null, this.__.data = void 0, this.$el = b, this.id = b[0].id, this.model = null, void(this.parent = a)) : new i
    };
    b.defineModelProperties(i, ["level", "error", "data", "flags"]), Object.defineProperty(i.prototype, "parent", {
        enumerable: !0,
        get: function() {
            return this.__.parent
        },
        set: function(a) {
            this.__.parent = a, this.level = null === a ? 1 : a.level + 1, this.model = null === a ? null : a.model
        }
    }), i.prototype.isRoot = function() {
        return 1 === this.level
    }, i.prototype.getPos = function() {
        return this.isRoot() ? -1 : this.parent.getNodePos(this)
    }, i.prototype.drop = function() {
        var a = this.model;
        this.isRoot() || this.parent._removeNode(this), null !== a && a.trigger("drop", this)
    }, i.prototype.moveAfter = function(a) {
        if (!this.isRoot()) return this._move(a.parent, a.getPos() + 1), this
    }, i.prototype.moveAtBegin = function(a) {
        if (!this.isRoot()) return void 0 === a && (a = this.parent), this._move(a, 0), this
    }, i.prototype.moveAtEnd = function(a) {
        if (!this.isRoot()) return void 0 === a && (a = this.parent), this._move(a, 0 === a.length() ? 0 : a.length() - 1), this
    }, i.prototype._move = function(a, b) {
        this.parent._removeNode(this), a._appendNode(this, b, !1), null !== this.model && this.model.trigger("move", this, a, b)
    };
    var j = function(a, b) {
        return this instanceof j ? (i.call(this, a, b), this.rules = [], void(this.__.condition = null)) : new j(a, b)
    };
    j.prototype = Object.create(i.prototype), j.prototype.constructor = j, b.defineModelProperties(j, ["condition"]), j.prototype.empty = function() {
        this.each("reverse", function(a) {
            a.drop()
        }, function(a) {
            a.drop()
        })
    }, j.prototype.drop = function() {
        this.empty(), i.prototype.drop.call(this)
    }, j.prototype.length = function() {
        return this.rules.length
    }, j.prototype._appendNode = function(a, b, c) {
        return void 0 === b && (b = this.length()), this.rules.splice(b, 0, a), a.parent = this, c && null !== this.model && this.model.trigger("add", a, b), a
    }, j.prototype.addGroup = function(a, b) {
        return this._appendNode(new j(this, a), b, !0)
    }, j.prototype.addRule = function(a, b) {
        return this._appendNode(new k(this, a), b, !0)
    }, j.prototype._removeNode = function(a) {
        var b = this.getNodePos(a);
        return b !== -1 && (a.parent = null, this.rules.splice(b, 1)), this
    }, j.prototype.getNodePos = function(a) {
        return this.rules.indexOf(a)
    }, j.prototype.each = function(a, b, c, d) {
        "function" == typeof a && (d = c, c = b, b = a, a = !1), d = void 0 === d ? null : d;
        for (var e = a ? this.rules.length - 1 : 0, f = a ? 0 : this.rules.length - 1, g = a ? -1 : 1, h = function() {
                return a ? e >= f : e <= f
            }, i = !1; h() && (this.rules[e] instanceof j ? void 0 !== c && (i = c.call(d, this.rules[e]) === !1) : i = b.call(d, this.rules[e]) === !1, !i); e += g);
        return !i
    }, j.prototype.contains = function(a, b) {
        return this.getNodePos(a) !== -1 || !!b && !this.each(function(a) {
            return !0
        }, function(b) {
            return !b.contains(a, !0)
        })
    };
    var k = function(a, b) {
        return this instanceof k ? (i.call(this, a, b), this._updating_value = !1, this._updating_input = !1, this.__.filter = null, this.__.operator = null, this.__.flags = {}, void(this.__.value = void 0)) : new k(a, b)
    };
    k.prototype = Object.create(i.prototype), k.prototype.constructor = k, b.defineModelProperties(k, ["filter", "operator", "value"]), g.Group = j, g.Rule = k;
    var l = g.utils = {};
    l.iterateOptions = function(a, b) {
        a && ($.isArray(a) ? a.forEach(function(a) {
            $.isPlainObject(a) ? $.each(a, function(a, c) {
                return b(a, c), !1
            }) : b(a, a)
        }) : $.each(a, function(a, c) {
            b(a, c)
        }))
    }, l.fmt = function(a, b) {
        return Array.isArray(b) || (b = Array.prototype.slice.call(arguments, 1)), a.replace(/{([0-9]+)}/g, function(a, c) {
            return b[parseInt(c)]
        })
    }, l.error = function() {
        var a = 0,
            b = "boolean" != typeof arguments[a] || arguments[a++],
            c = arguments[a++],
            d = arguments[a++],
            e = Array.isArray(arguments[a]) ? arguments[a] : Array.prototype.slice.call(arguments, a);
        if (b) {
            var f = new Error(l.fmt(d, e));
            throw f.name = c + "Error", f.args = e, f
        }
        console.error(c + "Error: " + l.fmt(d, e))
    }, l.changeType = function(a, b, c) {
        switch (b) {
            case "integer":
                return parseInt(a);
            case "double":
                return parseFloat(a);
            case "boolean":
                var d = "true" === a.trim().toLowerCase() || "1" === a.trim() || 1 === a;
                return c ? d ? 1 : 0 : d;
            default:
                return a
        }
    }, l.escapeString = function(a) {
        return "string" != typeof a ? a : a.replace(/[\0\n\r\b\\\'\"]/g, function(a) {
            switch (a) {
                case "\0":
                    return "\\0";
                case "\n":
                    return "\\n";
                case "\r":
                    return "\\r";
                case "\b":
                    return "\\b";
                default:
                    return "\\" + a
            }
        }).replace(/\t/g, "\\t").replace(/\x1a/g, "\\Z")
    }, l.escapeRegExp = function(a) {
        return a.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")
    }, l.escapeElementId = function(a) {
        return a ? a.replace(/(\\)?([:.\[\],])/g, function(a, b, c) {
            return b ? a : "\\" + c
        }) : a
    }, l.groupSort = function(a, b) {
        var c = [],

            d = [];
        return a.forEach(function(a) {
            var e;
            a[b] ? (e = c.lastIndexOf(a[b]), e == -1 ? e = c.length : e++) : e = c.length, c.splice(e, 0, a[b]), d.splice(e, 0, a)
        }), d
    }, $.fn.queryBuilder = function(a) {
        0 === this.length && l.error("Config", "No target defined"), this.length > 1 && l.error("Config", "Unable to initialize on multiple target");
        var b = this.data("queryBuilder"),
            c = "object" == typeof a && a || {};
        return b || "destroy" != a ? (b || this.data("queryBuilder", new g(this, c)), "string" == typeof a ? b[a].apply(b, Array.prototype.slice.call(arguments, 1)) : this) : this
    }, $.fn.queryBuilder.constructor = g, $.fn.queryBuilder.defaults = g.defaults, $.fn.queryBuilder.extend = g.extend, $.fn.queryBuilder.define = g.define, $.fn.queryBuilder.regional = g.regional, g.define("bt-checkbox", function(a) {
        if ("glyphicons" == a.font) {
            var b = document.createElement("style");
            b.innerHTML = '.checkbox input[type=checkbox]:checked + label:after {     font-family: "Glyphicons Halflings";     content: "\\e013"; } .checkbox label:after {     padding-left: 4px;     padding-top: 2px;     font-size: 9px; }', document.body.appendChild(b)
        }
        this.on("getRuleInput.filter", function(b, c, d) {
            var e = c.filter;
            if (("radio" === e.input || "checkbox" === e.input) && !e.plugin) {
                b.value = "", e.colors || (e.colors = {}), e.color && (e.colors._def_ = e.color);
                var f = e.vertical ? ' style="display:block"' : "",
                    g = 0;
                l.iterateOptions(e.values, function(c, h) {
                    var i = e.colors[c] || e.colors._def_ || a.color,
                        j = d + "_" + g++;
                    b.value += "<div" + f + ' class="' + e.input + " " + e.input + "-" + i + '">   <input type="' + e.input + '" name="' + d + '" id="' + j + '" value="' + c + '">   <label for="' + j + '">' + h + "</label> </div>"
                })
            }
        })
    }, {
        font: "glyphicons",
        color: "default"
    }), g.define("bt-selectpicker", function(a) {
        $.fn.selectpicker && $.fn.selectpicker.Constructor || l.error("MissingLibrary", 'Bootstrap Select is required to use "bt-selectpicker" plugin. Get it here: http://silviomoreto.github.io/bootstrap-select'), this.on("afterCreateRuleFilters", function(b, c) {
            c.$el.find(h.rule_filter).removeClass("form-control").selectpicker(a)
        }), this.on("afterCreateRuleOperators", function(b, c) {
            c.$el.find(h.rule_operator).removeClass("form-control").selectpicker(a)
        }), this.on("afterUpdateRuleFilter", function(a, b) {
            b.$el.find(h.rule_filter).selectpicker("render")
        }), this.on("afterUpdateRuleOperator", function(a, b) {
            b.$el.find(h.rule_operator).selectpicker("render")
        })
    }, {
        container: "body",
        style: "btn-inverse btn-xs",
        width: "auto",
        showIcon: !1
    }), g.define("bt-tooltip-errors", function(a) {
        $.fn.tooltip && $.fn.tooltip.Constructor && $.fn.tooltip.Constructor.prototype.fixTitle || l.error("MissingLibrary", 'Bootstrap Tooltip is required to use "bt-tooltip-errors" plugin. Get it here: http://getbootstrap.com');
        var b = this;
        this.on("getRuleTemplate.filter getGroupTemplate.filter", function(a) {
            var b = $(a.value);
            b.find(h.error_container).attr("data-toggle", "tooltip"), a.value = b.prop("outerHTML")
        }), this.model.on("update", function(c, d, e) {
            "error" == e && b.settings.display_errors && d.$el.find(h.error_container).eq(0).tooltip(a).tooltip("hide").tooltip("fixTitle")
        })
    }, {
        placement: "right"
    }), g.extend({
        setFilters: function(a, b) {
            var c = this;
            void 0 === b && (b = a, a = !1), b = this.checkFilters(b), b = this.change("setFilters", b);
            var d = b.map(function(a) {
                return a.id
            });
            if (a || ! function f(a) {
                    a.each(function(a) {
                        a.filter && d.indexOf(a.filter.id) === -1 && l.error("ChangeFilter", 'A rule is using filter "{0}"', a.filter.id)
                    }, f)
                }(this.model.root), this.filters = b, function g(a) {
                    a.each(!0, function(a) {
                        a.filter && d.indexOf(a.filter.id) === -1 ? a.drop() : (c.createRuleFilters(a), a.$el.find(h.rule_filter).val(a.filter ? a.filter.id : "-1"), c.trigger("afterUpdateRuleFilter", a))
                    }, g)
                }(this.model.root), this.settings.plugins && (this.settings.plugins["unique-filter"] && this.updateDisabledFilters(), this.settings.plugins["bt-selectpicker"] && this.$el.find(h.rule_filter).selectpicker("render")), this.settings.default_filter) try {
                this.getFilterById(this.settings.default_filter)
            } catch (e) {
                this.settings.default_filter = null
            }
            this.trigger("afterSetFilters", b)
        },
        addFilter: function(a, b) {
            void 0 === b || "#end" == b ? b = this.filters.length : "#start" == b && (b = 0), $.isArray(a) || (a = [a]);
            var c = $.extend(!0, [], this.filters);
            parseInt(b) == b ? Array.prototype.splice.apply(c, [b, 0].concat(a)) : this.filters.some(function(a, c) {
                if (a.id == b) return b = c + 1, !0
            }) ? Array.prototype.splice.apply(c, [b, 0].concat(a)) : Array.prototype.push.apply(c, a), this.setFilters(c)
        },
        removeFilter: function(a, b) {
            var c = $.extend(!0, [], this.filters);
            "string" == typeof a && (a = [a]), c = c.filter(function(b) {
                return a.indexOf(b.id) === -1
            }), this.setFilters(b, c)
        }
    }), g.define("filter-description", function(a) {
        "inline" === a.mode ? this.on("afterUpdateRuleFilter", function(b, c) {
            var d = c.$el.find("p.filter-description");
            c.filter && c.filter.description ? (0 === d.length ? (d = $('<p class="filter-description"></p>'), d.appendTo(c.$el)) : d.show(), d.html('<i class="' + a.icon + '"></i> ' + c.filter.description)) : d.hide()
        }) : "popover" === a.mode ? ($.fn.popover && $.fn.popover.Constructor && $.fn.popover.Constructor.prototype.fixTitle || l.error("MissingLibrary", 'Bootstrap Popover is required to use "filter-description" plugin. Get it here: http://getbootstrap.com'), this.on("afterUpdateRuleFilter", function(b, c) {
            var d = c.$el.find("button.filter-description");
            c.filter && c.filter.description ? (0 === d.length ? (d = $('<button type="button" class="btn btn-xs btn-info filter-description" data-toggle="popover"><i class="' + a.icon + '"></i></button>'), d.prependTo(c.$el.find(h.rule_actions)), d.popover({
                placement: "left",
                container: "body",
                html: !0
            }), d.on("mouseout", function() {
                d.popover("hide")
            })) : d.show(), d.data("bs.popover").options.content = c.filter.description, d.attr("aria-describedby") && d.popover("show")) : (d.hide(), d.data("bs.popover") && d.popover("hide"))
        })) : "bootbox" === a.mode && ("bootbox" in window || l.error("MissingLibrary", 'Bootbox is required to use "filter-description" plugin. Get it here: http://bootboxjs.com'), this.on("afterUpdateRuleFilter", function(b, c) {
            var d = c.$el.find("button.filter-description");
            c.filter && c.filter.description ? (0 === d.length && (d = $('<button type="button" class="btn btn-xs btn-info filter-description" data-toggle="bootbox"><i class="' + a.icon + '"></i></button>'), d.prependTo(c.$el.find(h.rule_actions)), d.on("click", function() {
                bootbox.alert(d.data("description"))
            })), d.data("description", c.filter.description)) : d.hide()
        }))
    }, {
        icon: "glyphicon glyphicon-info-sign",
        mode: "popover"
    }), g.defaults({
        operatorOpposites: {
            equal: "not_equal",
            not_equal: "equal",
            "in": "not_in",
            not_in: "in",
            less: "greater_or_equal",
            less_or_equal: "greater",
            greater: "less_or_equal",
            greater_or_equal: "less",
            between: "not_between",
            not_between: "between",
            begins_with: "not_begins_with",
            not_begins_with: "begins_with",
            contains: "not_contains",
            not_contains: "contains",
            ends_with: "not_ends_with",
            not_ends_with: "ends_with",
            is_empty: "is_not_empty",
            is_not_empty: "is_empty",
            is_null: "is_not_null",
            is_not_null: "is_null"
        },
        conditionOpposites: {
            AND: "OR",
            OR: "AND"
        }
    }), g.define("invert", function(a) {
        var c = this;
        this.on("afterInit", function() {
            c.$el.on("click.queryBuilder", "[data-invert=group]", function() {
                var d = $(this).closest(h.group_container);
                c.invert(b(d), a)
            }), a.display_rules_button && a.invert_rules && c.$el.on("click.queryBuilder", "[data-invert=rule]", function() {
                var d = $(this).closest(h.rule_container);
                c.invert(b(d), a)
            })
        }), this.on("getGroupTemplate.filter", function(b, d) {
            var e = $(b.value);
            e.find(h.condition_container).after('<button type="button" class="btn btn-xs btn-default" data-invert="group"><i class="' + a.icon + '"></i> ' + c.lang.invert + "</button>"), b.value = e.prop("outerHTML")
        }), a.display_rules_button && a.invert_rules && this.on("getRuleTemplate.filter", function(b) {
            var d = $(b.value);
            d.find(h.rule_actions).prepend('<button type="button" class="btn btn-xs btn-default" data-invert="rule"><i class="' + a.icon + '"></i> ' + c.lang.invert + "</button>"), b.value = d.prop("outerHTML")
        })
    }, {
        icon: "glyphicon glyphicon-random",
        recursive: !0,
        invert_rules: !0,
        display_rules_button: !1,
        silent_fail: !1
    }), g.extend({
        invert: function(a, b) {
            if (!(a instanceof i)) {
                if (!this.model.root) return;
                b = a, a = this.model.root
            }
            if ("object" != typeof b && (b = {}), void 0 === b.recursive && (b.recursive = !0), void 0 === b.invert_rules && (b.invert_rules = !0), void 0 === b.silent_fail && (b.silent_fail = !1), void 0 === b.trigger && (b.trigger = !0), a instanceof j) {
                if (this.settings.conditionOpposites[a.condition] ? a.condition = this.settings.conditionOpposites[a.condition] : b.silent_fail || l.error("InvertCondition", 'Unknown inverse of condition "{0}"', a.condition), b.recursive) {
                    var c = $.extend({}, b, {
                        trigger: !1
                    });
                    a.each(function(a) {
                        b.invert_rules && this.invert(a, c)
                    }, function(a) {
                        this.invert(a, c)
                    }, this)
                }
            } else if (a instanceof k && a.operator && !a.filter.no_invert)
                if (this.settings.operatorOpposites[a.operator.type]) {
                    var d = this.settings.operatorOpposites[a.operator.type];
                    a.filter.operators && a.filter.operators.indexOf(d) == -1 || (a.operator = this.getOperatorByType(d))
                } else b.silent_fail || l.error("InvertOperator", 'Unknown inverse of operator "{0}"', a.operator.type);
            b.trigger && this.trigger("afterInvert", a, b)
        }
    }), g.defaults({
        mongoOperators: {
            equal: function(a) {
                return {
            
                    $regex: "^" + l.escapeRegExp(a[0]) + "$",
                    $options: "i"
                }

                //return a[0]
            },
            not_equal: function(a) {
                return {
                    $ne: a[0]
                }
            },
            "in": function(a) {
                return {
                    $in: a
                }
            },
            not_in: function(a) {
                return {
                    $nin: a
                }
            },
            less: function(a) {
                return {
                    $lt: a[0]
                }
            },
            less_or_equal: function(a) {
                return {
                    $lte: a[0]
                }
            },
            greater: function(a) {
                return {
                    $gt: a[0]
                }
            },
            greater_or_equal: function(a) {
                return {
                    $gte: a[0]
                }
            },
            between: function(a) {
                return {
                    $gte: a[0],
                    $lte: a[1]
                }
            },
            not_between: function(a) {
                return {
                    $lt: a[0],
                    $gt: a[1]
                }
            },
            begins_with: function(a) {
                return {
                    $regex: "^" + l.escapeRegExp(a[0]),
                    $options: "i"
                }
            },
            not_begins_with: function(a) {
                return {
                    $regex: "^(?!" + l.escapeRegExp(a[0]) + ")"
                }
            },
            contains: function(a) {
                return {
                    $regex: l.escapeRegExp(a[0]),
                    $options: "i"

                }
            },
            not_contains: function(a) {
                return {
                    $regex: "^((?!" + l.escapeRegExp(a[0]) + ").)*$",
                    $options: "s"
                }
            },
            ends_with: function(a) {
                return {
                    $regex: l.escapeRegExp(a[0]) + "$",
                    $options: "i"
                }
            },
            not_ends_with: function(a) {
                return {
                    $regex: "(?<!" + l.escapeRegExp(a[0]) + ")$"
                }
            },
            is_empty: function(a) {
                return ""
            },
            is_not_empty: function(a) {
                return {
                    $ne: ""
                }
            },
            is_null: function(a) {
                return null
            },
            is_not_null: function(a) {
                return {
                    $ne: null
                }
            }
        },
        mongoRuleOperators: {
            $ne: function(a) {
                return a = a.$ne, {
                    val: a,
                    op: null === a ? "is_not_null" : "" === a ? "is_not_empty" : "not_equal"
                }
            },
            eq: function(a) {
                return {
                    val: a,
                    op: null === a ? "is_null" : "" === a ? "is_empty" : "equal"
                }
            },
            $regex: function(a) {
                return a = a.$regex, "^(?!" == a.slice(0, 4) && ")" == a.slice(-1) ? {
                    val: a.slice(4, -1),
                    op: "not_begins_with"
                } : "^((?!" == a.slice(0, 5) && ").)*$" == a.slice(-5) ? {
                    val: a.slice(5, -5),
                    op: "not_contains"
                } : "(?<!" == a.slice(0, 4) && ")$" == a.slice(-2) ? {
                    val: a.slice(4, -2),
                    op: "not_ends_with"
                } : "$" == a.slice(-1) ? {
                    val: a.slice(0, -1),
                    op: "ends_with"
                } : "^" == a.slice(0, 1) ? {
                    val: a.slice(1),
                    op: "begins_with"
                } : {
                    val: a,
                    op: "contains"
                }
            },
            between: function(a) {
                return {
                    val: [a.$gte, a.$lte],
                    op: "between"
                }
            },
            not_between: function(a) {
                return {
                    val: [a.$lt, a.$gt],
                    op: "not_between"
                }
            },
            $in: function(a) {
                return {
                    val: a.$in,
                    op: "in"
                }
            },
            $nin: function(a) {
                return {
                    val: a.$nin,
                    op: "not_in"
                }
            },
            $lt: function(a) {
                return {
                    val: a.$lt,
                    op: "less"
                }
            },
            $lte: function(a) {
                return {
                    val: a.$lte,
                    op: "less_or_equal"
                }
            },
            $gt: function(a) {
                return {
                    val: a.$gt,
                    op: "greater"
                }
            },
            $gte: function(a) {
                return {
                    val: a.$gte,
                    op: "greater_or_equal"
                }
            }
        }
    }), g.extend({
        getMongo: function(a) {
            a = void 0 === a ? this.getRules() : a;
            var b = this;
            return function c(a) {
                if (a.condition || (a.condition = b.settings.default_condition), ["AND", "OR"].indexOf(a.condition.toUpperCase()) === -1 && l.error("UndefinedMongoCondition", 'Unable to build MongoDB query with condition "{0}"', a.condition), !a.rules) return {};
                var d = [];
                a.rules.forEach(function(a) {
                    if (a.rules && a.rules.length > 0) d.push(c(a));
                    else {
                        var e = b.settings.mongoOperators[a.operator],
                            f = b.getOperatorByType(a.operator),
                            g = [];
                        void 0 === e && l.error("UndefinedMongoOperator", 'Unknown MongoDB operation for operator "{0}"', a.operator), 0 !== f.nb_inputs && (a.value instanceof Array || (a.value = [a.value]), a.value.forEach(function(b) {
                            g.push(l.changeType(b, a.type, !1))
                        }));
                        var h = {},
                            i = b.change("getMongoDBField", a.field, a);
                        h[i] = e.call(b, g), d.push(b.change("ruleToMongo", h, a, g, e))
                    }
                });
                var e = {};
                return e["$" + a.condition.toLowerCase()] = d, b.change("groupToMongo", e, a)
            }(a)
        },
        getRulesFromMongo: function(a) {
            if (void 0 === a || null === a) return null;
            var b = this;
            if (a = b.change("parseMongoNode", a), "rules" in a && "condition" in a) return a;
            var e = d(a);
            return e || l.error("MongoParse", "Invalid MongoDB query format"),
                function f(a, e) {
                    var g = a[e],
                        h = [];
                    return g.forEach(function(a) {
                        if (a = b.change("parseMongoNode", a), "rules" in a && "condition" in a) return void h.push(a);
                        if ("id" in a && "operator" in a && "value" in a) return void h.push(a);
                        var e = d(a);
                        if (e) h.push(f(a, e));
                        else {
                            var g = Object.keys(a)[0],
                                i = a[g],
                                j = c(i, g);
                            void 0 === j && l.error("MongoParse", "Invalid MongoDB query format");
                            var k = b.settings.mongoRuleOperators[j];
                            void 0 === k && l.error("UndefinedMongoOperator", 'JSON Rule operation unknown for operator "{0}"', j);
                            var m = k.call(b, i),
                                n = b.change("mongoToRule", {
                                    id: b.change("getMongoDBFieldID", g, i),
                                    field: g,
                                    operator: m.op,
                                    value: m.val
                                }, a);
                            h.push(n)
                        }
                    }), b.change("mongoToGroup", {
                        condition: e.replace("$", "").toUpperCase(),
                        rules: h
                    }, a)
                }(a, e)
        },
        setRulesFromMongo: function(a) {
            this.setRules(this.getRulesFromMongo(a))
        }
    }), h.group_not = h.group_header + " [data-not=group]", b.defineModelProperties(j, ["not"]), g.define("not-group", function(a) {
        var c = this;
        this.on("afterInit", function() {
            c.$el.on("click.queryBuilder", "[data-not=group]", function() {
                var a = $(this).closest(h.group_container),
                    c = b(a);
                c.not = !c.not
            }), c.model.on("update", function(a, b, d) {
                b instanceof j && "not" === d && c.updateGroupNot(b)
            })
        }), this.on("afterAddGroup", function(a, b) {
            b.__.not = !1
        }), this.on("getGroupTemplate.filter", function(b, d) {
            var e = $(b.value);
            e.find(h.condition_container).prepend('<button type="button" class="btn btn-xs btn-default" data-not="group"><i class="' + a.icon_unchecked + '"></i> ' + c.lang.NOT + "</button>"), b.value = e.prop("outerHTML")
        }), this.on("groupToJson.filter", function(a, b) {
            a.value.not = b.not
        }), this.on("jsonToGroup.filter", function(a, b) {
            a.value.not = !!b.not
        }), this.on("groupToSQL.filter", function(a, b) {
            b.not && (a.value = "NOT ( " + a.value + " )")
        }), this.on("parseSQLNode.filter", function(a) {
            a.value.name && "NOT" == a.value.name.toUpperCase() && (a.value = a.value.arguments.value[0], a.value.not = !0)
        }), this.on("sqlToGroup.filter", function(a, b) {
            a.value.not = !!b.not
        }), this.on("groupToMongo.filter", function(a, b) {
            var c = "$" + b.condition.toLowerCase();
            b.not && a.value[c] && (a.value = {
                $nor: [a.value]
            })
        }), this.on("parseMongoNode.filter", function(a) {
            var b = Object.keys(a.value);
            "$nor" == b[0] && (a.value = a.value[b[0]][0], a.value.not = !0)
        }), this.on("mongoToGroup.filter", function(a, b) {
            a.value.not = !!b.not
        })
    }, {
        icon_unchecked: "glyphicon glyphicon-unchecked",
        icon_checked: "glyphicon glyphicon-check"
    }), g.extend({
        updateGroupNot: function(a) {
            var b = this.plugins["not-group"];
            a.$el.find(">" + h.group_not).toggleClass("active", a.not).find("i").attr("class", a.not ? b.icon_checked : b.icon_unchecked), this.trigger("afterUpdateGroupNot", a)
        }
    }), h.rule_and_group_containers = h.rule_container + ", " + h.group_container, h.drag_handle = ".drag-handle", g.defaults({
        default_rule_flags: {
            no_sortable: !1,
            no_drop: !1
        },
        default_group_flags: {
            no_sortable: !1,
            no_drop: !1
        }
    }), g.define("sortable", function(a) {
        "interact" in window || l.error("MissingLibrary", 'interact.js is required to use "sortable" plugin. Get it here: http://interactjs.io'), void 0 !== a.default_no_sortable && (l.error(!1, "Config", 'Sortable plugin : "default_no_sortable" options is deprecated, use standard "default_rule_flags" and "default_group_flags" instead'), this.settings.default_rule_flags.no_sortable = this.settings.default_group_flags.no_sortable = a.default_no_sortable), interact.dynamicDrop(!0), interact.pointerMoveTolerance(10);
        var c, d, f;
        this.on("afterAddRule afterAddGroup", function(g, i) {
            if (i != c) {
                var k = g.builder;
                a.inherit_no_sortable && i.parent && i.parent.flags.no_sortable && (i.flags.no_sortable = !0), a.inherit_no_drop && i.parent && i.parent.flags.no_drop && (i.flags.no_drop = !0), i.flags.no_sortable || interact(i.$el[0]).allowFrom(h.drag_handle).draggable({
                    onstart: function(a) {
                        f = b(a.target), d = f.$el.clone().appendTo(f.$el.parent()).width(f.$el.outerWidth()).addClass("dragging");
                        var e = $('<div class="rule-placeholder">&nbsp;</div>').height(f.$el.outerHeight());
                        c = f.parent.addRule(e, f.getPos()), f.$el.hide()
                    },
                    onmove: function(a) {
                        d[0].style.top = a.clientY - 15 + "px", d[0].style.left = a.clientX - 15 + "px"
                    },
                    onend: function() {
                        d.remove(), d = void 0, c.drop(), c = void 0, f.$el.show(), k.trigger("afterMove", f)
                    }
                }), i.flags.no_drop || (interact(i.$el[0]).dropzone({
                    accept: h.rule_and_group_containers,
                    ondragenter: function(a) {
                        e(c, $(a.target))
                    },
                    ondrop: function(a) {
                        e(f, $(a.target), k)
                    }
                }), i instanceof j && interact(i.$el.find(h.group_header)[0]).dropzone({
                    accept: h.rule_and_group_containers,
                    ondragenter: function(a) {
                        e(c, $(a.target))
                    },
                    ondrop: function(a) {
                        e(f, $(a.target), k)
                    }
                }))
            }
        }), this.on("beforeDeleteRule beforeDeleteGroup", function(a, b) {
            a.isDefaultPrevented() || (interact(b.$el[0]).unset(), b instanceof j && interact(b.$el.find(h.group_header)[0]).unset())
        }), this.on("afterApplyRuleFlags afterApplyGroupFlags", function(a, b) {
            b.flags.no_sortable && b.$el.find(".drag-handle").remove()
        }), this.on("getGroupTemplate.filter", function(b, c) {
            if (c > 1) {
                var d = $(b.value);
                d.find(h.condition_container).after('<div class="drag-handle"><i class="' + a.icon + '"></i></div>'), b.value = d.prop("outerHTML")
            }
        }), this.on("getRuleTemplate.filter", function(b) {
            var c = $(b.value);
            c.find(h.rule_header).after('<div class="drag-handle"><i class="' + a.icon + '"></i></div>'), b.value = c.prop("outerHTML")
        })
    }, {
        inherit_no_sortable: !0,
        inherit_no_drop: !0,
        icon: "glyphicon glyphicon-sort"
    }), g.defaults({
        sqlOperators: {
            equal: {
                op: "= ?"
            },
            not_equal: {
                op: "!= ?"
            },
            "in": {
                op: "IN(?)",
                sep: ", "
            },
            not_in: {
                op: "NOT IN(?)",
                sep: ", "
            },
            less: {
                op: "< ?"
            },
            less_or_equal: {
                op: "<= ?"
            },
            greater: {
                op: "> ?"
            },
            greater_or_equal: {
                op: ">= ?"
            },
            between: {
                op: "BETWEEN ?",
                sep: " AND "
            },
            not_between: {
                op: "NOT BETWEEN ?",
                sep: " AND "
            },
            begins_with: {
                op: "LIKE(?)",
                mod: "{0}%"
            },
            not_begins_with: {
                op: "NOT LIKE(?)",
                mod: "{0}%"
            },
            contains: {
                op: "LIKE(?)",
                mod: "%{0}%"
            },
            not_contains: {
                op: "NOT LIKE(?)",
                mod: "%{0}%"
            },
            ends_with: {
                op: "LIKE(?)",
                mod: "%{0}"
            },
            not_ends_with: {
                op: "NOT LIKE(?)",
                mod: "%{0}"
            },
            is_empty: {
                op: "= ''"
            },
            is_not_empty: {
                op: "!= ''"
            },
            is_null: {
                op: "IS NULL"
            },
            is_not_null: {
                op: "IS NOT NULL"
            }
        },
        sqlRuleOperator: {
            "=": function(a) {
                return {
                    val: a,
                    op: "" === a ? "is_empty" : "equal"
                }
            },
            "!=": function(a) {
                return {
                    val: a,
                    op: "" === a ? "is_not_empty" : "not_equal"
                }
            },
            LIKE: function(a) {
                return "%" == a.slice(0, 1) && "%" == a.slice(-1) ? {
                    val: a.slice(1, -1),
                    op: "contains"
                } : "%" == a.slice(0, 1) ? {
                    val: a.slice(1),
                    op: "ends_with"
                } : "%" == a.slice(-1) ? {
                    val: a.slice(0, -1),
                    op: "begins_with"
                } : void l.error("SQLParse", 'Invalid value for LIKE operator "{0}"', a)
            },
            "NOT LIKE": function(a) {
                return "%" == a.slice(0, 1) && "%" == a.slice(-1) ? {
                    val: a.slice(1, -1),
                    op: "not_contains"
                } : "%" == a.slice(0, 1) ? {
                    val: a.slice(1),
                    op: "not_ends_with"
                } : "%" == a.slice(-1) ? {
                    val: a.slice(0, -1),
                    op: "not_begins_with"
                } : void l.error("SQLParse", 'Invalid value for NOT LIKE operator "{0}"', a)
            },
            IN: function(a) {
                return {
                    val: a,
                    op: "in"
                }
            },
            "NOT IN": function(a) {
                return {
                    val: a,
                    op: "not_in"
                }
            },
            "<": function(a) {
                return {
                    val: a,
                    op: "less"
                }
            },
            "<=": function(a) {
                return {
                    val: a,
                    op: "less_or_equal"
                }
            },
            ">": function(a) {
                return {
                    val: a,
                    op: "greater"
                }
            },
            ">=": function(a) {
                return {
                    val: a,
                    op: "greater_or_equal"
                }
            },
            BETWEEN: function(a) {
                return {
                    val: a,
                    op: "between"
                }
            },
            "NOT BETWEEN": function(a) {
                return {
                    val: a,
                    op: "not_between"
                }
            },
            IS: function(a) {
                return null !== a && l.error("SQLParse", "Invalid value for IS operator"), {
                    val: null,
                    op: "is_null"
                }
            },
            "IS NOT": function(a) {
                return null !== a && l.error("SQLParse", "Invalid value for IS operator"), {
                    val: null,
                    op: "is_not_null"
                }
            }
        },
        sqlStatements: {
            question_mark: function() {
                var a = [];
                return {
                    add: function(b, c) {
                        return a.push(c), "?"
                    },
                    run: function() {
                        return a
                    }
                }
            },
            numbered: function(a) {
                (!a || a.length > 1) && (a = "$");
                var b = 0,
                    c = [];
                return {
                    add: function(d, e) {
                        return c.push(e), b++, a + b
                    },
                    run: function() {
                        return c
                    }
                }
            },
            named: function(a) {
                (!a || a.length > 1) && (a = ":");
                var b = {},
                    c = {};
                return {
                    add: function(d, e) {
                        b[d.field] || (b[d.field] = 1);
                        var f = d.field + "_" + b[d.field]++;
                        return c[f] = e, a + f
                    },
                    run: function() {
                        return c
                    }
                }
            }
        },
        sqlRuleStatement: {
            question_mark: function(a) {
                var b = 0;
                return {
                    parse: function(c) {
                        return "?" == c ? a[b++] : c
                    },
                    esc: function(a) {
                        return a.replace(/\?/g, "'?'")
                    }
                }
            },
            numbered: function(a, b) {
                (!b || b.length > 1) && (b = "$");
                var c = new RegExp("^\\" + b + "[0-9]+$"),
                    d = new RegExp("\\" + b + "([0-9]+)", "g");
                return {
                    parse: function(b) {
                        return c.test(b) ? a[b.slice(1) - 1] : b
                    },
                    esc: function(a) {
                        return a.replace(d, "'" + ("$" == b ? "$$" : b) + "$1'")
                    }
                }
            },
            named: function(a, b) {
                (!b || b.length > 1) && (b = ":");
                var c = new RegExp("^\\" + b),
                    d = new RegExp("\\" + b + "(" + Object.keys(a).join("|") + ")", "g");
                return {
                    parse: function(b) {
                        return c.test(b) ? a[b.slice(1)] : b
                    },
                    esc: function(a) {
                        return a.replace(d, "'" + ("$" == b ? "$$" : b) + "$1'")
                    }
                }
            }
        }
    }), g.extend({
        getSQL: function(a, b, c) {
            if (c = void 0 === c ? this.getRules() : c, b = b === !0 ? "\n" : " ", a === !0 && (a = "question_mark"), "string" == typeof a) {
                var d = f(a);
                a = this.settings.sqlStatements[d[1]](d[2])
            }
            var e = this,
                g = function h(c) {
                    if (c.condition || (c.condition = e.settings.default_condition), ["AND", "OR"].indexOf(c.condition.toUpperCase()) === -1 && l.error("UndefinedSQLCondition", 'Unable to build SQL query with condition "{0}"', c.condition), !c.rules) return "";
                    var d = [];
                    c.rules.forEach(function(c) {
                        if (c.rules && c.rules.length > 0) d.push("(" + b + h(c) + b + ")" + b);
                        else {
                            var f = e.settings.sqlOperators[c.operator],
                                g = e.getOperatorByType(c.operator),
                                i = "";
                            void 0 === f && l.error("UndefinedSQLOperator", 'Unknown SQL operation for operator "{0}"', c.operator), 0 !== g.nb_inputs && (c.value instanceof Array || (c.value = [c.value]), c.value.forEach(function(b, d) {
                                d > 0 && (i += f.sep), "integer" == c.type || "double" == c.type || "boolean" == c.type ? b = l.changeType(b, c.type, !0) : a || (b = l.escapeString(b)), f.mod && (b = l.fmt(f.mod, b)), a ? i += a.add(c, b) : ("string" == typeof b && (b = "'" + b + "'"), i += b)
                            }));
                            var j = function(a) {
                                    return f.op.replace(/\?/, a)
                                },
                                k = e.change("getSQLField", c.field, c) + " " + j(i);
                            d.push(e.change("ruleToSQL", k, c, i, j))
                        }
                    });
                    var f = d.join(" " + c.condition + b);
                    return e.change("groupToSQL", f, c)
                }(c);
            return a ? {
                sql: g,
                params: a.run()
            } : {
                sql: g
            }
        },
        getRulesFromSQL: function(a, b) {
            "SQLParser" in window || l.error("MissingLibrary", "SQLParser is required to parse SQL queries. Get it here https://github.com/mistic100/sql-parser");
            var c = this;
            if ("string" == typeof a && (a = {
                    sql: a
                }), b === !0 && (b = "question_mark"), "string" == typeof b) {
                var d = f(b);
                b = this.settings.sqlRuleStatement[d[1]](a.params, d[2])
            }
            b && (a.sql = b.esc(a.sql)), 0 !== a.sql.toUpperCase().indexOf("SELECT") && (a.sql = "SELECT * FROM table WHERE " + a.sql);
            var e = SQLParser.parse(a.sql);
            if (e.where || l.error("SQLParse", "No WHERE clause found"), a = c.change("parseSQLNode", e.where.conditions), "rules" in a && "condition" in a) return a;
            var g = c.change("sqlToGroup", {
                    condition: this.settings.default_condition,
                    rules: []
                }, a),
                h = g;
            return function i(a, d) {
                if (a = c.change("parseSQLNode", a), "rules" in a && "condition" in a) return void h.rules.push(a);
                if ("id" in a && "operator" in a && "value" in a) return void h.rules.push(a);
                if ("left" in a && "right" in a && "operation" in a || l.error("SQLParse", "Unable to parse WHERE clause"), ["AND", "OR"].indexOf(a.operation.toUpperCase()) !== -1) {
                    if (d > 0 && h.condition != a.operation.toUpperCase()) {
                        var e = c.change("sqlToGroup", {
                            condition: c.settings.default_condition,
                            rules: []
                        }, a);
                        h.rules.push(e), h = e
                    }
                    h.condition = a.operation.toUpperCase(), d++;
                    var f = h;
                    i(a.left, d), h = f, i(a.right, d)
                } else {
                    $.isPlainObject(a.right.value) && l.error("SQLParse", "Value format not supported for {0}.", a.left.value);
                    var g;
                    g = $.isArray(a.right.value) ? a.right.value.map(function(a) {
                        return a.value
                    }) : a.right.value, b && (g = $.isArray(g) ? g.map(b.parse) : b.parse(g));
                    var j = a.operation.toUpperCase();
                    "<>" == j && (j = "!=");
                    var k = c.settings.sqlRuleOperator[j];
                    void 0 === k && l.error("UndefinedSQLOperator", 'Invalid SQL operation "{0}".', a.operation);
                    var m = k.call(this, g, a.operation),
                        n = a.left.values.join("."),
                        o = c.change("sqlToRule", {
                            id: c.change("getSQLFieldID", n, g),
                            field: n,
                            operator: m.op,
                            value: m.val
                        }, a);
                    h.rules.push(o)
                }
            }(a, 0), g
        },
        setRulesFromSQL: function(a, b) {

            console.log(a);
             console.log(b);

            this.setRules(this.getRulesFromSQL(a, b))
        }
    }), g.define("unique-filter", function() {
        this.status.used_filters = {}, this.on("afterUpdateRuleFilter", this.updateDisabledFilters), this.on("afterDeleteRule", this.updateDisabledFilters), this.on("afterCreateRuleFilters", this.applyDisabledFilters), this.on("afterReset", this.clearDisabledFilters), this.on("afterClear", this.clearDisabledFilters), this.on("getDefaultFilter.filter", function(a, b) {
            var c = a.builder;
            if (c.updateDisabledFilters(), a.value.id in c.status.used_filters) {
                var d = c.filters.some(function(d) {
                    if (!(d.id in c.status.used_filters) || c.status.used_filters[d.id].length > 0 && c.status.used_filters[d.id].indexOf(b.parent) === -1) return a.value = d, !0
                });
                d || (l.error("UniqueFilter", "No more non-unique filters available"), a.value = void 0)
            }
        })
    }), g.extend({
        updateDisabledFilters: function(a) {
            var b = a ? a.builder : this;
            b.status.used_filters = {}, b.model && (! function c(a) {
                a.each(function(a) {
                    a.filter && a.filter.unique && (b.status.used_filters[a.filter.id] || (b.status.used_filters[a.filter.id] = []), "group" == a.filter.unique && b.status.used_filters[a.filter.id].push(a.parent))
                }, function(a) {
                    c(a)
                })
            }(b.model.root), b.applyDisabledFilters(a))
        },
        clearDisabledFilters: function(a) {
            var b = a ? a.builder : this;
            b.status.used_filters = {}, b.applyDisabledFilters(a)
        },
        applyDisabledFilters: function(a) {
            var b = a ? a.builder : this;
            b.$el.find(h.filter_container + " option").prop("disabled", !1), $.each(b.status.used_filters, function(a, c) {
                0 === c.length ? b.$el.find(h.filter_container + ' option[value="' + a + '"]:not(:selected)').prop("disabled", !0) : c.forEach(function(b) {
                    b.each(function(b) {
                        b.$el.find(h.filter_container + ' option[value="' + a + '"]:not(:selected)').prop("disabled", !0)
                    })
                })
            }), b.settings.plugins && b.settings.plugins["bt-selectpicker"] && b.$el.find(h.rule_filter).selectpicker("render")
        }
    }), g.regional.en = {
        __locale: "English (en)",
        __author: 'Damien "Mistic" Sorel, http://www.strangeplanet.fr',
        add_rule: "Add Filter",
        add_group: "Add group",
        delete_rule: "Delete",
        delete_group: "Delete",
        conditions: {
            AND: "AND",
            OR: "OR"
        },
        operators: {
            equal: "equal",
            not_equal: "not equal",
            "in": "contain",
            not_in: "not contain",
            less: "less",
            less_or_equal: "Before",
            greater: "greater",
            greater_or_equal: "After",
            between: "between",
            not_between: "not between",
            begins_with: "begins with",
            not_begins_with: "doesn't begin with",
            contains: "contains",
            not_contains: "doesn't contain",
            ends_with: "ends with",
            not_ends_with: "doesn't end with",
            is_empty: "is not known",
            is_not_empty: "is known",
            is_null: "is null",
            is_not_null: "is not null"
        },
        errors: {
            no_filter: "No filter selected",
            empty_group: "The group is empty",
            radio_empty: "No value selected",
            checkbox_empty: "No value selected",
            select_empty: "No value selected",
            string_empty: "Empty value",
            string_exceed_min_length: "Must contain at least {0} characters",
            string_exceed_max_length: "Must not contain more than {0} characters",
            string_invalid_format: "Invalid format ({0})",
            number_nan: "Not a number",
            number_not_integer: "Not an integer",
            number_not_double: "Not a real number",
            number_exceed_min: "Must be greater than {0}",
            number_exceed_max: "Must be lower than {0}",
            number_wrong_step: "Must be a multiple of {0}",
            datetime_empty: "Empty value",
            datetime_invalid: "Invalid date format ({0})",
            datetime_exceed_min: "Must be after {0}",
            datetime_exceed_max: "Must be before {0}",
            boolean_not_valid: "Not a boolean",
            operator_not_multiple: "Operator {0} cannot accept multiple values"
        },
        invert: "Invert",
        NOT: "NOT"
    }, g.defaults({
        lang_code: "en"
    }),g.define('chosen-selectpicker', function(options) {

    if (!$.fn.chosen) {
        Utils.error('MissingLibrary', 'chosen is required to use "chosen-selectpicker" plugin. Get it here: https://github.com/harvesthq/chosen');
    }

    if (this.settings.plugins['bt-selectpicker']) {
        Utils.error('Conflict', 'bt-selectpicker is already selected as the dropdown plugin. Please remove chosen-selectpicker from the plugin list');
    }

    var Selectors = g.selectors;

    // init selectpicker
    this.on('afterCreateRuleFilters', function(e, rule) {
        rule.$el.find(Selectors.rule_filter).removeClass('form-control').chosen(options);
    });

    this.on('afterCreateRuleOperators', function(e, rule) {
        rule.$el.find(Selectors.rule_operator).removeClass('form-control').chosen(options);
    });
	
	this.on('afterCreateRuleInput', function(e, rule) {
		  if (rule.filter.input == 'select') {
        	rule.$el.find(Selectors.rule_value).removeClass('form-control').chosen(options);
		  }
    });
	
    // update selectpicker on change
    this.on('afterUpdateRuleFilter', function(e, rule) {
        rule.$el.find(Selectors.rule_filter).trigger('chosen:updated');
    });

    this.on('afterUpdateRuleOperator', function(e, rule) {
        rule.$el.find(Selectors.rule_operator).trigger('chosen:updated');
    });
	
	this.on('afterUpdateRuleValue', function(e, rule) {
		if (rule.filter.input == 'select') {
        rule.$el.find(Selectors.rule_value).trigger('chosen:updated');
		}
    });

    this.on('beforeDeleteRule', function(e, rule) {
        rule.$el.find(Selectors.rule_filter).chosen('destroy');
        rule.$el.find(Selectors.rule_operator).chosen('destroy');
        if (rule.filter == null ) {
        rule.$el.find(Selectors.rule_value).chosen('destroy');
    }
    });
});
});