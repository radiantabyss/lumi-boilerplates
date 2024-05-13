import moment from 'moment-timezone';

let self = {
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

    pretty_date(date) {
        return self.prettify_date(date);
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
}

export default self;
