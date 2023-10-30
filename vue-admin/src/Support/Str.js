import moment from 'moment-timezone';

let self = {
    urlencode(str) {
        return encodeURIComponent(str);
    },

    slug(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
        var to   = "aaaaaeeeeiiiioooouuuunc------";

        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    },

    dashcase(str) {
        return str.split('').map((letter, idx) => {
            return letter.toUpperCase() === letter
            ? `${idx !== 0 ? '-' : ''}${letter.toLowerCase()}`
            : letter;
        }).join('');
    },

    camelcase(str) {
        return str.replace(/-/g, ' ').replace(/_/g, ' ').replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,function(s) {
            return s.toUpperCase();
        }).replace(/\s+/g, '');
    },

    camel2space(str) {
        if ( !str ) {
            return '';
        }

        return str.split('').map((letter, idx) => {
            return letter.toUpperCase() === letter
            ? `${idx !== 0 ? ' ' : ''}${letter}`
            : letter;
        }).join('');
    },

    ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    },

    ucwords(str) {
        if ( !str ) {
            str = '';
        }

        return str.replace(/-/g, ' ').replace(/_/g, ' ').replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,function(s) {
            return s.toUpperCase();
        });
    },

    ordinalSuffix(i) {
        var j = i % 10,
            k = i % 100;
        if (j == 1 && k != 11) {
            return i + "st";
        }
        if (j == 2 && k != 12) {
            return i + "nd";
        }
        if (j == 3 && k != 13) {
            return i + "rd";
        }

        return i + "th";
    },

    prettify_date(date) {
        date = moment(date, 'America/Los_Angeles');

        if ( moment().format('YYYY-MM-DD') == date.format('YYYY-MM-DD') ) {
            return 'Today';
        }

        if ( moment().subtract(1, 'days').format('YYYY-MM-DD') == date.format('YYYY-MM-DD') ) {
            return 'Yesterday';
        }

        if ( date.format('YYYY') == moment().format('YYYY') ) {
            return date.format('DD MMM');
        }

        return date.format('DD MMM YYYY');
    },

    prettify_datetime(date) {
        date = moment.tz(date, 'America/Los_Angeles');

        if ( date.format('YYYY') == moment().format('YYYY') ) {
            return date.format('DD MMM @ HH:mm');
        }

        return date.format('DD MMM YYYY @ HH:mm');
    },

    prettify_time(date) {
        return moment.tz(date, 'America/Los_Angeles').format('HH:mm');
    },

    mysql_date(date) {
        return moment(date, 'America/Los_Angeles').format('YYYY-MM-DD');
    },

    mysql_datetime(date) {
        return moment.tz(date, 'America/Los_Angeles').format('YYYY-MM-DD HH:mm:ss');
    },

    time_from_now(date) {
        return moment.tz(date, 'America/Los_Angeles').local().fromNow();
    },

    nl2br(str) {
        if ( !str || !str.length ) {
            return '';
        }

        return str.replace(/(\r\n|\n\r|\r|\n)/g, '<br/>' + '$1');
    },

    strip_tags(str) {
        var div = document.createElement("div");
        div.innerHTML = str;
        var text = div.textContent || div.innerText || "";
        return text;
    },

    ensure_https(string) {
        if (!string.match(/^[a-zA-Z]+:\/\//)) {
            string = 'https://' + string;
        }

        return string;
    },

    add_commas(number) {
        if ( number === undefined || number === null ) {
            return '';
        }

        return parseFloat(number).toLocaleString('en-US');
    },

    leading_zero(number) {
        return number < 10 ? `0${number}` : number;
    },

    to_percetange(number) {
        if ( number === undefined || !number ) {
            return '0%';
        }

        return (number / 10)+'%';
    },

    plural(str) {
        str = self.ucwords(str);

        if ( str.match(/y$/) ) {
            return str.replace(/y$/, 'ies');
        }

        return str+'s';
    },
}

export default self;
