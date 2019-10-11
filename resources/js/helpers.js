export default {
    methods:{
        capitalizeFirstLetter(str) {
            if (typeof str !== 'string') return '';
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        paginate(tableId, time=1000){
            setTimeout(function(){
                custom_data_table(tableId);
            }, time);
        },
        mobileNoFormat(phoneNumber){
            return phoneNumber;
        },
        csrf_token(){
            let tkn = $('meta[name="_token"]').attr('content');
            return tkn;
        },
        setStringLimit(str, limit){
            if (typeof str !== 'string') return '';
            var cLimit = limit == '' ? 35 : limit;
            var post = str.substr(0, cLimit);
            var dotVal = '';
            if (str.length >= cLimit) {
                dotVal = '...';
            }
            return post + dotVal;
        },
        displayNoData(){
            return "<span class=\"text-muted text-size-small\">[No Data]</span>";
        }

    }

}
