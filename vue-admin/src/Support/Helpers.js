import qs from 'qs';

let self = {
    range(from, to) {
        let range = [];
        for ( let i = from; i <= to; i++ ) {
            range.push(i);
        }

        return range;
    },

    url_with_filters(url, default_filters = {}) {
        return Str.trim(url + (url.match(/\?/) ? '&' : '?') + qs.stringify(ReactiveStorage.getItem(`${store_key || url}__filters`) || default_filters), '?');
    },

    store_url_filters(url, filters) {
        ReactiveStorage.setItem(`${url}__filters`, filters);
    },
}

export default self;
