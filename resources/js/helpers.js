export default {
    methods:{
        capitalizeFirstLetter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        paginate(tableId){
            setTimeout(function(){
                custom_data_table(tableId);
            }, 1000);
        }
    }

}
