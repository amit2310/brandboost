export default {
    methods:{
        capitalizeFirstLetter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        paginate(tableId){
            setTimeout(function(){
                custom_data_table(tableId);
            }, 1000);
        },
        mobileNoFormat(phoneNumber){
            return phoneNumber;
        },
        csrf_token(){
            let tkn = $('meta[name="_token"]').attr('content');
            return tkn;
        },
        setStringLimit(str, limit){
            var cLimit = limit == '' ? 35 : limit;
            var post = str.substr(0, cLimit);
            var dotVal = '';
            if (str.length >= cLimit) {
                dotVal = '...';
            }
            return post + dotVal;
        },
        number_format(num, placeVal){
            var placeVal = placeVal != '' ? placeVal : 2;
            return parseFloat(Math.round(num * 100) / 100).toFixed(placeVal);
        },
        Base64EncodeUrl(str){
            return str.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
        },
        Base64DecodeUrl(str){
            str = (str + '===').slice(0, str.length + (str.length % 4));
            return str.replace(/-/g, '+').replace(/_/g, '/');
        },
        displayNoData() {
            let noData = '[No Data]';
            return noData;
        }

    }

}
