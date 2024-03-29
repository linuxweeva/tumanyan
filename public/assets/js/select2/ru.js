! function() {
    var n;
    jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd && (n = jQuery.fn.select2.amd), n.define("select2/i18n/ru", [], function() {
        function u(n, e, r, u) {
            return n % 10 < 5 && 0 < n % 10 && n % 100 < 5 || 20 < n % 100 ? 1 < n % 10 ? r : e : u
        }
        return {
            errorLoading: function() {
                return "Невозможно загрузить результаты"
            },
            inputTooLong: function(n) {
                var e = n.input.length - n.maximum,
                    r = "Пожалуйста, введите на " + e + " символ";
                return (r += u(e, "", "a", "ов")) + " меньше"
            },
            inputTooShort: function(n) {
                var e = n.minimum - n.input.length;
                return "Пожалуйста, введите ещё хотя бы " + e + " символ" + u(e, "", "a", "ов")
            },
            loadingMore: function() {
                return "Загрузка данных…"
            },
            maximumSelected: function(n) {
                return "Вы можете выбрать не более " + n.maximum + " элемент" + u(n.maximum, "", "a", "ов")
            },
            noResults: function() {
                return "Совпадений не найдено"
            },
            searching: function() {
                return "Поиск…"
            },
            removeAllItems: function() {
                return "Удалить все элементы"
            }
        }
    }), n.define, n.require
}();